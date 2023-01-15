<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_kateg='doplnek' LIMIT 4");

$stmt->execute();

$addon = $stmt->get_result();
