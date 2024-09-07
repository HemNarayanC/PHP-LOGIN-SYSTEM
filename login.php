

<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include('partials/_dbconnect.php');
        $useremail = $_POST['useremail'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `users` WHERE `email` = '$useremail'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        
        if($num == 1){
          while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
              session_start();
              $_SESSION['loggedIn'] = true;
              $_SESSION['email'] = $useremail;
              header('Location: home.php?alert=true');
            }

            else{
              header('Location: login.php?alert=false');
            }
          }
        }
        else{
            header('Location: login.php?alert=nomatch');
        }
    }
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .container{
            width: 600px;
            min-height: 60vh;
        }
    </style>
  </head>
  <body>
    <?php
        require('partials/_nav.php');
    ?>

    <!-- successful signup alert -->
    <?php

        if(isset($_GET['alert']) && $_GET['alert'] == 'true'){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Signup complete! We're excited to have you with us.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        } elseif(isset($_GET['alert']) && $_GET['alert'] == 'false'){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Password not matched. Please try again.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        } elseif(isset($_GET['alert']) && $_GET['alert'] == 'nomatch'){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Invalid Credentials.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
?>


    <div class="container">
        <h1 class="text-center">Login Page</h1>
        <form action="login.php" method="post">
        <div class="mb-3 col-md-12">
            <label for="useremail" class="form-label">Email</label>
            <input type="email" class="form-control" id="useremail" name="useremail" aria-describedby="emailHelp" autocomplete="off">
        </div>

        <div class="mb-3 col-md-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary col-md-12">Login</button>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.alert').forEach(function (alert) {
            alert.addEventListener('closed.bs.alert', function () {
                // Update URL after alert is closed
                let url = new URL(window.location.href);
                url.searchParams.delete('alert');
                history.replaceState(null, '', url);
            });
            });
        });
    </script>

  </body>
</html>