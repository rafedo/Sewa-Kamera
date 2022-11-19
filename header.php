<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentcam</title>
    <!-- menyisipkan bootstrap -->
    <?php require_once("style.php");
    require_once('core/controller.Class.php'); ?>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center pt-4 pb-2">
            <img src="assets/img/logo.svg" height="60px" alt="icon">
        </div>
        <div class="row justify-content-center pb-2">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Daftar Harga
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-dark" href="catalog.php?merk=sony">sony</a>
                        <a class="dropdown-item text-dark" href="catalog.php?merk=fuji">fuji</a>
                        <a class="dropdown-item text-dark" href="catalog.php?merk=nikon">nikon</a>
                        <a class="dropdown-item text-dark" href="catalog.php?merk=canon">canon</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-dark" href="catalog.php?kategori=aksessoris">aksessoris</a>
                    </div>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['user']) or (isset($_COOKIE['id']) && isset($_COOKIE['sess']))) : ?>
                    <!-- Sudah login -->
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="index.php">keranjang</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if (isset($_SESSION['user'])) :
                                $userInfo = $_SESSION['user'];
                            else :
                                $db = new Connect;
                                $user = $db->prepare("SELECT * FROM users WHERE id=:id AND session=:session");
                                $user->execute([
                                    ':id'       => intval($_COOKIE['id']),
                                    ':session'  => $_COOKIE['sess']
                                ]);
                                $userInfo = $user->fetch(PDO::FETCH_ASSOC);
                            endif;
                            echo  $userInfo['Fname'];
                            ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-dark" href="logout.php">logout</a>
                        </div>
                    </li>
                <?php else : ?>
                    <!-- Belum login -->
                    <li class="nav-item">
                        <a class="btn btn-primary px-4" href="login.php">login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="register.php" tabindex="-1" aria-disabled="true">Daftar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php require_once("scripts.php"); ?>
</body>

</html>