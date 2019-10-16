<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="main.css">
    <title>Sign up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sign up</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="signup-window" >
                    <form action="reg.php" class="form-flex" method="post">
                        <div class="form-group">
                          <input type="text" class="form-control" id="fname" name="fname" aria-describedby="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" id="reg" name="reg">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>