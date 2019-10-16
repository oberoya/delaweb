<?php
    require_once('recaptchalib.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="main.css">
    <title>delaweb</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
        <?php
            $_SESSION['countTrying'] = 0;

            session_start();
            require_once ('connect_db.php');
            if(isset($_SESSION["session_email"]) && isset($_SESSION["session_name"])) { 
                header("Location: userpage.php"); 				
            } 
            if (isset($_POST["login"])) { 
                if(!empty($_POST['email']) && !empty($_POST['password'])) {
                    
                    if ($_SESSION['countTrying'] >= 3) {
                        $secret = "6Lcmmr0UAAAAAHaqrp_eE6S6xBXM39ouUbYGAZTM";
                        $response = null;
                        $reCaptcha = new ReCaptcha($secret);
                    
                        if (!empty($_POST)) {
                            if ($_POST["g-recaptcha-response"]) {
                                $response = $reCaptcha->verifyResponse(
                                    $_SERVER["REMOTE_ADDR"],
                                    $_POST["g-recaptcha-response"]
                                );
                            }
                            if ($response != null && $response->success) {
                                echo "Кепшка пройдена.";
                                $checking = true;
                                $_SESSION['countTrying'] = 0;
                            } else {
                                echo "Вы точно человек?";
                                $checking = false;
                            }
                        
                        }
                    }
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $query="SELECT * FROM users WHERE email = '" .$email."' AND pass='".$password."'";
                    $some = $pdo->query($query);
                    while($smg = $some->fetch()){
                        $dbname = $smg['first_name'];
                        $dbemail = $smg['email'];
                        $dbpass = $smg['pass'];
                    }
                    if ($email == $dbemail && $password == $dbpass && ($checking or !isset($checking))) {
                        $_SESSION['session_name'] = $dbname;
                        $_SESSION['session_email'] = $email;
                        $_SESSION['countTrying'] = 0;
                        header("Location: userpage.php");
                    } else {
                    echo "Неправильные логин или пароль";
                    $_SESSION['countTrying']++;
                    echo " Количество попыток входа: " . $_SESSION['countTrying'];
                    }
                } else {
                    echo 'Не заполнены поля';
                }
            } else {
                echo 'Ещё ниче не ввел';
            }
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Main page</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="auth" id="login">
                    <form action="" method="post" class="form-flex">
                        <div class="form-group">
                          <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <?php
                            if ($_SESSION['countTrying'] > 2) {

                                echo '
                                <div class="g-recaptcha" data-sitekey="6Lcmmr0UAAAAAERm_BEXqG4VT1jJWk0Tat9o_boy" data-theme="dark"></div>
                                ';
                            }
                        ?>
                        <div class="buttons">
                            <button type="submit" class="btn btn-primary" name="login" id="login">
                                Sign in
                            </button>
                            <!--<button type="submit" class="btn btn-primary">
                                uLogin
                            </button>-->
                            <a href="signup.php">
                                Sign up
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    </body>
</html>