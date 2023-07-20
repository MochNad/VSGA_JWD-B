<?php
// Include the functions file
require_once 'functions.php';

// Check if the ID parameter exists in the URL
if (isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Call the deleteSiswa() function to delete the record from the database
    if (deleteSiswa($id)) {
        // Redirect to the index page if the deletion was successful
        header('Location: daftar.php');
        exit();
    } else {
        // Handle error if the deletion fails (you can show an error message or perform other actions here)
        echo 'Failed to delete data.';
    }
} else {
    // Redirect to the index page if the ID parameter is missing
    header('Location: daftar.php');
    exit();
}
?>
