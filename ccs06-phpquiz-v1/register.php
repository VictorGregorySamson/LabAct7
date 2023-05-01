<?php

require "vendor/autoload.php";

session_start();
// 2. Why do you think the session variable assignments are wrapped inside an if-else and try-catch statements?
/* Probably to ensure that all variables are working. If for some reason the POST method does not work,
the program will throw an exception telling user that there is missing information. */

try {
    if (isset($_POST['fullname'])) {
        $_SESSION['user_fullname'] = $_POST['fullname'];
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['birthdate'] = $_POST['birthdate'];
        $_SESSION['gender'] = $_POST['gender'];

        header('Location: quiz.php');
        exit;
    } else {
        throw new Exception('Missing the basic information.');
    }
} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
}