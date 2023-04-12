<?php
session_start();

if (isset($_GET['logout'])) {
    if (isset($_SESSION['admin_logged_in'])) {
        session_destroy();
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_jmeno']);
        unset($_SESSION['admin_email']);
        header('location: login.php');
        exit;
    }
}
