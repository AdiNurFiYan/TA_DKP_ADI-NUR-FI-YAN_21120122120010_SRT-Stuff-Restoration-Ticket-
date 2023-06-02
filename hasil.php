<?php
session_start();

if (!isset($_SESSION["hasilAduan"])) {
    header("Location: main.php");
    exit();
}

$hasilAduan = $_SESSION["hasilAduan"];
$hasilAduanArr = explode("|", $hasilAduan);

// Mendapatkan informasi dari hasil aduan
$category = $hasilAduanArr[0];
$comment = $hasilAduanArr[1];
$quantity = $hasilAduanArr[2];

// Hapus data hasil aduan dari session
unset($_SESSION["hasilAduan"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Aduan</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container3">
        <h6>Konfirmasi</h6>
        <p>Nama Akun: <?php echo $_SESSION["email"]; ?></p>
        <p>Kategori : <?php echo $category; ?></p>
        <p>Komentar : <?php echo $comment; ?></p>
        <p>Jumlah Barang yang Dimiliki: <?php echo $quantity; ?></p>
        <form action="main.php" method="post">
            <input type="submit" value="salah? buatlagi">
        </form>
    </div>
</body>
</html>

