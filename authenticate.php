<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM teachers WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($teacher && password_verify($password, $teacher['password'])) {
        $_SESSION['teacher_id'] = $teacher['id'];
        header('Location: home.php');
        exit();
    } else {
        echo "Invalid credentials";
    }
}
?>
