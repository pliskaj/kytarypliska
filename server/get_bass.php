<?php

include('connection.php');

// vyber kategorii bas
$stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_kateg='basa' LIMIT 4");

$stmt->execute();

$bass = $stmt->get_result();
