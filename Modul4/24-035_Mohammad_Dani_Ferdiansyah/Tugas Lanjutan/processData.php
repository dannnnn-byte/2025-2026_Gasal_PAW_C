<?php
require 'validate.inc';

$errors = array();

validateName($errors, $_POST, 'nama');
validateEmail($errors, $_POST, 'email');
validatePassword($errors, $_POST, 'password');

if ($errors) {
    echo "<h3>Terjadi Kesalahan:</h3>";
    foreach ($errors as $field => $msg) {
        echo "<p style='color:red;'><strong>$field:</strong> $msg</p>";
    }
    echo "<p><a href='form.php'>Kembali ke Form</a></p>";
} else {
    echo "<h3>Data Mahasiswa Berhasil Dikirim!</h3>";
    echo "<p>Nama: " . htmlspecialchars($_POST['nama']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($_POST['email']) . "</p>";
}
?>
