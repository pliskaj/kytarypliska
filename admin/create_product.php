<?php

include('../server/connection.php');


if (isset($_POST['add_btn'])) {

    $produkt_jmeno = $_POST['title'];
    $produkt_popis = $_POST['description'];
    $produkt_cena = $_POST['price'];
    $produkt_barva = $_POST['color'];
    $produkt_spec_nab = $_POST['special'];
    $produkt_kateg = $_POST['category'];


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

    $stmt = $conn->prepare("INSERT INTO produkty (produkt_jmeno, produkt_popis, produkt_cena, produkt_barva, produkt_spec_nab, produkt_kateg, produkt_fotka, produkt_fotka2, produkt_fotka3, produkt_fotka4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssss", $produkt_jmeno, $produkt_popis, $produkt_cena, $produkt_barva, $produkt_spec_nab, $produkt_kateg, $image_name1, $image_name2, $image_name3, $image_name4);

    if ($stmt->execute()) {
        header("Location: products.php?edit_message_success=Produkt byl úspěšně přidán");
    } else {
        header("Location: products.php?edit_message_error=Produkt se nepodařilo přidat");
    }
}
