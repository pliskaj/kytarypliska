<?php

// Path: layouts\header.php

session_start();

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://kit.fontawesome.com/fd1bc553ca.js" crossorigin="anonymous"></script>

    <title>Hello, world!</title>
</head>

<body>
    <!--Navigace-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container-fluid">
            <img src="assets/img/logo1.png" alt="logo" class="logo" />
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse nav-buttons" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Domů</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Obchod</a>
                    </li>
                    <!-- <li class="nav-item">
              <a class="nav-link" href="#">O nás</a>
            </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontaktní údaje</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php">
                            <i class="fa-solid fa-cart-shopping">
                                <?php if (isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                                    <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                                <?php } ?>
                            </i>
                        </a>

                        <a href="account.php"><i class="fa-solid fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>