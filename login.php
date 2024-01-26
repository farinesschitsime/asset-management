<?php
          session_start();
          if(isset($_SESSION['user_id'])){
            header("Location: /lessions/home.php");         
            exit();
          }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
          $formname = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
          $formpassword = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : "";
          $hashed_password = md5($formpassword);

          $db_username = "root";
          $db_password = "";
          $db_hostname = "localhost";
          $db_database = "pppc_asset_manager";
                //
          $conn = new mysqli($db_hostname, $db_username, $db_password,$db_database);
          if($conn->connect_error){
            die("<p>Failed to connect to the database</p>");
          }
          $query = "SELECT id,fname,sname,email FROM users WHERE email='$formname' AND password='$hashed_password'";
          $result = $conn->query($query);
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $_SESSION['user_id'] = md5($row['id']);
              $_SESSION['user_name'] = $row['email'];
              header("Location: /lessions/home.php");
              exit();

            }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
    <title>Login</title>
  </head>
  <body>
    <div class="container">
        
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="mt-2"><h2>Login</h2></div>
            <?php
              if(isset($_SESSION['form_error'])){
                echo "<div class='alert alert-danger'>";
                echo "Wrong username or password";
                echo  "</div>";
              }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" <?php if(isset($_SESSION['form_error'])){ echo "class='has-validation'";} ?> >
                <div class="mb-3 mt-3 has-validation">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control <?php if(isset($_SESSION['form_error'])){ echo "is-invalid";} ?>" id="email" placeholder="Enter email" name="email" required>
                  <div class="invalid-feedback">One input field was invalid</div>
                </div>
                <div class="mb-3 has-validation">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control <?php if(isset($_SESSION['form_error'])){ echo "is-invalid";} ?>" id="password" placeholder="Enter password" name="password" required>
                  <div class="invalid-feedback">One input field was invalid</div>
                </div>
                <button type="submit" class="btn btn-primary" style='background-color: #09abb8; border-color:#09abb8'>Submit</button>
              </form>
        </div>
        <div class="col-lg-4"></div>
      </div>
      <?php if(isset($_SESSION['form_error'])){ unset($_SESSION['form_error']);} ?>
      
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>