<?php
$name_id = $_GET['id'];
$name = $_GET['name'];
require_once 'class/User.php';
$user = new User;
// echo $name;
?>
<!doctype html>
<html lang="en">

<head>
    <title><?php echo $name; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        <div class="container">
            <h3>
                名前：<?php echo $name;?>
            </h3>
            <div>
                <?php 
                echo "<a href='add_bottle_date.php?id=$name_id&name=$name' class='text-dark'>ボトル追加</a>";
                echo "<a href='add_cast_date.php?id=$name_id&name=$name' class='text-dark ml-3'>キャスト追加</a>";
                
                ?>
                <!-- <a href="add_bottle_date.php?id=<?php echo $name_id;?>&name<?php echo $name;?>">ボトル追加</a> -->
                <!-- <a href="add_cast_date.php?name=<?php?>">キャスト追加</a> -->
            </div>
            <table class="table table-striped mt-2">
                <thead>
                    <tr>
                        <th scope="col">ボトル名</th>
                        <th scope="col">No</th>
                        <th scope="col">キャスト名</th>
                        <th scope="col">日付</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
								echo "<tr>";
								$bottle_array = array();
                $cast_array = array();
                $a = 0;
                $b = 0;
                $result = $user->get_guest_bottle($name_id);
                if($result){
                  foreach($result as $row){
                    $bottle_name = $row['bottle_name'];
                    $No = $row['No'];
                    $daytime = $row['daytime'];
                    $daytime = substr($daytime,0,4) . "-" . substr($daytime,4,2)."-".substr($daytime,6);
                    $bottle_array[0][$a] = $bottle_name;
                    $bottle_array[1][$a] = $No;
                    $bottle_array[2][$a] = $daytime;
                    $a ++;
                  }
                    $result = $user->get_guest_cast($name_id);
                    if($result){
                      foreach($result as $row){
                        $cast_name = $row['cast_name'];
                        $cast_array[$b] = $cast_name;
                        $b ++;
                      }
                    }
                	}
									$cnt = count($bottle_array[0]);
                
									echo "<td>";
									for($i = 0; $i < $cnt; $i++){
										echo $bottle_array[0][$i];
										echo "<br>";
									}
									echo "</td>";
									$cnt = count($bottle_array[1]);
									echo "<td>";
									for($i = 0; $i < $cnt; $i++){
										echo $bottle_array[1][$i];
										echo "<br>";
									}
									echo "</td>";
									$cnt_cast = count($cast_array);
									echo "<td>";
									for($i = 0; $i < $cnt_cast; $i++){
										echo $cast_array[$i];
										echo "<br>";
									}
									echo "</td>";
									$cnt = count($bottle_array[2]);
									echo "<td>";
									for($i = 0; $i < $cnt; $i++){
										echo $bottle_array[2][$i];
										echo "<br>";
									}
									echo "</td>";
									echo "</tr>";
                
          ?>
                </tbody>
            </table>
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