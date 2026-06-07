<?php
require "db.php";
require "functions.php";

if(!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];
$book = getBook($sql, $id);

if(!isOwner($book)) {
    header("Location: index.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    editBook($sql, $id, $_POST["title"], $_POST["author"]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<nav>
    <a href="index.php">Home</a>

    <?php if(isLoggedIn()): ?>
        <a href="add.php">Add Book</a>
        <span>Logged in: <?= $_SESSION["name"] ?></span>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>


<div class="page">
    <h1>Edit Book</h1>

    <form method="post">
        <input type="text" name="title" value="<?= $book["title"] ?>">
        <input type="text" name="author" value="<?= $book["author"] ?>">
        <button type="submit">Save</button>
    </form>
</div>

</body>
</html>
