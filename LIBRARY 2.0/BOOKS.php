

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="DASHBOARD.CSS">
<link rel="stylesheet" href="BOOKS.CSS">
<meta charset="UTF-8">
<title>Book Information Form</title>
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

<div class="form-container">
        <h1>Book Information Form</h1>
        <form action="books-controller.php" method="post">
            <div class="form-group">
                <label for="book-name">Book Name:</label>
                <input type="text" id="book-name" name="bookName" required>
            </div>
            <div class="form-group">
                <label for="author-name">Author Name:</label>
                <input type="text" id="author-name" name="authorName" required>
            </div>
            <div class="form-group">
                <label for="author-name">Genres</label>
                <input type="text" id="Genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="author-name">ISBN</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label for="author-name">Publication Year</label>
                <input type="text" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="book-description">Book Description:</label>
                <textarea id="book-description" name="bookDescription" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="copies-available">Number of Copies Available:</label>
                <input type="number" id="copies-available" name="copiesAvailable" required>
            </div>
            <button type="submit">Submit</button>
        </form>
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