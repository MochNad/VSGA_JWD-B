<?php
session_start();

// Cek apakah pengguna sudah login, jika belum, alihkan ke halaman login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (isset($_POST["logout"])) {
    // Menghapus session dan mengarahkan pengguna ke halaman login
    session_destroy();
    header("location: login.php");
    exit;
}

require_once "db_connection.php";

// Mendapatkan data pengguna dari database berdasarkan email yang disimpan dalam session
$email = $_SESSION["email"];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

$userData = null;
if ($result->num_rows == 1) {
    $userData = $result->fetch_assoc();
}

// Mendapatkan semua menu dari tabel menu
$sqlMenu = "SELECT * FROM menu";
$resultMenu = $conn->query($sqlMenu);

// Menangani proses checkout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["checkout"])) {
    // Mendapatkan ID pengguna yang sedang login
    $userId = $_SESSION["id"];

    // Mendapatkan data menu dan qty dari form
    $menus = $_POST["menu"];
    $qtys = $_POST["qty"];

    // Menyimpan pesanan ke dalam tabel orders
    for ($i = 0; $i < count($menus); $i++) {
        $menuId = $menus[$i];
        $qty = $qtys[$i];

        // Mengambil harga menu dari tabel menu
        $sqlPrice = "SELECT price FROM menu WHERE id = '$menuId'";
        $resultPrice = $conn->query($sqlPrice);
        $rowPrice = $resultPrice->fetch_assoc();
        $price = $rowPrice["price"];

        // Menghitung total pesanan hanya jika qty valid (tidak kosong dan lebih besar dari 0)
        if (!empty($qty) && is_numeric($qty) && $qty > 0) {
            // Menghitung total pesanan
            $total = $price * $qty;

            // Menyimpan pesanan ke dalam tabel orders
            $sqlOrder = "INSERT INTO orders (user_id, menu_id, qty, total, status) VALUES ('$userId', '$menuId', '$qty', '$total', 'process')";
            $conn->query($sqlOrder);
        }
    }

    $checkoutSuccess = true; // Set flag menjadi true

    // Redirect ke halaman yang sama menggunakan metode GET
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit; // Pastikan untuk melakukan exit setelah melakukan redirect
}

// Mengupdate status orders menjadi "checkout-" saat tombol cetak ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["print"])) {
    // Mengambil nomor checkout terbaru dari database
    $sqlCheckoutNumber = "SELECT MAX(SUBSTRING_INDEX(status, '-', -1)) AS max_checkout FROM orders WHERE status LIKE 'checkout-%'";
    $resultCheckoutNumber = $conn->query($sqlCheckoutNumber);
    $rowCheckoutNumber = $resultCheckoutNumber->fetch_assoc();
    $checkoutNumber = $rowCheckoutNumber['max_checkout'];

    // Jika tidak ada checkout sebelumnya, atur nomor checkout menjadi 1
    if ($checkoutNumber === null) {
        $checkoutNumber = 1;
    } else {
        $checkoutNumber++; // Tambahkan 1 ke nomor checkout terbaru
    }

    // Mengupdate status orders dengan checkout terbaru
    $sqlUpdateStatus = "UPDATE orders SET status = CONCAT('checkout-', '$checkoutNumber') WHERE status = 'process'";
    $conn->query($sqlUpdateStatus);

    // Redirect ke halaman yang sama menggunakan metode GET
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit; // Pastikan untuk melakukan exit setelah melakukan redirect
}

// Retrieve checkout number
$sqlCheckoutNumber = "SELECT MAX(SUBSTRING_INDEX(status, '-', -1)) AS max_checkout 
                      FROM orders 
                      WHERE status LIKE 'checkout-%'";
$resultCheckoutNumber = $conn->query($sqlCheckoutNumber);
$rowCheckoutNumber = $resultCheckoutNumber->fetch_assoc();
$checkoutNumber = $rowCheckoutNumber['max_checkout']+1;

if ($checkoutNumber === null) {
    $checkoutNumber = 1;
}

$userId = $_SESSION["id"];

$sqlCheckoutNumber = "SELECT COUNT(*) AS total_checkouts
                      FROM orders 
                      WHERE status LIKE 'checkout-%' AND user_id = '$userId'";
$resultCheckoutNumber = $conn->query($sqlCheckoutNumber);
$rowCheckoutNumber = $resultCheckoutNumber->fetch_assoc();
$totalCheckouts = $rowCheckoutNumber['total_checkouts'];

// Retrieve orders
$sqlOrders = "SELECT o.menu_id, m.name, SUM(o.qty) AS total_qty, SUM(o.total) AS total_amount, '$checkoutNumber' AS checkout_number
              FROM orders o
              JOIN menu m ON o.menu_id = m.id
              WHERE o.user_id = '$userId' AND o.status = 'process'
              GROUP BY o.menu_id";
