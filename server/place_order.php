<?php

session_start();

include('connection.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?error=Pro vytvoření objednávky se musíte přihlásit/zaregistrovat!');
} else {

    if (isset($_POST['place_order'])) {


        //potrebujeme vzit data z formu a priradit jim promenne pro praci v DB
        $jmeno = $_POST['jmeno'];
        $email = $_POST['email'];
        $telefon = $_POST['telefon'];
        $mesto = $_POST['mesto'];
        $adresa = $_POST['adresa'];
        $obj_cena = $_SESSION['total'];
        //tohle je zatim nevyuzite
        $obj_status = "Nezaplaceno";
        //tohle taky
        $uziv_id = $_SESSION['uziv_id'];
        $obj_datum = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO objednavky (obj_cena, obj_status, uziv_id, uziv_tel,uziv_mesto,uziv_adresa,obj_datum ) 
    VALUES (?,?,?,?,?,?,?)");

        $stmt->bind_param('isiisss', $obj_cena, $obj_status, $uziv_id, $telefon, $mesto, $adresa, $obj_datum);

        //ochrana objednavky

        $stmt_status = $stmt->execute();

        if (!$stmt_status) {
            header('location: index.php');
            exit;
        }


        $obj_id = $stmt->insert_id;


        foreach ($_SESSION['cart'] as $key => $value) {
            $produkt = $_SESSION['cart'][$key];
            $produkt_id = $produkt['produkt_id'];
            $produkt_jmeno = $produkt['produkt_jmeno'];
            $produkt_cena = $produkt['produkt_cena'];
            $produkt_fotka = $produkt['produkt_fotka'];
            $produkt_pocet = $produkt['produkt_pocet'];

            $stmt1 = $conn->prepare("INSERT INTO objednavkaprod (obj_id,produkt_id,produkt_jmeno,produkt_fotka,produkt_cena,produkt_pocet,uziv_id,obj_datum)
                         VALUES (?,?,?,?,?,?,?,?);");
            $stmt1->bind_param('iissiiis', $obj_id, $produkt_id, $produkt_jmeno, $produkt_fotka, $produkt_cena, $produkt_pocet, $uziv_id, $obj_datum);
            $stmt1->execute();
        }

        $_SESSION['obj_id'] = $obj_id;


        // ted prichazi na radu platebni brana
        header('location: ../payment.php?obj_status=Objednavka byla uspesne odeslana');
    }
}
