<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="Personal Branding, Online Resume, Social Resume, Creative Resume, Technical Resume, Job Search, Job Listing">
    <meta name="author" content="Kolour Me Team">
    <link rel="shortcut icon" href="../views/Images/k-logo-icon.ico" type="image/x-icon" />
    <link href='//fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Maven+Pro:500' rel='stylesheet' type='text/css'>
    <script class="jsbin" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script async class="jsbin" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script async src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
    <title>Kolour Me - You on the Internet</title>
</head>
<body>

<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>
