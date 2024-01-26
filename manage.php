<?php
          session_start();
          if(!isset($_SESSION['user_id'])){
            header("Location: /assetm/login.php");
            exit();
          }

  
            $db_username = "root";
            $db_password = "";
            $db_hostname = "localhost";
            $db_database = "pppc_asset_manager";
  
          $conn = new mysqli($db_hostname, $db_username, $db_password,$db_database);
          if($conn->connect_error){
            die("<p>Failed to connect to the database</p>");
          }
      ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Institutions</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container">
    <?php include("navigation.php"); ?>
      <h2 class="mt-2">Institutions</h2>

      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Location</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contanct</th>
            <th>Desription</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
            <?php
               $query = "SELECT * FROM institutions";
               $result = $conn->query($query);
               if($result->num_rows > 0){
                 while($row = $result->fetch_assoc()){
                  echo "<tr>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['name']."</td>";
                  echo "<td>".$row['location']."</td>";
                  echo "<td>".$row['email']."</td>";
                  echo "<td>".$row['address']."</td>";
                  echo "<td>".$row['phone']."</td>";
                  echo "<td>".$row['description']."</td>";
                  echo "<td><a href='/assetm/edit_institution.php?id=".$row['id']."' class='btn btn-primary' style='background-color: #09abb8; border-color:#09abb8'>Edit</a> <a href='/assetm/delete.php?id=".$row['id']."' class='btn btn-danger'>Delete</a></td>";
                  echo "</tr>";
                }
               }else{
                 $_SESSION['form_error'] = "error";
               }
               $conn->close();
            ?>
        </tbody>
      </table>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>