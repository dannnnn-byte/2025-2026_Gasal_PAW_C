<?php
$errors = array();

if (isset($_POST['surname'])) {
    require 'validate.inc';
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');

    if ($errors) {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error) {
            echo "$field : $error<br/>";
        }
        include 'form.inc';
    } else {
        echo '<h1>Form submitted successfully with no errors</h1>';
    }
} else {
    include 'form.inc';
}