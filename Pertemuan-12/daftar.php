<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card border-0 shadow rounded">
            <div class="card-header border-0 shadow rounded">
                <a href="index.php" style="text-decoration: none; color: black;">Daftar Siswa</a>
                <a href="tambah.php" class="btn btn-success float-right border-0 shadow rounded-pill">
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
</body>
</html>
