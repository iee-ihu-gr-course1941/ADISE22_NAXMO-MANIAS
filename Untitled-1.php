<html>
  <head>
     <title>My first php</title>
   </head>
   <body>
   <?php
        //it175118@127.0.0.1:3333
        $host='127.0.0.1:3333';
        $username='it175118';
        $password='ergasia1';
        $db='ergasia';

        require_once "login.php";
        $user=$DB_USER;
        $pass=$DB_PASS;


        if(gethostname()=='users.iee.ihu.gr') {
          $mysqli = new mysqli($host, $user, $pass, $db,null,'/home/student/it/2017/it175118/mysql/run/mysql.sock');
        } else {
                $mysqli = new mysqli($host, $user, $pass, $db);
        }
        
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . 
            $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        $sql="select * from Players;";

        if($result=mysqli_query($mysqli,$sql)){
          if(mysqli_num_rows($result)>0){
            echo "<table>";
              echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Wins</th>";
                echo "<th>Defeats</th>";
              echo "</tr>";
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
                  echo "<td>" . $row['Pname'] . "</td>";
                  echo "<td>" . $row['Wins'] . "</td>";
                  echo "<td>" . $row['Defeats'] . "</td>";
              echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
          }else{
            echo "No records matching your query were found.";
        }
        }else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_close($mysqli);
        ?>
 
    </body>
</html>
