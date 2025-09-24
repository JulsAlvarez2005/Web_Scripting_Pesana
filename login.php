<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $file = "users.txt";
    if (!file_exists($file)) {
        die("No registered users yet.");
    }

    $users = file($file, FILE_IGNORE_NEW_LINES);
    $found = false;

    foreach ($users as $user) {
        list($fullname, $email, $storedUser, $hashedPass) = explode("|", $user);

        if ($storedUser === $username && password_verify($password, $hashedPass)) {
            echo "🎉 Welcome, $fullname!";
            $found = true;
            break;
        }
    }

    if (!$found) {
        echo "❌ Error: Invalid username or password.";
    }
}
?>