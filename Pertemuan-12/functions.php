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

// Function to get a single student data by ID
function getSiswaById($id)
{
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $query = "SELECT * FROM siswa WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query error: ' . mysqli_error($conn));
    }

    $siswa = mysqli_fetch_assoc($result);
    return $siswa;
}

// Function to update a student's data by ID
function updateSiswa($id, $nama, $alamat, $tgl_lahir, $jk, $agama)
{
    global $conn;

    $id = mysqli_real_escape_string($conn, $id);
    $nama = mysqli_real_escape_string($conn, $nama);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $tgl_lahir = mysqli_real_escape_string($conn, $tgl_lahir);
    $jk = mysqli_real_escape_string($conn, $jk);
    $agama = mysqli_real_escape_string($conn, $agama);

    $query = "UPDATE siswa SET 
              nama = '$nama',
              alamat = '$alamat',
              tgl_lahir = '$tgl_lahir',
              jk = '$jk',
              agama = '$agama'
              WHERE id = $id";

    $result = mysqli_query($conn, $query);

    // Check if the update query was successful
    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a row from the 'siswa' table based on ID
function deleteSiswa($id)
{
    global $conn;

    // Escape the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);

    $query = "DELETE FROM siswa WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return false; // Return false if data deletion fails
    }

    // Return true if the data deletion was successful
    return true;
}
