<?php
// Include the functions file
require_once 'functions.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $sekolah_asal = $_POST['sekolah_asal'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];

    // Call the updateSiswa() function to update data in the database
    if (updateSiswa($id, $nama, $alamat, $sekolah_asal, $jk, $agama)) {
        // Redirect to the index page if the data update was successful
        header('Location: daftar.php');
        exit();
    } else {
        // Handle error if data update fails (you can show an error message or perform other actions here)
        echo 'Failed to update data.';
    }
}

// Get the student ID from the URL parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Get the student data by ID
    $siswa = getSiswaById($id);
} else {
    // Redirect to the index page if the student ID is not provided
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card border-0 shadow rounded">
            <div class="card-header border-0 shadow rounded">
                Edit Siswa
            </div>
            <div class="card-body">
                <form method="post" action="edit.php">
                    <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $siswa['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sekolah_asal">Sekolah Asal</label>
                        <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" required value="<?php echo $siswa['sekolah_asal']; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select class="form-control" id="jk" name="jk" required>
                                    <option value="Laki-laki" <?php echo ($siswa['jk'] === 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php echo ($siswa['jk'] === 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agama" name="agama" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" <?php echo ($siswa['agama'] === 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                    <option value="Kristen" <?php echo ($siswa['agama'] === 'Kristen') ? 'selected' : ''; ?>>Kristen</option>
                                    <option value="Katolik" <?php echo ($siswa['agama'] === 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
                                    <option value="Hindu" <?php echo ($siswa['agama'] === 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                    <option value="Buddha" <?php echo ($siswa['agama'] === 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                                    <option value="Konghucu" <?php echo ($siswa['agama'] === 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo $siswa['alamat']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary float-right border-0 shadow rounded">Update</button>
                </form>
                <a href="daftar.php" class="btn btn-sm btn-secondary border-0 shadow rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
