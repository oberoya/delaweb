
<?php
    session_start();
    if(!isset($_SESSION["session_email"]) && !isset($_SESSION["session_name"])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="main.css">
    <title><?php echo $_SESSION['session_email']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['session_email']; ?></li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="auth">
                    <div class="form-flex">
                        <h5>Привет, <?php echo $_SESSION['session_name']; ?>!</h5>
                        <h5>Блок uLogin</h5>
                        <form action="logout.php">
                            <button type="submit" class="btn btn-danger" name="submit">Log out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>