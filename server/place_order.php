<?php

session_start();

include('connection.php');

if (isset($_POST['place_order'])) {


    //potrebujeme vzit data z formu a priradit jim promenne pro praci v DB
    $jmeno = $_POST['jmeno'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $mesto = $_POST['mesto'];
    $adresa = $_POST['adresa'];
    $obj_cena = $_SESSION['total'];
    //tohle je zatim nevyuzite
    $obj_status = "Ve zpracovani";
    //tohle taky
    $uziv_id = 1;
    $obj_datum = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO objednavky (obj_cena, obj_status, uziv_id, uziv_tel,uziv_mesto,uziv_adresa,obj_datum ) 
    VALUES (?,?,?,?,?,?,?);");

    $stmt->bind_param('isiisss', $obj_cena, $obj_status, $uziv_id, $telefon, $mesto, $adresa, $obj_datum);

    $stmt->execute();

    //tady potrebuju nejak vyresit objednavkovy id...zatim nevim jak..
    $obj_id = $stmt->insert_id;

    echo $obj_id;
    //mozna takhle ale zni to jako prasarna. Vloz pevne dany ID do stmt.



    // dej mi produkty z cartu (session)

}
