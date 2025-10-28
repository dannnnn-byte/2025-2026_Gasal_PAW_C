<?php
function validateName(&$errors, $field_list, $field_name) {
    $pattern = "/^[a-zA-Z\s'-]+$/";
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'Nama wajib diisi.';
    } elseif (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Nama hanya boleh berisi huruf dan spasi.';
    }
}

function validateEmail(&$errors, $field_list, $field_name) {
    $pattern = "/^[\w\.-]+@[\w\.-]+\.\w+$/";
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'Email wajib diisi.';
    } elseif (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Format email tidak valid.';
    }
}

function validatePassword(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'Password wajib diisi.';
    } elseif (strlen($field_list[$field_name]) < 6) {
        $errors[$field_name] = 'Password minimal 6 karakter.';
    }
}
?>