$resultOrders = $conn->query($sqlOrders);

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="d-flex justify-center align-items-center">
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Profile</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($userData): ?>
                            <p><strong>Name</strong><span class="float-right"><?php echo $userData["firstname"]; ?> <?php echo $userData["lastname"]; ?></span></p>
                            <p><strong>Email</strong><span class="float-right"><?php echo $userData["email"]; ?></span></p>
                            <p><strong>Address</strong><span class="float-right"><?php echo $userData["address"]; ?></span></p>
                            <p><strong>Checkout</strong><span class="float-right"><?php echo $totalCheckouts; ?></span></p>
                        <?php else: ?>
                            <p>No user data found.</p>
                        <?php endif; ?>
                    </div>
                    <form method="POST">
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block" name="logout">Logout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Order</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($resultMenu->num_rows > 0): ?>
                            <form method="POST" id="checkout">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $resultMenu->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $row["name"]; ?></td>
                                                <td><?php echo $row["price"]; ?></td>
                                                <td style="width: 20%;"><input type="number" name="qty[]" class="form-control qty-input" onchange="calculateTotal(this, <?php echo $row['price']; ?>)"></td>
                                                <td class="total"></td>
                                                <input type="hidden" name="menu[]" value="<?php echo $row['id']; ?>">
                                            </tr>
                                        <?php endwhile; ?>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                                            <td id="grand-total"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        <?php else: ?>
                            <p class="text-center">No menu found.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" form="checkout" class="btn btn-primary btn-block" name="checkout">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Checkout</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($resultOrders->num_rows > 0): ?>
                            <p class="float-right">checkout-<?php echo $checkoutNumber; ?></p> <!-- Display the checkout number -->
                            <table class="table" id="order-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $grandTotal = 0; // Initialize grand total
                                    while ($row = $resultOrders->fetch_assoc()): 
                                        $grandTotal += $row["total_amount"]; // Add total amount to grand total
                                    ?>
                                        <tr>
                                            <td><?php echo $row["name"]; ?></td>
                                            <td><?php echo $row["total_qty"]; ?></td>
                                            <td><?php echo $row["total_amount"]; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <tr>
                                        <td colspan="2" class="text-right"><strong>Grand Total</strong></td>
                                        <td><?php echo $grandTotal; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-center">No orders found.</p>
                        <?php endif; ?>
                    </div>
                    <form method="POST">
                        <div class="card-footer">
                            <div class="text-center">
                                <button class="btn btn-primary btn-block" name="print" onclick="generatePDF()">Print</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script>
        function calculateTotal(input, price) {
            var qty = input.value;
            var total = qty * price;
            var row = input.parentNode.parentNode;
            var totalCell = row.querySelector('.total');

            if (qty !== '') {
                totalCell.textContent = total;
            } else {
                totalCell.textContent = '';
            }

            updateGrandTotal();
        }

        function updateGrandTotal() {
            var totalCells = document.querySelectorAll('.total');
            var grandTotalCell = document.getElementById('grand-total');
            var grandTotal = 0;

            totalCells.forEach(function(cell) {
                var value = parseFloat(cell.textContent);
                if (!isNaN(value)) {
                    grandTotal += value;
                }
            });

            grandTotalCell.textContent = grandTotal;
        }

        function generatePDF() {
        var tableContent = [
            [{ text: 'Name', style: 'tableHeader' }, { text: 'Qty', style: 'tableHeader' }, { text: 'Total', style: 'tableHeader' }],
            <?php
            $grandTotal = 0;
            $resultOrders->data_seek(0); // Reset the query cursor to the beginning
            while ($row = $resultOrders->fetch_assoc()) {
                echo "[ '{$row['name']}', '{$row['total_qty']}', '{$row['total_amount']}' ],";
                $grandTotal += $row["total_amount"];
            }
            ?>
            [{ text: 'Grand Total', style: 'tableFooter', colSpan: 2, alignment: 'right' }, '', '<?php echo $grandTotal; ?>']
        ];

        var docDefinition = {
            content: [
                { text: 'Order Summary', style: 'header' },
                { text: '\n' },
                {
                    table: {
                        headerRows: 1,
                        widths: ['*', '*', '*'], // Column widths based on proportions
                        body: tableContent
                    }
                }
            ],
            styles: {
                header: {
                    fontSize: 18,
                    bold: true
                },
                tableHeader: {
                    bold: true
                },
                tableFooter: {
                    bold: true,
                    fillColor: '#eeeeee'
                }
            }
        };

        var fileName = 'checkout-<?php echo $checkoutNumber; ?>.pdf'; // Set the filename dynamically
        pdfMake.createPdf(docDefinition).download(fileName);
    }
    </script>
</body>
</html>
