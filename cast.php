<?php
require_once 'class/User.php';
?>
<!doctype html>
<html lang="en">

<body>
  <?php include 'header.php' ?>
  <main class="mt-5">
    <div class="container">
    <h3><a href="index.php" class="text-dark">顧客管理</a></h3>
      <div>
        <a href="name.php">名前順</a>
        <a href="bottle.php">ボトル名順</a>
        <a href="cast.php">キャスト名順</a>
        <a href="day.php">日付順</a>
      </div>
      <h3><a href="register-cast.php" class="text-dark">キャスト名追加</a></h3>
      <form>
        <div class="form-row align-items-center">
          <div class="col-auto">
            <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Jane Doe">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
          </div>
        </div>
      </form>
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
            $user = new User;
            $result = $user->get_guest_date_cast();
            if($result){
              foreach($result as $row){
                $name = $row['name'];
                $daytime = $row['daytime'];
                $daytime = substr($daytime,0,4) . "-" . substr($daytime,4,2)."-".substr($daytime,6);
                echo "<tr>";
                echo "<th><a href='guest.php?name=$name' class='text-dark'>".$row['name']."</a></th>";
                echo "<td>".$row['bottle_name']."</td>";
                echo "<td>".$row['No']."</td>";
                echo "<td>".$row['cast_name']."</td>";
                echo "<td>".$daytime."</td>";
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
</body>

</html>