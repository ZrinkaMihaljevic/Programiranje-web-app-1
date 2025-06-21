<?php 
include "connect.php";

$naslov = trim($_POST['naslov']);
$opis = trim($_POST['opis']);
$sadrzaj = trim($_POST['sadrzaj']);
$kategorija = trim($_POST['kategorija']);
$prikaz = isset($_POST['archive']) ? 1 : 0;
$datum = date("Y-m-d H:i:s");

$slika_naziv = basename($_FILES['slika']['name']);
$slika_tmp = $_FILES['slika']['tmp_name'];
$slika_tip = $_FILES['slika']['type'];
$putanja = "slike/" . $slika_naziv;

$dozvoljeniTipovi = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($slika_tip, $dozvoljeniTipovi)) {
    die("Dozvoljeni su samo JPG, PNG i GIF formati.");
}

if ($_FILES['slika']['size'] > 5 * 1024 * 1024) {
    die("Slika je prevelika. Maksimalna veličina je 5MB.");
}

if (move_uploaded_file($slika_tmp, $putanja)) {
    $sql = "INSERT INTO clanak (naslov, opis, sadrzaj, slika, kategorija, prikaz, datum_unosa)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssis", $naslov, $opis, $sadrzaj, $slika_naziv, $kategorija, $prikaz, $datum);

    if (mysqli_stmt_execute($stmt)) {
        echo "<h2>Uspješno dodano!</h2>";
        echo "<p><a href='unos.php'>Natrag na unos</a></p>";
    } else {
        echo "Greška pri unosu: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Greška pri prijenosu slike.";
}

mysqli_close($conn);
?>

