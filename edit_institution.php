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

          if($_SERVER['REQUEST_METHOD'] == "POST"){
            var_dump($_POST);
            $form_id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
            $form_name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
            $form_location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : "";
            $form_email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
            $form_address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : "";
            $form_phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
            $form_description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : "";
            $form_state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : "";
            
          $query = "UPDATE institutions SET name='$form_name',location='$form_location',email='$form_email',address='$form_address',phone='$form_phone',description='".$form_description."',state='$form_state' WHERE id=$form_id";
          $result = $conn->query($query);
          if($result === true){
            echo $form_description;
              header("Location: /lessions/home.php");
              exit();
          }else{
            $_SESSION['form_error'] = "error";
          }
          $conn->close();

        }else if($_SERVER['REQUEST_METHOD'] == 'GET'){
          
          $inst_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 0;
          $query = "SELECT * FROM institutions WHERE id=$inst_id";
               $result = $conn->query($query);
               if($result->num_rows > 0){
                 while($row = $result->fetch_assoc()){
                  $_SESSION["id"] =  $row['id'];
                  $_SESSION["name"] =  $row['name'];
                  $_SESSION["location"] = $row['location'];
                  $_SESSION["email"] = $row['email'];
                  $_SESSION["address"] = $row['address'];
                  $_SESSION["phone"] = $row['phone'];
                  $_SESSION["description"] = $row['description'];
                  $_SESSION["state"] = $row['state'];
                }
               }else{
                echo "Error";
                 $_SESSION['form_error'] = "error";

               }
               $conn->close();

        }
      ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Institution</title>
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
      <div class="row">
        <div class="col-md-6">
            <div class="mt-2"><h2>Edit institution Details</h2></div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id'] ?>">
                <div class="mb-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $_SESSION['name'] ?>">
                  </div>
                <div class="mb-3 mt-3">
                  <label for="location">Location:</label>
                  <input type="text" class="form-control" id="location" placeholder="Enter location" name="location" value="<?php echo $_SESSION['location'] ?> ">
                </div>
                <div class="mb-3">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $_SESSION['email'] ?> ">
                </div>
                <div class="mb-3">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="<?php echo $_SESSION['address'] ?> ">
                  </div>
                  <div class="mb-3">
                    <label for="phone">Phone number:</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="<?php echo $_SESSION['phone'] ?> ">
                  </div>
                  <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea class="form-control" rows="5" id="description" name="description"><?php echo $_SESSION['description'] ?></textarea> 
                  </div>
                  <div class="mb-3">
                  <label for="selectOption" class="form-label">Select State:</label>
                    <select class="form-select" id="state" name="state" aria-label="Select state" >
                      <option value="active" selected>active</option>
                      <option value="inactive">inactive</option>
                  </select>
                  </div>
                <button type="submit" class="btn btn-primary" style='background-color: #09abb8; border-color:#09abb8'>Update</button>
              </form>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>