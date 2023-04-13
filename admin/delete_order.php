<?php

session_start();

include('../server/connection.php');


if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}


if (isset($_GET['obj_id'])) {
    $obj_id = $_GET['obj_id'];
    $stmt = $conn->prepare("DELETE FROM objednavky WHERE obj_id = ?");
    $stmt->bind_param('i', $obj_id);

    if ($stmt->execute()) {
        header('location: dashboard.php?edit_success_message=Objednávka byla smazán!');
    } else {
        header('location: dashboard.php?edit_error_message=Chyba při mazání objednávky!');
    }
}
