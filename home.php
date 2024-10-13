<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php?login_gagal");
    exit();
}

// Atur zona waktu ke Asia/Jakarta (WIB)
date_default_timezone_set('Asia/Jakarta');

// Inisialisasi array untuk menyimpan data tamu
if (!isset($_SESSION['daftar_tamu'])) {
    $_SESSION['daftar_tamu'] = array();
}

// Inisialisasi variabel error
$namaErr = $alamatErr = $emailErr = "";

// Proses form jika ada submisi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $alamat = $email = "";
    
    // Validasi nama (hanya string)
    if (empty($_POST["nama"])) {
        $namaErr = "Nama harus diisi";
    } else {
        $nama = test_input($_POST["nama"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
            $namaErr = "Hanya huruf dan spasi yang diperbolehkan";
        }
    }
    
    // Validasi alamat
    if (empty($_POST["alamat"])) {
        $alamatErr = "Alamat harus diisi";
    } else {
        $alamat = test_input($_POST["alamat"]);
    }
    
    // Validasi email
    if (empty($_POST["email"])) {
        $emailErr = "Email harus diisi";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }
    
    // Jika tidak ada error, simpan data
    if (empty($namaErr) && empty($alamatErr) && empty($emailErr)) {
        $waktu = date("d-m-Y H:i:s");
        array_push($_SESSION['daftar_tamu'], array('nama' => $nama, 'alamat' => $alamat, 'email' => $email, 'waktu' => $waktu));
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleH.css">
    <title>Home page | DamarDH</title>
</head>
<body>
    <header>    
        <nav>
            <div class="nav__content">
                <a class="logo">SITORBUMU</a>
                <input type="checkbox" id="menu-toggle" />
                <label for="menu-toggle" class="menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
                <ul class="navlist">
                    <li><a href="#home" >Home</a></li>
                    <li><a href="#form-buku-tamu">Form Buku Tamu</a></li>
                    <li><a href="#daftar-tamu">Daftar Tamu</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="section" id="home">
            <div class="section__container">
                <article class="content">
                    <div class="slide">
                        <span class="one">Selamat datang</span>
                        <span class="two"><?php echo $_SESSION["username"]; ?>!</span>
                    </div>
                    <h1 class="title">SITORBUMU<br/>
                        <span>Sistem Informasi Buku Tamu</span>
                    </h1>
                    <p class="description">SITORBUMU adalah sebuah sistem yang dirancang khusus untuk mencatat kehadiran tamu undangan pada acara pernikahan secara efisien dan terorganisir. Sistem ini memungkinkan panitia atau tuan rumah untuk memantau daftar tamu yang hadir secara real-time.</p>
                    <div class="action__btns">
                        <button class="btn hire__me">Mulai</button>
                    </div>
                </article>
                <aside class="image">
                    <img src="img/book.png" alt="buku">
                </aside>
            </div>
        </section>

        <section class="section" id="form-buku-tamu">
            <div class="section__container">
                <div class="main-text">
                    <h2 class="title">Form Buku Tamu</h2>
                    <p>Pernikahan Salsabilla dan Aidan</p>
                </div>
                <div class="form-content">
                    <article class="form-info">
                        <h4>Selamat Datang!</h4>
                        <p>Silakan isi form buku tamu untuk mencatat kehadiran Anda pada acara ini.</p>
                    </article>
                    <aside class="form-buku-tamu">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <input type="text" name="nama" placeholder="Nama Anda" required>
                            <span class="error"><?php echo $namaErr; ?></span>
                            <input type="text" name="alamat" placeholder="Alamat Anda" required>
                            <span class="error"><?php echo $alamatErr; ?></span>
                            <input type="email" name="email" placeholder="Email Anda" required>
                            <span class="error"><?php echo $emailErr; ?></span>
                            <button type="submit" class="btn">Kirim</button>
                        </form>
                    </aside>
                </div>
            </div>
        </section>

        <section class="section" id="daftar-tamu">
            <div class="section__container">
                <div class="main-text">
                    <h2 class="title">Daftar <span>Tamu</span></h2>
                </div>
                <div class="table-container">
                    <table class="tamu-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Waktu Kedatangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($_SESSION['daftar_tamu'] as $index => $tamu) {
                                echo "<tr>";
                                echo "<td>" . ($index + 1) . "</td>";
                                echo "<td>" . htmlspecialchars($tamu['nama']) . "</td>";
                                echo "<td>" . htmlspecialchars($tamu['alamat']) . "</td>";
                                echo "<td>" . htmlspecialchars($tamu['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($tamu['waktu']) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer__container">
            <div class="footer__content">
                <p>&copy; 2024 Damar Djati Hutama. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
