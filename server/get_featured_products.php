<?php

include('connection.php');

$stmt = $conn->prepare('SELECT * FROM produkty LIMIT 4');

$stmt->execute();

$featured_products = $stmt->get_result();
