<?php
require_once 'class/User.php';
$user = new User;
?>
<!doctype html>
<html lang="en">

  <head>
</head>

<body>
  <?php include 'header.php' ?>
  <main class="mt-5">
    <div class="container">
      <h3><a href="index.php" class="text-dark">顧客管理</a></h3>
      <div>
        <form action="name.php" method="get" class="form-inline">
          <div class="form-group mx-sm-2">
            <input type="text" class="form-control w-30" placeholder="名前" name="search_name">
          </div>
          <button type="" class="btn btn-secondary ml-3">名前検索</button>
        </form>
        <?php 
          // if(isset($_GET['submit'])){
          //   $search_name = $_GET['search_name'];
          //   $user->search_name($search_name);
          // }
                  ?>
      </div>
      <table class="table table-striped mt-2">
        <thead>
          <tr>
            <th scope="col">名前</th>
            <th scope="col">ボトル名</th>
            <th scope="col">No</th>
            <th scope="col">キャスト名</th>
            <th scope="col">日付</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $result = $user->get_guest_name();
            if($result){
              foreach($result as $row){
                echo "<tr>";
                $int = $row['name_id'];
                $name = $row['name'];
                $name_id = (int)$int;
                echo "<th><a href='guest.php?id=$name_id&name=$name' class='text-dark'>".$name."</a></th>";
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
                
              }
            }
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
  <!-- <script type="text/javascript">
    $(".chzn-select").chosen();
    $(".chzn-select-deselect").chosen({
      allow_single_deselect: true
    });
  </script> -->
</body>

</html>