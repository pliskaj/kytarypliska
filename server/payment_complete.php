<?php

session_start();

include('connection.php');


if (isset($_GET['transakce_id']) && isset($_GET['obj_id'])) {

    $obj_id = $_GET['obj_id'];
    $obj_status = 'Zaplaceno';
    $transakce_id = $_GET['transakce_id'];
    $uziv_id = $_SESSION['uziv_id'];
    $platba_datum = date("Y-m-d H:i:s");


    // zmen stav objednavky na zaplaceno
    $stmt = $conn->prepare("UPDATE objednavky SET obj_status = ? WHERE obj_id = ?");
    $stmt->bind_param('si', $obj_status, $obj_id);

    $stmt->execute();

    //uloz info o zaplaceni
    $stmt1 = $conn->prepare("INSERT INTO platby (obj_id, uziv_id, transakce_id, platba_datum ) VALUES (?, ?, ?, ?);");
    $stmt1->bind_param('iiss', $obj_id, $uziv_id, $transakce_id, $platba_datum);

    $stmt1->execute();

    // bez do user uctu

    header("location: ../account.php?payment_message=Děkujeme za nákup!");
} else {
    header("location: ../index.php");
    exit;
}
