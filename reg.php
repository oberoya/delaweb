<?php
require_once ('connect_db.php');
if(isset($_POST["reg"])) {
    $name = htmlspecialchars($_POST['fname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $query="INSERT INTO users (first_name, email, pass)
        VALUES ('$name', '$email', '$password')";
    $some = $pdo->query($query);
	header("location:index.php");
} else {
    echo 'shit';
}
?>
