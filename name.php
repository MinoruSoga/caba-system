<?php
require_once 'class/User.php';
$name = $_GET['get'];
$search_name = $_GET['search_name'];
$user = new User;
?>
<!doctype html>
<html lang="en">

<body>
  <?php include 'header.php' ?>
  <main class="mt-5">
    <div class="container">
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
          // array i 0 - name_id
          // array i 1 - name
          // array i 2 $a - bottle
          // array i 3 $b - No
          // array i 4 $c - cast_name
          // array i 5 $d - daytime
          $name_array = array();
          $result = $user->search_name($search_name);
          if($result){
            $i = 0;
            foreach($result as $row){
              $name_array[$i][0] = $row['name_id'];
              $name_array[$i][1] = $row['name'];
              $name_id = $name_array[$i][0];
              $name = $name_array[$i][1];
              echo "<tr>";
              echo "<th><a href='guest.php?id=$name_id&name=$name' class='text-dark'>".$name."</a></th>";
              $result = $user->get_guest_bottle($name_id);
              if($result){
                $a = 0;
                $b = 0;
                $d = 0;
                foreach($result as $row){
                  $bottle_name = $row['bottle_name'];
                  $No = $row['No'];
                  $daytime = $row['daytime'];
                  $daytime = substr($daytime,0,4) . "-" . substr($daytime,4,2)."-".substr($daytime,6);
                  $name_array[$i][2][$a] = $bottle_name;
                  $name_array[$i][3][$b] = $No;
                  $name_array[$i][5][$d] = $daytime;
                  $a++;
                  $b++;
                  $d++;
                }
                $result = $user->get_guest_cast($name_id);
                if($result){
                  $c = 0;
                  foreach($result as $row){
                    $cast_name = $row['cast_name'];
                    $name_array[$i][4][$c] = $cast_name;
                    $c++;
                  }
                }
              }

              $cnt = count($name_array[$i][2]);
                echo "<td>";
                for($n = 0; $n < $cnt; $n++){
                  echo $name_array[$i][2][$n];
                  echo "<br>";
                }
                echo "</td>";

                $cnt = count($name_array[$i][3]);
                echo "<td>";
                for($n = 0; $n < $cnt; $n++){
                  echo $name_array[$i][3][$n];
                  echo "<br>";
                }
                echo "</td>";

                $cnt = count($name_array[$i][4]);
                echo "<td>";
                for($n = 0; $n < $cnt_cast; $n++){
                  echo $name_array[$i][4][$n];
                  echo "<br>";
                }
                echo "</td>";

                $cnt = count($name_array[$i][5]);
                echo "<td>";
                for($n = 0; $n < $cnt; $n++){
                  echo $name_array[$i][5][$n];
                  echo "<br>";
                }
                echo "</td>";
                echo "</tr>";
              $i ++;
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
</body>

</html>