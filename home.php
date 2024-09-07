
<?php
  session_start();
  if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
    header('location: login.php');
    exit();
  }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WElCOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php
        require('partials/_nav.php');
    ?>

<?php
        if(isset($_GET['alert']) && $_GET['alert'] == 'true'){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Wecome!</strong> to home page.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
?>

    <p>
      Welcome - <?php echo $_SESSION['email']; ?>
    </p>
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