<?php
require_once "class/User.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Register-cast</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/register.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<?php include 'header.php' ?>
    <div class="container text-center top">
        <form action="" method="post">
            <div class="form-group">
                <label for="">キャスト名追加</label>
                <input type="text" name="cast" class="form-control" id="" placeholder="キャスト名">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-0">追加</button>
        </form>
    </div>

    <?php
            if(isset($_POST['submit'])){
                
              $cast = $_POST['cast'];
            //   echo $cast;
              $user = new User;
              $user->add_cast($cast);

            }
          ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>