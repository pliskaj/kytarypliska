<?php

session_start();

include('../server/connection.php');
include('layouts/header.php');

if (isset($_SESSION['admin_logged_in'])) {
    header('location: dashboard.php');
    exit;
}

if (isset($_POST['login-btn'])) {

    $email  = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT admin_id, admin_jmeno, admin_email, admin_heslo FROM admin WHERE admin_email = ? LIMIT 1");

    $stmt->bind_param('s', $email,);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_jmeno, $admin_email, $hash_password);
        $stmt->store_result();

        if ($stmt->num_rows() == 1) {
            $row = $stmt->fetch();

            if (password_verify($password, $hash_password)) {
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_jmeno'] = $admin_jmeno;
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['admin_logged_in'] = true;

                header('location: dashboard.php?login_message=Nyní jste přihlášen/a!');
            } else {
                header('location: login.php?error=Špatné heslo!');
            }
        } else {
            header('location: dashboard.php?error=Přihlášení se nezdařilo!');
        }
    } else {
        //errory 

        header('location: login.php?error=Chyba při přihlášení!');
    }
}


?>








<!--Login-->

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Přihlásit se</h2>
        <hr class="mx-auto" />
    </div>

    <div class="mx-auto container">
        <form id="login-form" method="POST" action="login.php">
            <p style="color: red;" class="text-center"><?php if (isset($_GET['error'])) {
                                                            echo $_GET['error'];
                                                        } ?></p>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Zadejte email" required />
            </div>
            <div class="form-group">
                <label for="email">Heslo</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Zadejte heslo" required />
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login-btn" value="Přihlásit se" />
            </div>
            <div class="form-group">
                <a id="register-url" href="register.php" class="btn">Zaregistrovat se</a>
            </div>
        </form>
    </div>
</section>

<!--Footer-->