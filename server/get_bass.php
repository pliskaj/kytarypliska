<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_kateg='basa-elektrika' LIMIT 4");

$stmt->execute();

$bass = $stmt->get_result();
