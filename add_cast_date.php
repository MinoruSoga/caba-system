<?php
require_once 'class/User.php';
$name = $_GET['name'];
?>
<!doctype html>
<html lang="en">

<!-- <link rel="stylesheet" href="./css/chosen.css">
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script> -->

<head>
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/select2.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/select2.min.js"></script> -->
	<link rel="stylesheet" href="./css/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script> -->
	<script type="text/javascript" src="js/chosen.jquery.min.js"></script>
	<link href="css/chosen.min.css" rel="stylesheet">

</head>

<body>
<header class="sticky-top">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm bg-dark">
            <a class="navbar-brand text-white" href="index.php">Amateras</a>
            <a href="create_guest.php" class="text-white ml-5">新規顧客追加</a>
            <a href="register-bottle.php" class="text-white ml-3">ボトル名追加</a>
            <a href="register-cast.php" class="text-white ml-3">キャスト名追加</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item active">
                        <a class="nav-link " href="#">新規登録</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">ログアウト</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
	<main class="mt-5">
		<div class="container-fluid">
			<div class="row mb-2 ml-3">
			<h3><a href="create_guest.php" class="text-dark">新規顧客追加</a></h3>
			<button type="submit" name="submit" class="btn btn-primary ml-2">追加</button>
			</div>

			<form action="" method="post">
				<div class="row justify-content-center">
					<div class="col-2">
						<p class="text-center">名前</p>
						<input placeholder="名前" name="name" type="text" class="form-control mb-2" id="">
					</div>
					<div class="col-2">
						<p class="text-center">ボトル名</p>
						<select class="form-control w-100 bottle_select" name="bottle_id" size="10">
                <?php
                $user = new User;
                  $rows = $user->get_bottle();
                  foreach($rows as $bottles){
                    $bottle_name = $bottles['bottle_name'];
                    $bottle_id = $bottles['bottle_id'];
                    ?>
                    <option value="<?php echo $bottle_id ?>" class="text-center"><?php echo $bottle_name ?></option>
                    <?php
                  }
                  ?>
              </select>
					</div>
					<div class="col-2">
						<p class="text-center">No</p>
						<input placeholder="No" name="No" type="text" class="form-control mb-2" id="">
					</div>

					<div class="col-2">
						<p class="text-center">キャスト</p>
						<?php

                  $rows = $user->get_cast();
                  foreach($rows as $casts){
                    $cast_name = $casts['cast_name'];
                    $cast_id = $casts['cast_id'];
                    ?>
							<input type="checkbox" class="check_box" id="<?php echo $cast_id ?>" name="cast_id[]" />
							<label class="label  select w-100 text-center" for="<?php echo $cast_id ?>" ><?php echo $cast_name ?></label>
							<?php
                  }
              ?>
					</div>
					<div class="col-4 ">
						<p class="text-center">日付</p>
						<div class="form-row">

							<select class="form-control day col-md-4" name="year">
								<?php
                $year = date('Y');
                // echo $year;
                for($i = 1; $i <= 5;$i ++){
                  echo "<option>".$year."</option>";
                  $year --;
                }
                  
                  ?>
							</select>
							<select class="form-control day col-md-4" name="month">
								<?php
                for($m = 1; $m <= 12; $m ++){
                  echo "<option>".$m."</option>";
                }
                  ?>
							</select>
							<select class="form-control day col-md-4" name="day">
								<?php
                for($d = 1; $d <= 31; $d ++){
                  echo "<option>".$d."</option>";
                }
                  ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			</form>
			<?php
            if(isset($_POST['submit'])){
              $name = $_POST['name'];
              $bottle_id = $_POST['bottle_id'];
              $No = $_POST['No'];
              $cast_id = $_POST['cast_id'];
              $year = $_POST['year'];
              $month = $_POST['month'];
              $day = $_POST['day'];
              if($month <= 10){
                $month = '0'.$month;
              }
              if($day <= 10){
                $day = '0'.$day;
              }
              $date = $year.$month.$day;
              
              $user->add_date($name, $bottle_id, $No, $cast_id, $date);
            }
          ?>

		</div>
	</main>


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