# PHP Book Owner Login

This is a simple PHP demo project for learning login, register, sessions and owner-based permissions.

## What this project shows

- user registration
- user login
- user logout
- PHP sessions
- adding books only when logged in
- each book belongs to the user who created it
- only the owner can edit or delete their own book

## Main idea

After login, the user ID is saved into `$_SESSION`.

When a user adds a book, the book saves this user ID as `user_id`.

This means every book has an owner.

Before showing Edit and Delete buttons, the project checks if the logged-in user is the owner of the book.

## Owner logic

```php
function isOwner($book) {
    return isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $book["user_id"];
}
