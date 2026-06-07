<?php
require "db.php";
require "functions.php";

$books = getBooks($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Owner</title>
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
    <h1>Login + Owner</h1>

    <p>Demo: demo@test.com / demo123</p>

    <div class="grid">
        <?php foreach($books as $book): ?>
            <div class="card">
                <h2><?= $book["title"] ?></h2>
                <p>Author: <?= $book["author"] ?></p>
                <p>Added by: <?= $book["user_name"] ?></p>

                <?php if(isOwner($book)): ?>
                    <div class="edit">
                        <a href="edit.php?id=<?= $book["id"] ?>">Edit</a>
                    </div>

                    <div class="delete">
                        <a href="delete.php?id=<?= $book["id"] ?>">Delete</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
