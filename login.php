<?php
session_start();

// Daftar akun
$accounts = [
    [
        'email' => 'Adiyan@vrt.com',
        'password' => '11111'
    ],
    [
        'email' => 'Fiyan@vrt.com',
        'password' => 'eeeee'
    ]
];

// Fungsi untuk memeriksa kecocokan email dan password
function checkCredentials($email, $password, $accounts)
{
    foreach ($accounts as $account) {
        if ($account['email'] == $email && $account['password'] == $password) {
            return true;
        }
    }
    return false;
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (checkCredentials($email, $password, $accounts)) {
        $_SESSION['email'] = $email;
        header("Location: main.php");
        exit();
    } else {
        $errorMessage = "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h2>VRT Ticketing</h2>
<h3>pembuat layanan untuk furnitur dari produk PT. Kuru-Kuru</h3>
    <div class="container">
        <h4>Login sebelum melanjutkan</h4>
        <?php if (isset($errorMessage)): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
