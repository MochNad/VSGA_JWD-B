<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Printer</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Input Data Printer</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="nama_merek">Nama Merek:</label>
                <input type="text" class="form-control" id="nama_merek" name="nama_merek" required>
            </div>
            <div class="form-group">
                <label for="warna">Warna:</label>
                <input type="text" class="form-control" id="warna" name="warna" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <hr>

        <h2>Data yang Disimpan</h2>
        <div id="data-container">
            <?php
            // Koneksi ke database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "data";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Ambil data dari form input
                $nama_merek = $_POST['nama_merek'];
                $warna = $_POST['warna'];
                $jumlah = $_POST['jumlah'];

                // Query untuk menyimpan data ke tabel "printer"
                $sql = "INSERT INTO printer (nama_merek, warna, jumlah) VALUES ('$nama_merek', '$warna', $jumlah)";

                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success">Data berhasil disimpan.</div>';
                } else {
                    echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                }
            }

            // Query untuk mengambil data dari tabel "printer"
            $sql = "SELECT * FROM printer";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    // Jika terdapat data, tampilkan dalam tabel
                    echo '<table class="table">';
                    echo '<tr><th>Nama Merek</th><th>Warna</th><th>Jumlah</th></tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['nama_merek'] . '</td>';
                        echo '<td>' . $row['warna'] . '</td>';
                        echo '<td>' . $row['jumlah'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo 'Belum ada data yang disimpan.';
                }
            } else {
                echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
