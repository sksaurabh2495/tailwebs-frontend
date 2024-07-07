<?php
session_start();
if (isset($_SESSION['teacher_id'])) {
    header('Location: home.php');
    exit();
}

$frontend_url = "http://127.0.0.1/tailwebs-frontend/";
$backend_url = "http://127.0.0.1/tailwebs-backend/";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $frontend_url; ?>styles.css">
</head>
<body>
    <center><h1>tailwebs.</h1></center>
    <form action="authenticate.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
