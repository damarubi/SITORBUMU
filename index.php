<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | DamarDH</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <?php if (isset($_GET["login_gagal"])) { ?>
            <div class="notifikasi">Login gagal ! <br> Username atau Password salah</div>
        <?php } ?>
        <form method="POST" action="validga.php">
            <h1>Login <br> SITORBUMU</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
        <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>