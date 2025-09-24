<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $gender = $_POST['gender'] ?? '';
    $hobbies = isset($_POST['hobbies']) ? implode(",", $_POST['hobbies']) : '';
    $country = $_POST['country'];

    if ($password !== $confirm) {
        die("Error: Passwords do not match.");
    }

    $file = "users.txt";
    $users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];

    foreach ($users as $user) {
        $data = explode("|", $user);
        if ($data[2] === $username) {
            die("Error: Username already exists.");
        }
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $record = "$fullname|$email|$username|$hashedPassword|$gender|$hobbies|$country\n";
    file_put_contents($file, $record, FILE_APPEND);

    echo "✅ Registration successful! <a href='login.html'>Login here</a>";
}
?>