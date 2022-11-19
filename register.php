<?php

require_once("core/controller.Class.php");

if (isset($_POST['register'])) {
    $db = new Connect;
    // filter data yang diinputkan
    $Fname = filter_input(INPUT_POST, 'Fname', FILTER_SANITIZE_STRING);
    $Lname = filter_input(INPUT_POST, 'Lname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING); 
    $telp = filter_input(INPUT_POST, 'telp', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    


    // menyiapkan query
    $sql = "INSERT INTO users (Fname, Lname, email, address, telp, password) 
            VALUES (:Fname, :Lname, :email, :address, :telp, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":Fname" => $Fname,
        ":Lname" => $Lname,
        ":email" => $email,
        ":address" => $address,
        ":telp" => $telp,
        ":password" => $password

    );

    // eksekusi query untuk menyimpan ke databas
        //code...
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if ($saved) header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentcam</title>
    <?php require_once("style.php"); ?>

</head>

<body class="bg-light">
    <div class="container">
        <div class="row  align-items-center justify-content-center">
            <div class="col-md-8 m-5 p-5 card">
                <h3>Register to <strong>Rentcam</strong></h3>
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
                <form action="register.php" method="POST">
                    <div class="form-group d-md-flex">
                        <div class="w-50 mr-5">
                            <label for="Fname">Nama Depan</label>
                            <input class="form-control" type="text" name="Fname" placeholder="Nama depan kamu" />
                        </div>
                        <div class="w-50 ml-5">
                            <label for="Lname">Nama Belakang</label>
                            <input class="form-control" type="text" name="Lname" placeholder="Nama belakang kamu" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input class="form-control" type="text" name="address" placeholder="Alamat" />
                    </div>

                    <div class="form-group">
                        <label for="telp">No Telp</label>
                        <input class="form-control" type="text" name="telp" placeholder="No telp" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Password" />
                    </div>

                    <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />

                </form>
            </div>
        </div>
    </div>

</body>

</html>