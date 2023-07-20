<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card border-0 shadow rounded">
            <div class="card-header border-0 shadow rounded">
                <a href="index.php" style="text-decoration: none; color: black;">Daftar Siswa</a>
                <a href="tambah.php" class="btn btn-sm btn-success float-right border-0 shadow rounded">
                    Tambah
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Action</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the functions file
                        require_once 'functions.php';

                        // Get all rows from the 'siswa' table
                        $siswaData = getAllSiswa();

                        // Loop through the data and display it in the table
                        foreach ($siswaData as $siswa) {
                            echo '<tr>';
                            echo '<td>' . $siswa['id'] . '</td>';
                            echo '<td>' . $siswa['nama'] . '</td>';
                            echo '<td>' . $siswa['alamat'] . '</td>';
                            echo '<td>' . $siswa['tgl_lahir'] . '</td>';
                            echo '<td>' . $siswa['jk'] . '</td>';
                            echo '<td>' . $siswa['agama'] . '</td>';
                            echo '<td>';
                            echo '<a href="edit.php?id=' . $siswa['id'] . '" class="btn btn-sm btn-primary border-0 shadow rounded">Edit</a>';
                            echo ' ';
                            echo '<a href="#" onclick="deleteConfirmation(' . $siswa['id'] . ', \'' . $siswa['nama'] . '\')" class="btn btn-sm btn-danger border-0 shadow rounded">Hapus</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>

    <script>
        // Function to display the SweetAlert confirmation dialog
        function deleteConfirmation(id, nama) {
            Swal.fire({
                title: "Hapus Siswa",
                text: "Hapus siswa " + nama + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                // If the user clicks "Yes," proceed with the delete action
                if (result.isConfirmed) {
                    // Redirect to the delete action URL
                    window.location.href = "delete.php?id=" + id;
                }
            });
        }
    </script>
</body>
</html>
