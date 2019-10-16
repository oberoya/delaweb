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
            $_SESSION['countTrying'] = 0;// Сессионный счетчик неправильных вводов

            session_start();// Начало сессии
            require_once ('connect_db.php');//Подключение к файлу, которые отвечает за подключение к бд
            if(isset($_SESSION["session_email"]) && isset($_SESSION["session_name"])) { //Если установлены сессионные переменные почты и имени
                header("Location: userpage.php"); // Если установлены, то переходим на страницу пользователя			
            } //т.к. не установлены переменные продолжаем разговор
            if (isset($_POST["login"])) { //Если по методу пост name="login", идем дальше (else говорим, что ничего не происходило)
                if(!empty($_POST['email']) && !empty($_POST['password'])) {// Если в input c name="email" and name="password" есть что-то,
                                                                           //то идем дальше (else говорим, что поле(-я) пустые 
                    
                    if ($_SESSION['countTrying'] >= 3) { // Производим проверку на количество неверхных вводов данных для вывода капшки
                        $secret = "6Lcmmr0UAAAAAHaqrp_eE6S6xBXM39ouUbYGAZTM";               //(else идем дальше без капшки)
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
                    $email = htmlspecialchars($_POST['email']);// В $mail присваиваем значение с name="email" и дальше по аналогии
                    $password = htmlspecialchars($_POST['password']);
                    $query="SELECT * FROM users WHERE email = '" .$email."' AND pass='".$password."'";// В $query присваиваем результат запросы выборки
                    $some = $pdo->query($query); // В $some присваиваем массив из функции $pdo->query //Выбрать все из таблицы users где в колонке email
                                                 //которая выполняет запрос к подключенной БД          //значение равно $email и pass тоже самое
                    while($smg = $some->fetch()){  //Пока $smg, в которой функция извлечения строки из результирующего набора, true     
                        $dbname = $smg['first_name']; //$dbname присваиваем значение из этого запроса
                        $dbemail = $smg['email']; 
                        $dbpass = $smg['pass'];
                    }
                    // Если данные из полей совпадают с данными из БД и была пройдена кепшка (или не установлена кепшка)
                    if ($email == $dbemail && $password == $dbpass && ($checking or !isset($checking))) { 
                        $_SESSION['session_name'] = $dbname; //В сессионное имя присваиваем имя из бд
                        $_SESSION['session_email'] = $email;
                        $_SESSION['countTrying'] = 0; //Обнуляется счетчик неправильных вводов
                        header("Location: userpage.php"); //Переход на страницу userpage.php (где уже работаем с сессионными переменными)
                    } else {
                    echo "Неправильные логин или пароль";
                    $_SESSION['countTrying']++; //Добавить +1 к счетчку неправильных вводов
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
