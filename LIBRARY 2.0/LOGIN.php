<?php


// Check if the 'notification' parameter is set and is 'false'
if (isset($_GET['notification']) && $_GET['notification'] === 'false') {
   $errorMessage = "Error: Invalid login attempt. Please try again.";
}

?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Form Design | CodeLab</title>
      <link rel="stylesheet" href="LOGIN.CSS">
      <style>
      .error {
         color: red;
         background-color: #fdd;
         border: 1px solid red;
         padding: 10px;
         margin: 10px 0;
         border-radius: 5px;
         text-align: center;
      }
      .sucess {
         color: white;
         background-color: green;
         border: 1px solid green;
         padding: 10px;
         margin: 10px 0;
         border-radius: 5px;
         text-align: center;
      }
   </style>
   </head>
   <body>
   <?php if (isset($errorMessage)): ?>
      <div id="error-message" class="error"><?php echo $errorMessage; ?></div>
   <?php endif; ?>
   <?php if (isset($_GET['sucess'])): ?>
      <div id="error-message" class="sucess"><?php echo $_GET['sucess']; ?></div>
   <?php endif; ?>
      <div class="wrapper">
            <div class="title">
               BookTech <br>
               Login Form

            </div>
            <form action="login-controller.php" method='post'>
               <div class="field">
                  <input name="username" type="text" value="<?php if(isset($_GET['login'])){echo  $_GET['login'];} ?>" required>
                  <label>Username</label>
               </div>
               <div class="field">
                  <input name="password" type="password" required>
                  <label>Password</label>
               </div>
               <div class="content">
                  <div class="checkbox">
                     <input type="checkbox" id="remember-me">
                     <label for="remember-me">Remember me</label>
                  </div>
                  <div class="pass-link">
                     <a href="#">Forgot password?</a>
                  </div>
               </div>
               <div class="field">
                  <input type="submit" value="Login">
               </div>
               <div class="signup-link">
                  Not a member? <a href="SIGNUP.php">Signup now</a>
               </div>
               
            </form>
         </div>


   <script>
        // Hide the error message after 6 seconds
      window.addEventListener('load', function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
               setTimeout(function() {
                  errorMessage.style.display = 'none';
                }, 4000); // 4000 milliseconds = 4 seconds
            }
      });
   </script>
   </body>
</html>