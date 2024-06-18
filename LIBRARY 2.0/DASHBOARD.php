<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$userid = $_SESSION['userid'];

// Use prepared statements to avoid SQL injection
$fetch_staff_info_sql = "SELECT * FROM staff WHERE staff_id=?";
$stmt = $conn->prepare($fetch_staff_info_sql);
$stmt->bind_param("i", $userid);  
$stmt->execute();
$fetch_staff_info_result = $stmt->get_result();

$staff = $fetch_staff_info_result->fetch_assoc();

// Fetch all books
$fetch_books_sql = "SELECT * FROM books";
$fetch_books_result = $conn->query($fetch_books_sql);

$books = [];
while ($row = $fetch_books_result->fetch_assoc()) {
    $books[] = $row;
}
// Query to get the most loaned books
$fetch_most_loaned_books_sql = "
    SELECT b.book_id, b.title, COUNT(l.loan_id) AS loan_count
    FROM books b
    JOIN loans l ON b.book_id = l.book_id
    GROUP BY b.book_id, b.title
    ORDER BY loan_count DESC, b.book_id ASC
";

$fetch_most_loaned_books_result = $conn->query($fetch_most_loaned_books_sql);

// Fetch returned loaned books
$fetch_returned_loans_sql = "SELECT * FROM loans where is_returned=True";
$fetch_returned_loans_result = $conn->query($fetch_returned_loans_sql);

// Fetch all loans column
$fetch_loans_sql = "SELECT * FROM loans";
$fetch_loans_result = $conn->query($fetch_loans_sql);

$loans = [];
while ($row = $fetch_loans_result->fetch_assoc()) {
    $loans[] = $row;
}
// Query to get loan details along with member names and genres
$fetch_loans_info_sql = "
    SELECT 
        l.loan_id, l.loan_date, l.return_date, l.is_returned,
        m.first_name AS member_first_name, m.last_name AS member_last_name,
        g.name AS genre_name
    FROM 
        loans l
    JOIN 
        members m ON l.member_id = m.member_id
    JOIN 
        books b ON l.book_id = b.book_id
    JOIN 
        genres g ON b.genre_id = g.genre_id
    ORDER BY 
        l.loan_date ASC
";

$fetch_loans_info_result = $conn->query($fetch_loans_info_sql);

// Query to get top loaned books and their authors
$fetch_top_loaned_books_sql = "
    SELECT 
        b.title AS book_name, 
        CONCAT(a.first_name, ' ', a.last_name) AS author_name,
        COUNT(l.loan_id) AS loan_count
    FROM 
        books b
    JOIN 
        loans l ON b.book_id = l.book_id
    JOIN 
        authors a ON b.author_id = a.author_id
    GROUP BY 
        b.book_id, b.title, a.first_name, a.last_name
    ORDER BY 
        loan_count ASC
    LIMIT 5
";

$fetch_top_loaned_books_result = $conn->query($fetch_top_loaned_books_sql);

$_SESSION['username'] = $staff['first_name']. ' '.$staff['last_name'] ;
$conn->close();
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
          <a href="#" class="active">
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
          <a href="logout.php">
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
        <img src="profile.jpg" alt="profile-pic">
        <span class="admin_name"><?php echo $staff['first_name']. ' '.$staff['last_name'] ; ?></span>
        
      </div>
    </nav>
    
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Issued</div>
            <div class="number"><?php echo $fetch_loans_result->num_rows; ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from 1min</span>
            </div>
          </div>
          
        </div>
        <div class="box gold">
          <div class="right-side">
            <div class="box-topic">Total Returned</div>
            <div class="number"><?php echo $fetch_returned_loans_result->num_rows; ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from 1min</span>
            </div>
          </div>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Available</div>
            <div class="number"><?php echo $fetch_books_result->num_rows;?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from 1min</span>
            </div>
          </div>
        </div>
      </div>
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Recent Statistics</div>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">Issue Date</li>
              
            </ul>
            <ul class="details">
              <li class="topic">Members</li>
              
            </ul>
            <ul class="details">
              <li class="topic">Status</li>
            
            </ul>
            <ul class="details">
              <li class="topic">Genres</li>
              
            </ul>
          </div>
          <?php
          
          if ($fetch_loans_info_result->num_rows > 0) {
    while ($row = $fetch_loans_info_result->fetch_assoc()) {
        $issue_date = date('d M Y', strtotime($row['loan_date']));
        $member_name = $row['member_first_name'] . ' ' . $row['member_last_name'];
        $status = $row['is_returned'] ? 'Returned' : 'Not Returned';
        $genre = $row['genre_name'];
        
        echo '<div class="sales-details">
            <ul class="details">
              
              <li><a href="#">' . $issue_date . '</a></li>
            </ul>
            <ul class="details">
              
              <li><a href="#">' . $member_name . '</a></li>
            </ul>
            <ul class="details">
              
              <li><a href="#">' . $status . '</a></li>
            </ul>
            <ul class="details">
              
              <li><a href="#">' . $genre . '</a></li>
            </ul>
          </div>';
    }
}         
          ?>
          <div class="button">
            <a href="#">See All</a>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Top Issued Books</div>
          <ul class="top-sales-details">
            <?php
            
            if ($fetch_top_loaned_books_result->num_rows > 0) {
  
            while ($row = $fetch_top_loaned_books_result->fetch_assoc()) {
                $book_name = $row['book_name'];
                $author_name = $row['author_name'];

                echo '<li>';
                echo '<a href="#">';
                echo '<img src="" alt="">';
                echo '<span class="product">' . $book_name . '</span>';
                echo '</a>';
                echo '<span class="author">' . $author_name . '</span>';
                echo '</li>';
    }
    echo '</ul>';
}                     
            ?>   
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
