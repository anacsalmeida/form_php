<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="card" style="width: 18rem;">

        <div class="card-body">
            <?php session_start(); ?>
        </div>

        <div class="card-body">
            <h5 class="card-text"><?php echo $_SESSION['email']; ?></h5>
        </div>

        <div class="card-body">
            <h5 class="card-text"><?php echo $_SESSION['nome']; ?></h5>
        </div>

    </div>
  </body>
</html>
