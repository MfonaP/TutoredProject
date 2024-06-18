
<?php
session_start();
include 'db.php';

// Fetch all books data
$fetch_books_sql = "SELECT 
    b.title AS book_name,
    CONCAT(a.first_name, ' ', a.last_name) AS author_name,
    g.name AS genre,
    b.publication_year,
    b.copies_available
FROM 
    books b
JOIN 
    authors a ON b.author_id = a.author_id
JOIN 
    genres g ON b.genre_id = g.genre_id";
$fetch_books_result = $conn->query($fetch_books_sql);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="DASHBOARD.CSS">
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
      

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">List of all books</div>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">Book Name</li>
              
              
            </ul>
            <ul class="details">
            <li class="topic">Author</li>
            

            
          </ul>
          <ul class="details">
            <li class="topic">Genre</li>
            
          
          </ul>
          <ul class="details">
            <li class="topic">Publication Date</li>
            
            
          </ul>

          <ul class="details">
            <li class="topic">Authors</li>
            
            
          </ul>

          <ul class="details">
            <li class="topic">Copies available</li>
            
            
          </ul>
          </div>
  <?php
          
          if ($fetch_books_result->num_rows > 0) {
    while ($row = $fetch_books_result->fetch_assoc()) {  
        echo '<div class="sales-details">
            
              
              <li class=""><a href="#">' . $row['book_name'] . '</a></li>
            
            
              
              <li class=""><a href="#">' . $row['author_name'] . '</a></li>
            
            
              
              <li class=""><a href="#">' . $row['genre'] . '</a></li>
          
              
              <li class=""><a href="#">' . $row['publication_year'] . '</a></li>
          
              
              <li class=""><a href="#">' . $row['copies_available'] . '</a></li>
            
          </div>';
    }
}         
          ?>
          <div class="button">
            <a href="#">See All</a>
          </div>
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

</body>
</html>