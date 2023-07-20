<?php
// Include the database connection file
require_once 'database.php';

// Function to get all rows from the 'siswa' table
function getAllSiswa()
{
    global $conn;
    $query = "SELECT * FROM siswa";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query error: ' . mysqli_error($conn));
    }

    $siswaData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $siswaData[] = $row;
    }

    return $siswaData;
}

// Function to add a new row to the 'siswa' table
function tambahSiswa($nama, $alamat, $tgl_lahir, $jk, $agama)
{
    global $conn;

    // Escape user inputs to prevent SQL injection
    $nama = mysqli_real_escape_string($conn, $nama);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $tgl_lahir = mysqli_real_escape_string($conn, $tgl_lahir);
    $jk = mysqli_real_escape_string($conn, $jk);
    $agama = mysqli_real_escape_string($conn, $agama);

    $query = "INSERT INTO siswa (nama, alamat, tgl_lahir, jk, agama) VALUES ('$nama', '$alamat', '$tgl_lahir', '$jk', '$agama')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return false; // Return false if data insertion fails
    }

    // Return true if the data insertion was successful
    return true;
}
