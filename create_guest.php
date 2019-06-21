<?php
require_once 'class/User.php';
?>
<!doctype html>
<html lang="en">
	<head>
		<title>追加</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</html>

<head>

	<link rel="stylesheet" href="./css/main.css">

</head>

<body>
	<?php include 'header.php' ?>
	<main class="mt-5">
		<div class="container-fluid">
			<div class="row mb-2 ml-3">
				<h3><a href="create_guest.php" class="text-dark">新規顧客追加</a></h3>
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
						<input placeholder="No" name="No" type="number" class="form-control mb-2" id="">
					</div>

					<div class="col-2">
						<p class="text-center">キャスト</p>
						<?php

                  $rows = $user->get_cast();
                  foreach($rows as $casts){
                    $cast_name = $casts['cast_name'];
                    $cast_id = $casts['cast_id'];
                    ?>
						<input type="checkbox" class="check_box" id="<?php echo $cast_id ?>" name="id[]"
							value="<?php echo $cast_id ?>" />
						<label class="label  select w-100 text-center" for="<?php echo $cast_id ?>"><?php echo $cast_name ?></label>
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
				<button type="submit" name="submit" class="btn btn-primary ml-2">追加</button>
		</div>

		</form>
		<?php
            if(isset($_POST['submit'])){
              $name = $_POST['name'];
              $bottle_id = $_POST['bottle_id'];
              $No = $_POST['No'];
              $cast_id = $_POST['id'];
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