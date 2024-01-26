<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: /lessions/login.php");
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

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
          
        $inst_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 0;
        $query = "DELETE FROM institutions WHERE id=$inst_id";
        echo $query;
             $result = $conn->query($query);
             if($result > 0){
               header("Location: /lessions/manage.php");
             }else{
               $_SESSION['form_error'] = "error";

             }
             $conn->close();

      }else{
        header("Location: /lessions/home.php");
      }

?>