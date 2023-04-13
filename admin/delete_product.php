<?php

session_start();

include('../server/connection.php');


if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}


if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("DELETE FROM produkty WHERE produkt_id = ?");
    $stmt->bind_param('i', $product_id);

    if ($stmt->execute()) {
        header('location: products.php?edit_success_message=Produkt byl smazán!');
    } else {
        header('location: products.php?edit_error_message=Chyba při mazání produktu!');
    }
}
