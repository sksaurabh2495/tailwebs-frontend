<!DOCTYPE html>
<?php
$frontend_url = "http://127.0.0.1/tailwebs-frontend/";
$backend_url = "http://127.0.0.1/tailwebs-backend/";
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <center><h1>Add a New Teacher</h1></center>
    <form action="<?php echo $backend_url; ?>add_teacher.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Add Teacher</button>
    </form>
</body>
</html>
