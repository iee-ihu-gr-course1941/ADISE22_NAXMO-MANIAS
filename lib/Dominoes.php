<html>
  <head>
     <title>NAXMO/MANIA</title>
   </head>
   <body>
   <?php
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        $mysqli=connectDB();
        
        emf_hand();

        del_hand();
        
        emf_hand();
        
        emf_player();

        in_hand(102,24);

        emf_hand();

        del_row_hand(24);

        emf_hand();

        emf_dominoes();

        del_one_player(103);

        in_player('emena');

        emf_player();

        del_round();

        in_round(29);

        emf_round();

        del_round();

        emf_round();

        mysqli_close($mysqli);

        function clearStoredResults(){
          global $mysqli;
          while($mysqli->next_result()){
            if($l_result = $mysqli->store_result()){
                    $l_result->free();
            }
          }
        }

        function del_hand(){
          global $mysqli;
          $call="CALL empty_hand(@output);";
          mysqli_query($mysqli,$call);
          $select=mysqli_query($mysqli,"select @output as 'output';");
          $newrsult=mysqli_fetch_assoc($select);
          echo $newrsult['output'];
          clearStoredResults($mysqli);
        }

        function emf_hand(){
          global $mysqli;
          $totalresult=array();
          $call="CALL emf_hand();";
          if($result=mysqli_query($mysqli,$call)){
            if(mysqli_num_rows($result)>0){
              echo "emfanish";
              while($row=mysqli_fetch_array($result)){
                $totalresult[]=$row;
              }
            }else{
              echo "No records matching your query were found.";
            }
            if($totalresult!=null){
              foreach($totalresult as $key=>$value){
                echo "<p>".$value[0] . " ". $value[1]."</p>";
              }
            }
          }else{
            echo "ERROR: Could not able to execute $call. " . mysqli_error($mysqli);
          }
          clearStoredResults($mysqli);
        }

        function emf_player(){
          global $mysqli;
          $call="CALL emf_Player();";
          if($result=mysqli_query($mysqli,$call)){
            if(mysqli_num_rows($result)>0){
              echo "<table>";
                echo "<tr>";
                  echo "<th>ID</th>";
                  echo "<th>NAME</th>";
                  echo "<th>Victories</th>";
                  echo "<th>Defeats</th>";
                echo "</tr>";
              while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['pid'] . "</td>";
                    echo "<td>" . $row['name1'] . "</td>";
                    echo "<td>" . $row['Victories'] . "</td>";
                    echo "<td>" . $row['losts'] . "</td>";
                echo "</tr>";
              }
              echo "</table>";
            }else{
              echo "No records matching your query were found.";
          }
          }else{
            echo "ERROR: Could not able to execute $call. " . mysqli_error($mysqli);
          }
          clearStoredResults($mysqli);
        }

        function connectDB(){
          require_once "login.php";
          $host=$db_host;
          $db=$db_db;
          $user=$db_user;
          $pass=$db_pass;
          $path=$db_path;


          if(gethostname()=='users.iee.ihu.gr') {
            $mysqli = new mysqli($host, $user, $pass, $db,null,$path);
          } else {
                  $mysqli = new mysqli($host, $user, $pass, $db);
          }
          
          if ($mysqli->connect_errno) {
              echo "Failed to connect to MySQL: (" . 
              $mysqli->connect_errno . ") " . $mysqli->connect_error;
          }
          return $mysqli;
        }

        function in_hand(int $pid,int $did){
          global $mysqli;
          $call="call in_Hand(?,?);";
          $result=mysqli_prepare($mysqli,$call);
          $result->bind_param('ii',$pid,$did);
          $result->execute();
          clearStoredResults($mysqli);
        }

        function del_row_hand(int $did){
          global $mysqli;
          $call="CALL del_row_hand(?);";
          $result=mysqli_prepare($mysqli,$call);
          $result->bind_param('i',$did);
          $result->execute();
          clearStoredResults($mysqli);
        }

        function emf_dominoes(){
          global $mysqli;
          $totalresult=array();
          $call="call emf_dominoes();";
          if($result=mysqli_query($mysqli,$call)){
            if(mysqli_num_rows($result)>0){
              echo "emfanish";
              while($row=mysqli_fetch_array($result)){
                $totalresult[]=$row;
              }
            }else{
              echo "No records matching your query were found.";
            }
            if($totalresult!=null){
              foreach($totalresult as $key=>$value){
                echo "<p>".$value[0] . " ". $value[1]." ".$value[2]."</p>";
              }
            }
          }else{
            echo "ERROR: Could not able to execute $call. " . mysqli_error($mysqli);
          }
          clearStoredResults($mysqli);
        }

        function in_player(string $pname){
          global $mysqli;          
          $call="call in_player(?);";
          $result=mysqli_prepare($mysqli,$call);
          $result->bind_param('s',$pname);
          $result->execute();
          clearStoredResults($mysqli);
        }

        function del_one_player(int $pid){
          global $mysqli;
          $call="call del_row_player(?);";
          $result=mysqli_prepare($mysqli,$call);
          $result->bind_param('i',$pid);
          $result->execute();
          clearStoredResults($mysqli);
        }

        function emf_round(){
          global $mysqli;
          $totalresult=array();
          $call="call emf_round();";
          if($result=mysqli_query($mysqli,$call)){
            if(mysqli_num_rows($result)>0){
              while($row=mysqli_fetch_array($result)){
                $totalresult[]=$row;
              }
            }else{
              echo "No records matching your query were found.";
            }
            if($totalresult!=null){
              foreach($totalresult as $key=>$value){
                echo "<p>".$value[0] . " ". $value[1]." ".$value[2]."</p>";
              }
            }
          }else{
            echo "ERROR: Could not able to execute $call. " . mysqli_error($mysqli);
          }
          clearStoredResults($mysqli);
        }

        function del_round(){
          global $mysqli;
          $call="CALL empty_round(@output);";
          mysqli_query($mysqli,$call);
          $select=mysqli_query($mysqli,"select @output as 'output';");
          $newrsult=mysqli_fetch_assoc($select);
          echo $newrsult['output'];
          clearStoredResults($mysqli);
        }

        function in_round(int $point){
          global $mysqli;
          $call="call in_round(?,?,?);";
          $result=mysqli_prepare($mysqli,$call);
          $gyros=1;
          $pid=103;
          $result->bind_param('iii',$gyros,$pid,$point);
          $result->execute();
          clearStoredResults($mysqli);
        }
        ?>
 
    </body>
</html>
