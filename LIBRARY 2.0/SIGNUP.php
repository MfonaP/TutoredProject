
<?php


// Check if the 'notification' parameter is set and is 'pwd_error'
if (isset($_GET['notification']) && $_GET['notification'] === 'pwd_error') {
    $errorMessage = "Error: Password D'ont Match";
}

// Check if the 'notification' parameter is set and is 'pwd_error'
if (isset($_GET['notification']) && $_GET['notification'] === 'user_error') {
    $errorMessage = "Error: Username Already Exist";
}

if (isset($_GET['notification']) && $_GET['notification'] === 'db_failed') {
    $errorMessage = "Error: Database Connection failed. Try Later";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Registration form</title>
    <link rel="stylesheet" href="SIGNUP.CSS">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
  </head>
<body>

<?php if (isset($errorMessage)): ?>
      <div id="error-message" class="error"><?php echo $errorMessage; ?></div>
  <?php endif; ?>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="signup-controller.php">
        <div class="user-details">
          <div class="input-box">
            <span class="details">FirstName</span>
            <input type="text" name='firstname' placeholder="Enter your First name" required>
          </div>
          <div class="input-box">
            <span class="details">LastName</span>
            <input type="text" name='lastname' placeholder="Enter your Last name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name='username' placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name='email' placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name='tel' placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name='address' placeholder="Enter your address" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" name='password' placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" name='c-password' placeholder="Confirm your password" required>
          </div> 
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
          <input type="radio" name="gender" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
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