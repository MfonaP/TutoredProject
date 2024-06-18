<?php
session_start();


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="DASHBOARD.CSS">
    <link rel="stylesheet" href="signbooks.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">BookTech</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="DASHBOARD.PHP" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="BOOKS.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Add Books</span>
          </a>
        </li>
        <li>
          <a href="Abooks.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">All books</span>
          </a>
        </li>
        <li>
          <a href="signbooks.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Sign Books</span>
          </a>
        </li>
        <li>
          <a href="SETTING.php">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <img src="profile.jpg" alt="">
        <span class="admin_name"><?php echo $_SESSION['username']; ?></span>
        
      </div>
    </nav>
    <div class="home-content">
    <div class="form-container">
        <div class="toggle-buttons">
            <button id="toggle-sign-in" class="active" onclick="toggleForm('sign-in')">Sign In</button>
            <button id="toggle-sign-out" class="inactive" onclick="toggleForm('sign-out')">Sign Out</button>
        </div>

        <div id="sign-in" class="form-section active">
            <form>
                <label for="sign-in-member-name">Name of Member:</label>
                <input type="text" id="sign-in-member-name" name="member-name">

                <label for="sign-in-book">Book:</label>
                <input type="text" id="sign-in-book" name="book">

                <label for="sign-in-quantity">Quantity:</label>
                <input type="number" id="sign-in-quantity" name="quantity">

                <label for="sign-in-loan-days">Loan Days:</label>
                <input type="number" id="sign-in-loan-days" name="loan-days">

                <button type="submit">Submit</button>
            </form>
        </div>

        <div id="sign-out" class="form-section">
            <form>
                <label for="sign-out-member-name">Name of Member:</label>
                <input type="text" id="sign-out-member-name" name="member-name">

                <label for="sign-out-book">Book:</label>
                <input type="text" id="sign-out-book" name="book">

                <label for="sign-out-quantity">Quantity:</label>
                <input type="number" id="sign-out-quantity" name="quantity">

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>
<script>
        function toggleForm(formType) {
            const signInForm = document.getElementById('sign-in');
            const signOutForm = document.getElementById('sign-out');
            const toggleSignIn = document.getElementById('toggle-sign-in');
            const toggleSignOut = document.getElementById('toggle-sign-out');

            if (formType === 'sign-in') {
                signInForm.classList.add('active');
                signOutForm.classList.remove('active');
                toggleSignIn.classList.add('active');
                toggleSignIn.classList.remove('inactive');
                toggleSignOut.classList.add('inactive');
                toggleSignOut.classList.remove('active');
            } else {
                signInForm.classList.remove('active');
                signOutForm.classList.add('active');
                toggleSignIn.classList.add('inactive');
                toggleSignIn.classList.remove('active');
                toggleSignOut.classList.add('active');
                toggleSignOut.classList.remove('inactive');
            }
        }
    </script>
</body>
</html>