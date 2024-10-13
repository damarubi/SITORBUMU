<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php?login_gagal");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Sukses</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h2>Selamat datang, <?php echo $_SESSION["username"]; ?>!</h2>
            <form method="post" action="logout.php">
                <button type="submit" class="button-logout">LOGOUT</button>
            </form>
        </div>
    </div>
</body>

</html>