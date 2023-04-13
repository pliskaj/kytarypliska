<?php

include('../server/connection.php');


if (isset($_POST['add_btn'])) {

    $produkt_jmeno = $_POST['product_name'];
    $produkt_popis = $_POST['product_id'];


    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];

    $image_name1 = $produkt_jmeno . '1' . '.jpg';
    $image_name2 = $produkt_jmeno . '2' . '.jpg';
    $image_name3 = $produkt_jmeno . '3' . '.jpg';
    $image_name4 = $produkt_jmeno . '4' . '.jpg';

    move_uploaded_file($image1, "../assets/img/" . $image_name1);
    move_uploaded_file($image2, "../assets/img/" . $image_name2);
    move_uploaded_file($image3, "../assets/img/" . $image_name3);
    move_uploaded_file($image4, "../assets/img/" . $image_name4);

    $stmt = $conn->prepare("UPDATE produkty SET produkt_fotka = ?, produkt_fotka2 = ?, produkt_fotka3 = ?, produkt_fotka4 = ? WHERE produkt_id = ?");

    $stmt->bind_param("ssssi", $image_name1, $image_name2, $image_name3, $image_name4, $produkt_popis);

    if ($stmt->execute()) {
        header("Location: products.php?edit_message_success=Fotky byly úspěšně upraveny!");
    } else {
        header("Location: products.php?edit_message_error=Fotky se nepodařilo změnit!");
    }
}
