<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}


function getBooks($sql) {
    return $sql->query("SELECT books.*, users.name AS user_name
                        FROM books
                        JOIN users ON books.user_id = users.id
                        ORDER BY books.id DESC")->fetchAll();
}

function getBook($sql, $id) {
    $stmt = $sql->prepare("SELECT books.*, users.name AS user_name
                           FROM books
                           JOIN users ON books.user_id = users.id
                           WHERE books.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function addBook($sql, $title, $author, $user_id) {
    $stmt = $sql->prepare("INSERT INTO books (title, author, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $author, $user_id]);
}

function editBook($sql, $id, $title, $author) {
    $stmt = $sql->prepare("UPDATE books SET title = ?, author = ? WHERE id = ?");
    $stmt->execute([$title, $author, $id]);
}

function deleteBook($sql, $id) {
    $stmt = $sql->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$id]);
}

function registerUser($sql, $name, $email, $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $sql->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $hash]);
}

function loginUser($sql, $email, $password) {
    $stmt = $sql->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["name"] = $user["name"];
        return true;
    }

    return false;
}

function isLoggedIn() {
    return isset($_SESSION["user_id"]);
}

function isOwner($book) {
    return isLoggedIn() && $_SESSION["user_id"] == $book["user_id"];
}

?>
