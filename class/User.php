<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<?php
  require_once "Config.php";

  class User extends Config{

    // public function insert($name, $bottle, $cast, $date){
    //     $sql1 = "INSERT INTO "
    // }

    public function add_bottle($bottle){
        $sql1 = "SELECT * FROM bottle WHERE bottle_name = '$bottle' ";
        if($this->conn->query($sql1)->num_row > 0){
            echo "<h3 class = 'container text-center mt-3 text-danger'>'Username is already taken'</h3>";
        }
        $sql = "INSERT INTO bottle(bottle_name) VALUES('$bottle')";
        $result = $this->conn->query($sql);
        if($result){
            $this->redirect_js('index.php');
        }else{
          echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
        }

    }
    public function add_cast($cast){
        $sql1 = "SELECT * FROM cast_name WHERE cast_name = '$cast' ";
        if($this->conn->query($sql1)->num_row > 0){
            echo "<h3 class = 'container text-center mt-3 text-danger'>'Username is already taken'</h3>";
        }
        $sql = "INSERT INTO cast_name(cast_name) VALUES('$cast')";
        $result = $this->conn->query($sql);
        if($result){
            $this->redirect_js('index.php');
        }else{
          echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
        }

    }
    public function get_bottle(){
         //query
         $sql = "SELECT * FROM bottle";
         $result = $this->conn->query($sql);
         // $sched = $result->fetch_assoc();
         $rows = array();
         if($result->num_rows > 0){
           while($row = $result->fetch_assoc()){
             $rows[] = $row;
           }
           return $rows;
         }
         else{
           return $this->conn->error;
         }
         }
    public function get_cast(){
         //query
         $sql = "SELECT * FROM cast_name ORDER BY cast_name ASC";
         $result = $this->conn->query($sql);
         $rows = array();
         if($result->num_rows > 0){
           while($row = $result->fetch_assoc()){
             $rows[] = $row;
           }
           return $rows;
         }
         else{
           return $this->conn->error;
         }
         }

        public function add_date($name, $bottle_id, $No, $cast_id, $date){
            // $sql = "INSERT INTO guest_date(bottle_id, No, cast_id, daytime) VALUES('$bottle_id', '$No', '$cast_id', '$date')";
            // $result = $this->conn->query($sql);
            // $guest_date_id = $this->conn->insert_id;
            // if($result){
            //     $sql2 = "INSERT INTO guest(name, guest_date_id) VALUES('$name', '$guest_date_id')";
            //     $result = $this->conn->query($sql2);
            //     if($result){
            //         $this->redirect_js('index.php');
            //     }else{
            //         echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
            //     }
            // }else{
            //     echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
            // }
          //   $sql = "INSERT INTO guest(name) VALUES('$name')";
          //   $result = $this->conn->query($sql);
          //   $name_id = $this->conn->insert_id;
          //   if($result){
          //     $sql2 = "INSERT INTO guest_date(name_id, bottle_id, No, cast_id, daytime) VALUES('$name_id', '$bottle_id', '$No', '$cast_id', '$date')";
          //     $result = $this->conn->query($sql2);
          //     if($result){
          //       $this->redirect_js('index.php');
          //     }else{
          //       echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
          //       }
          //   }else{
          //       echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
          //   }
          // }
            $sql = "INSERT INTO guest(name) VALUES('$name')";
            // echo $name, $bottle_id, $No, $cast_id, $date;
            $result = $this->conn->query($sql);
            $name_id = $this->conn->insert_id;
            if($result){
              $sql2 = "INSERT INTO guest_bottle(name_id, bottle_id, No, daytime) VALUES('$name_id', '$bottle_id', '$No', '$date')";
                $result = $this->conn->query($sql2);

              if($result){
                // var_dump($cast_id);
                foreach($cast_id as $val){
                  // echo $val;
                  // var_dump($val);
                  $sql3 = "INSERT INTO guest_cast(name_id, cast_id) VALUES('$name_id', '$val')";
                  $result = $this->conn->query($sql3);
                }
                if($result){
                  $this->redirect_js('index.php');
                }else{
                  echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
                  }
                }else{
                  echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
                }
              }
          }
        // index.php 表示-----------------------------------------
        public function get_guest_name(){
          $sql = "SELECT guest.name_id, guest.name
          FROM guest";
          $result = $this->conn->query($sql);
          $rows = array();
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $rows[] = $row;
            }
            return $rows;
          }else{
            return $this->conn->error;
          }
        }
        // ゲストボトル and name.php search bottle of name--------------------------------------------
        public function get_guest_bottle($name_id){
          $sql = "SELECT bottle.bottle_name, guest_bottle.No, guest_bottle.daytime
          FROM bottle
          INNER JOIN guest_bottle ON bottle.bottle_id = guest_bottle.bottle_id
          WHERE $name_id = guest_bottle.name_id";
          $result = $this->conn->query($sql);
          $rows = array();
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $rows[] = $row;
            }
            return $rows;
          }else{
            return $this->conn->error;
          }
        }
        
        // ゲストキャスト------------------------------------------
        public function get_guest_cast($name_id){
          $sql = "SELECT cast_name.cast_name
          FROM guest_cast
          INNER JOIN cast_name ON guest_cast.cast_id = cast_name.cast_id
          WHERE $name_id = guest_cast.name_id";
          $result = $this->conn->query($sql);
          $rows = array();
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                $rows[] = $row;
              }
              return $rows;
            }else{
              return $this->conn->error;
            }
        }
          // 非表示----------------------------------------------
        public function get_guest_date(){

        // $sql = "SELECT guest.name, guest_date.No, guest_date.daytime, bottle.bottle_name
        // FROM guest_date, guest, bottle
        // WHERE guest_date.guest_date_id = guest.guest_date_id AND guest_date.bottle_id = bottle.bottle_id";

        $sql = "SELECT guest.name, bottle.bottle_name, guest_date.No, cast_name.cast_name, guest_date.daytime
        FROM guest_date, guest, bottle, cast_name
        WHERE guest_date.name_id = guest.name_id and guest_date.bottle_id = bottle.bottle_id and guest_date.cast_id = cast_name.cast_id";

        $result = $this->conn->query($sql);
        $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                    
                }
                return $rows;
            }else{
                return $this->conn->error;
            }
        
        }
        
        public function get_guest_date_name(){
        $sql = "SELECT guest.name, bottle.bottle_name, guest_date.No, cast_name.cast_name, guest_date.daytime
        FROM guest_date, guest, bottle, cast_name
        WHERE guest_date.guest_date_id = guest.guest_date_id and guest_date.bottle_id = bottle.bottle_id and guest_date.cast_id = cast_name.cast_id
        ORDER BY guest.name DESC";

        $result = $this->conn->query($sql);
        $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                    
                }
                return $rows;
            }else{
                return $this->conn->error;
            }
        
        }
        // ------------------------------------------------------
        public function get_guest_date_bottle(){
        $sql = "SELECT guest.name, bottle.bottle_name, guest_date.No, cast_name.cast_name, guest_date.daytime
        FROM guest_date, guest, bottle, cast_name
        WHERE guest_date.guest_date_id = guest.guest_date_id and guest_date.bottle_id = bottle.bottle_id and guest_date.cast_id = cast_name.cast_id
        ORDER BY bottle.bottle_name DESC, guest_date.No ASC";

        $result = $this->conn->query($sql);
        $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                    
                }
                return $rows;
            }else{
                return $this->conn->error;
            }
        
        }
        public function get_guest_date_cast(){
        $sql = "SELECT guest.name, bottle.bottle_name, guest_date.No, cast_name.cast_name, guest_date.daytime
        FROM guest_date, guest, bottle, cast_name
        WHERE guest_date.guest_date_id = guest.guest_date_id and guest_date.bottle_id = bottle.bottle_id and guest_date.cast_id = cast_name.cast_id
        ORDER BY cast_name.cast_name DESC";

        $result = $this->conn->query($sql);
        $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                    
                }
                return $rows;
            }else{
                return $this->conn->error;
            }
        
        }
        public function get_guest_date_day(){
        $sql = "SELECT guest.name, bottle.bottle_name, guest_date.No, cast_name.cast_name, guest_date.daytime
        FROM guest_date, guest, bottle, cast_name
        WHERE guest_date.guest_date_id = guest.guest_date_id and guest_date.bottle_id = bottle.bottle_id and guest_date.cast_id = cast_name.cast_id
        ORDER BY guest_date.daytime ASC";

        $result = $this->conn->query($sql);
        $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                    
                }
                return $rows;
            }else{
                return $this->conn->error;
            }
        
        }
        public function get_bottle_date($name, $bottle_id, $No, $cast_id, $date){
          $sql = "SELECT guest.name, bottle.bottle_name, guest_date.No, cast_name.cast_name, guest_date.daytime
        FROM guest_date, guest, bottle, cast_name
        WHERE guest_date.guest_date_id = guest.guest_date_id 
        and guest_date.bottle_id = bottle.bottle_id 
        and guest_date.cast_id = cast_name.cast_id
        and guest.name = $name
        ORDER BY guest_date.daytime ASC";

        $result = $this->conn->query($sql);
        $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                    
                }
                return $rows;
            }else{
                return $this->conn->error;
            }
        }
        // $sql = "INSERT INTO guest(name) VALUES('$name')";
        //     $result = $this->conn->query($sql);
        //     $name_id = $this->conn->insert_id;
        //     if($result){
        //       $sql2 = "INSERT INTO guest_date(name_id, bottle_id, No, cast_id, daytime) VALUES('$name_id', '$bottle_id', '$No', '$cast_id', '$date')";
        //       $result = $this->conn->query($sql2);
        //       if($result){
        //         $this->redirect_js('index.php');
        //       }else{
        //         echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
        //         }
        //     }else{
        //         echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
        //     }
        //   }

        // add_bottle_date.php-----------------------
        public function add_bottle_date($name_id, $bottle_id, $No, $date){
          $sql = "INSERT INTO guest_bottle(name_id, bottle_id, No, daytime) VALUES('$name_id', '$bottle_id', '$No', '$date')";
            // echo $name, $bottle_id, $No, $cast_id, $date;
            $result = $this->conn->query($sql);
              if($result){
                $this->redirect_js('index.php');
              }else{
                echo "<h1 class='text-white'>Error in inserting record " .$this->conn->error."</h1>";
              }
              
          }
          // index.php search name-----------------------------------
          public function search_name($search_name){
            $sql = "SELECT * FROM guest WHERE name LIKE '%$search_name%' 
            ORDER BY name";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                $rows[] = $row;
              }
              return $rows;
            }else{
              return $this->conn->error;
            }
          }
          // name.php search bottle of name------------------------------
        
  }
  