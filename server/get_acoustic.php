<?php

include('connection.php');

// vyber kategorii akustik
$stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_kateg='akustika' LIMIT 4");

$stmt->execute();

$acoustic = $stmt->get_result();
