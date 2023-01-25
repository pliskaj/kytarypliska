<?php

include('connection.php');

$stmt = $conn->prepare('SELECT * FROM produkty');

$stmt->execute();

$all_products = $stmt->get_result();
