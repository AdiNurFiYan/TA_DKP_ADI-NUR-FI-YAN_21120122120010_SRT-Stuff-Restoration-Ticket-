<?php
session_start();

// Definisi kelas Aduan
class Aduan {
    private $category;
    private $comment;
    private $quantity;

    public function __construct($category, $comment, $quantity) {
        $this->category = $category;
        $this->comment = $comment;
        $this->quantity = $quantity;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getQuantity() {
        return $this->quantity;
    }
}

// Array kategori aduan
$categories = array(
    "lemari" => "Lemari",
    "meja" => "Meja",
    "kursi" => "Kursi"
);

$errors = array(); // Array untuk menyimpan pesan error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = isset($_POST["category"]) ? $_POST["category"] : null;
    $comment = isset($_POST["comment"]) ? $_POST["comment"] : null;
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : null;

    // Validasi kategori aduan
    if (!array_key_exists($category, $categories)) {
        $errors[] = "Pilih kategori aduan yang valid.";
    }

    // Validasi komentar aduan
    if (empty($comment)) {
        $errors[] = "Komentar aduan harus diisi.";
    }

    // Validasi jumlah barang
    if (empty($quantity) || !is_numeric($quantity) || $quantity <= 0) {
        $errors[] = "Jumlah barang yang dimiliki harus diisi dengan angka positif.";
    }

    // Jika tidak ada error, proses aduan
    if (empty($errors)) {
        $aduan = new Aduan($category, $comment, $quantity);
        $hasilAduan = $aduan->getCategory() . "|" . $aduan->getComment() . "|" . $aduan->getQuantity();
        $_SESSION["hasilAduan"] = $hasilAduan;
        header("Location: hasil.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Aduan</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container2">
        <h5>Form Aduan</h5>
        <?php if (!empty($errors)) : ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div>
                <label for="category">Pilih Kategori :</label>
                <select name="category" id="category">
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($categories as $key => $value) : ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="comment">Komentar Aduan:</label>
                <textarea name="comment" id="comment" rows="4" cols="30"></textarea>
            </div>
            <div>
                <label for="quantity">Jumlah Barang yang Dimiliki:</label>
                <input type="number" name="quantity" id="quantity" min="1">
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
