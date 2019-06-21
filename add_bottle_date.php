<?php
require_once 'class/User.php';
$name_id = $_GET['id'];
$name = $_GET['name'];
$user = new User;
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
				<div class="collapse navbar-collapse justify-content-end">
					<ul class="navbar-nav">
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
				<?php echo "<h3><a href='guest.php?id=$name_id&name=$name' class='text-dark'>".$name."</a></h3>"; ?>
				<h3><a href="create_guest.php" class="text-dark ml-3">ボトル</a></h3>
			</div>

			<form action="" method="post">
				<div class="row justify-content-center">
					<input class="form-control" type='hidden' name='name_id' value='<?php echo $name_id; ?>'>
					<div class="col-2">
						<p class="text-center">ボトル名</p>
						<select class="form-control w-100 bottle_select" name="bottle_id" size="10">
							<?php
                  $rows = $user->get_bottle();
                  foreach($rows as $bottles){
                    $bottle_name = $bottles['bottle_name'];
                    $bottle_id = $bottles['bottle_id'];
                    ?>
							<option value="<?php echo $bottle_id ?>" class="text-center"><?php echo $bottle_name ?>
							</option>
							<?php
                  }
                  ?>
						</select>
					</div>
					<div class="col-2">
						<p class="text-center">No</p>
						<input placeholder="No" name="No" type="text" class="form-control mb-2" id="">
					</div>
					<div class="col-4">
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
				<button type="submit" name="submit" class="btn btn-primary ml-2">追加</button>
		</div>
		</form>
		<?php
				if(isset($_POST['submit'])){
					$name_id = $_POST['name_id'];
					$bottle_id = $_POST['bottle_id'];
					$No = $_POST['No'];
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
					
					$user->add_bottle_date($name_id, $bottle_id, $No, $date);
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