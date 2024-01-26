<?php
          session_start();
          if(!isset($_SESSION['user_id'])){
            header("Location: /assetm/login.php");
            exit();
          }

          if($_SERVER['REQUEST_METHOD'] == "POST"){
            $form_name = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
            $form_location = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : "";
            $form_email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
            $form_address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : "";
            $form_phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
            $form_description = isset($_POST['decription']) ? htmlspecialchars($_POST['description']) : "";
  
            $db_username = "root";
            $db_password = "";
            $db_hostname = "localhost";
            $db_database = "pppc_asset_manager";
  
            $conn = new mysqli($db_hostname, $db_username, $db_password,$db_database);
            if($conn->connect_error){
              die("<p>Failed to connect to the database</p>");
            }
          $query = "INSERT INTO institutions (name,location,email,address,phone,description,state) VALUES('$form_name','$form_location','$form_email','$form_address','$form_phone','$form_description','active')";
          $result = $conn->query($query);
          if($result === true){
              $_SESSION['message'] = "Institution Registered"; 
              header("Location: /lessions/home.php");
          }else{
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
    <title>Register Institution</title>
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
            <div class="mt-2"><h2>Register an Institution</h2></div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="mb-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                  </div>
                <div class="mb-3 mt-3">
                  <label for="location">Location:</label>
                  <input type="text" class="form-control" id="location" placeholder="Enter location" name="location">
                </div>
                <div class="mb-3">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
                  </div>
                  <div class="mb-3">
                    <label for="phone">Phone number:</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone">
                  </div>
                  <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea class="form-control" rows="5" id="description" name="description"></textarea> 
                  </div>
                <button type="submit" class="btn btn-primary" style='background-color: #09abb8; border-color:#09abb8'>Submit</button>
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