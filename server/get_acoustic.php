<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_kateg='akustika' LIMIT 4");

$stmt->execute();

$acoustic = $stmt->get_result();
