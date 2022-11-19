<?php


require_once('conf.php');
require_once('core/controller.Class.php');


if(isset($_POST['login'])){
    $db = new Connect;
    $username = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;

            
            // login sukses, alihkan ke halaman timeline
            header("Location: index.php");
        }
    }
}
?>
<?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
            $Controller = new Controller;
            if($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess'])){
                header("Location: index.php");
            }
            
        }else{ ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rentcam</title>
    <!-- menyisipkan bootstrap -->
    <?php require_once("style.php"); ?>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row  align-items-center justify-content-center">
            <div class="col-md-7 m-5 p-5 card">
                <h3>Login to <strong>Rentcam</strong></h3>
                <p class="mb-4">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                <form action="login.php" method="POST">
                    <div class="form-group first">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="email" name="email">
                    </div>
                    <div class="form-group last mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary rounded submit px-3" name="login" value="Masuk" />
                    </div>
                    <button onclick="window.location = '<?php echo $login_url; ?>'" type="button" class="btn btn-danger">Login with Google</button>
                </form>
                
            </div>
        </div>
    </div>
    <?php } ?>
</body>