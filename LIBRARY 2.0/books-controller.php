<?php
// Include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $bookName = $_POST['bookName'];
    $authorName = $_POST['authorName'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $year = $_POST['year'];
    $bookDescription = $_POST['bookDescription'];
    $copiesAvailable = $_POST['copiesAvailable'];

    // Split author name into first and last name
    $authorNameParts = explode(' ', $authorName);
    $firstName = $authorNameParts[0];
    $lastName = isset($authorNameParts[1]) ? $authorNameParts[1] : '';

    // Check if author exists
    $author_id = null;
    $check_author_sql = "SELECT author_id FROM authors WHERE first_name = ? AND last_name = ?";
    if ($stmt = $conn->prepare($check_author_sql)) {
        $stmt->bind_param("ss", $firstName, $lastName);
        $stmt->execute();
        $stmt->bind_result($author_id);
        $stmt->fetch();
        $stmt->close();
    }

    // If author does not exist, insert new author
    if (is_null($author_id)) {
        $insert_author_sql = "INSERT INTO authors (first_name, last_name) VALUES (?, ?)";
        if ($stmt = $conn->prepare($insert_author_sql)) {
            $stmt->bind_param("ss", $firstName, $lastName);
            $stmt->execute();
            $author_id = $stmt->insert_id;
            $stmt->close();
        }
    }

    // Check if genre exists
    $genre_id = null;
    $check_genre_sql = "SELECT genre_id FROM genres WHERE name = ?";
    if ($stmt = $conn->prepare($check_genre_sql)) {
        $stmt->bind_param("s", $genre);
        $stmt->execute();
        $stmt->bind_result($genre_id);
        $stmt->fetch();
        $stmt->close();
    }

    // If genre does not exist, insert new genre
    if (is_null($genre_id)) {
        $insert_genre_sql = "INSERT INTO genres (name) VALUES (?)";
        if ($stmt = $conn->prepare($insert_genre_sql)) {
            $stmt->bind_param("s", $genre);
            $stmt->execute();
            $genre_id = $stmt->insert_id;
            $stmt->close();
        }
    }

    // Insert book data
    $insert_book_sql = "
        INSERT INTO books (title, author_id, genre_id, isbn, publication_year, description, copies_available)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($insert_book_sql)) {
        $stmt->bind_param("siisssi", $bookName, $author_id, $genre_id, $isbn, $year, $bookDescription, $copiesAvailable);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect or display success message
    header('Location: BOOKS.php?sucess'); // Change this to your success page
    exit();
} else {
    echo "Invalid request method.";
}
?>
