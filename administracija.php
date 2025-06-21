<?php
include 'connect.php';

define('UPLPATH', 'slike/');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM clanak WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Članak je obrisan.</p>";
    } else {
        echo "<p>Greška pri brisanju članka.</p>";
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $naslov = trim($_POST['naslov']);
    $opis = trim($_POST['opis']);
    $sadrzaj = trim($_POST['sadrzaj']);
    $kategorija = trim($_POST['kategorija']);
    $prikaz = isset($_POST['archive']) ? 1 : 0;

    $slika_naziv = $_FILES['slika']['name'];
    $slika_tmp = $_FILES['slika']['tmp_name'];

    if (!empty($slika_naziv)) {
        $dozvoljeniTipovi = ['image/jpeg', 'image/png', 'image/gif'];
        $slika_tip = $_FILES['slika']['type'];
        if (!in_array($slika_tip, $dozvoljeniTipovi)) {
            die("Dozvoljeni su samo JPG, PNG i GIF formati.");
        }
        $putanja = UPLPATH . basename($slika_naziv);
        move_uploaded_file($slika_tmp, $putanja);

        $query = "UPDATE clanak SET naslov=?, opis=?, sadrzaj=?, slika=?, kategorija=?, prikaz=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssii", $naslov, $opis, $sadrzaj, $slika_naziv, $kategorija, $prikaz, $id);
    } else {
        $query = "UPDATE clanak SET naslov=?, opis=?, sadrzaj=?, kategorija=?, prikaz=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssii", $naslov, $opis, $sadrzaj, $kategorija, $prikaz, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Članak je ažuriran.</p>";
    } else {
        echo "<p>Greška pri ažuriranju članka.</p>";
    }
    mysqli_stmt_close($stmt);
}

$query = "SELECT * FROM clanak";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="slike/logokave.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Kava</title>
</head>
<body>

<header>
    <div class="banner">
        <img src="slike/coffeeheader.png" alt="Kitchen Appliances">
        <h1>COFFEE</h1>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Početna</a></li>
            <li><a href="kategorija.php?id=Savjeti%20i%20vodi%C4%8Di">Savjeti i vodiči</a></li>
            <li><a href="kategorija.php?id=Recenzije%20kave%20i%20opreme">Recenzije kave i opreme</a></li>
            <li><a href="kategorija.php?id=Zdravlje%20i%20kava">Zdravlje i kava</a></li>
            <li><a href="kategorija.php?id=Intervjui%20i%20pri%C4%8De">Intervjui i priče</a></li>
            <li><a href="kategorija.php?id=Putovanja%20i%20kava">Putovanja i kava</a></li>
            <li><a href="galerija.php">Galerija</a></li>
            <li><a href="onama.php">O nama</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
            <li><a href="registracija.php">Registracija</a></li>
            <li><a href="administracija.php">Administracija</a></li>
        </ul>
    </nav>
</header>

<div class="homepage-wrapper">
<main class="homepage">

<h2>Uredi ili briši članke</h2>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo '
    <form enctype="multipart/form-data" method="POST" action="" class="form-container">
        <div class="form-group">
            <label for="naslov">Naslov:</label>
            <input type="text" name="naslov" id="naslov" class="form-input" value="' . htmlspecialchars($row['naslov']) . '" required>
        </div>

        <div class="form-group">
            <label for="opis">Kratki opis:</label>
            <textarea name="opis" id="opis" class="form-textarea" rows="3" required>' . htmlspecialchars($row['opis']) . '</textarea>
        </div>

        <div class="form-group">
            <label for="sadrzaj">Sadržaj:</label>
            <textarea name="sadrzaj" id="sadrzaj" class="form-textarea" rows="6" required>' . htmlspecialchars($row['sadrzaj']) . '</textarea>
        </div>

        <div class="form-group">
            <label for="slika">Slika:</label>
            <input type="file" name="slika" id="slika" class="form-input" accept="image/*">
            <div class="slika-pregled">
                <img src="' . UPLPATH . $row['slika'] . '" width="150" alt="Slika članka">
            </div>
        </div>

        <div class="form-group">
            <label for="kategorija">Kategorija:</label>
            <select id="kategorija" name="kategorija" class="form-input" required>
                <option value="" disabled>Odaberite kategoriju</option>
                <option value="Savjeti i vodiči" ' . ($row['kategorija'] == 'Savjeti i vodiči' ? 'selected' : '') . '>Savjeti i vodiči</option>
                <option value="Recenzije kave i opreme" ' . ($row['kategorija'] == 'Recenzije kave i opreme' ? 'selected' : '') . '>Recenzije kave i opreme</option>
                <option value="Zdravlje i kava" ' . ($row['kategorija'] == 'Zdravlje i kava' ? 'selected' : '') . '>Zdravlje i kava</option>
                <option value="Intervjui i priče" ' . ($row['kategorija'] == 'Intervjui i priče' ? 'selected' : '') . '>Intervjui i priče</option>
                <option value="Putovanja i kava" ' . ($row['kategorija'] == 'Putovanja i kava' ? 'selected' : '') . '>Putovanja i kava</option>
            </select>
        </div>

        <div class="form-group checkbox">
            <label><input type="checkbox" name="archive" ' . ($row['prikaz'] == 1 ? 'checked' : '') . '> Arhiviraj članak</label>
        </div>

        <input type="hidden" name="id" value="' . $row['id'] . '">

        <div class="form-actions">
            <button type="submit" name="update" class="btn-update">Izmjeni</button>
            <button type="reset" class="btn-reset">Poništi</button>
            <button type="submit" name="delete" class="btn-delete">Izbriši</button>
        </div>
    </form>';
}
?>

</main>
</div>

<footer>
    <p class="footer-name">Zrinka Mihaljević</p>
    <p class="footer-year"><?php echo date("Y"); ?>. godina</p>
    <p>Kontakt: <a href="mailto:zmihaljev@tvz.hr">zmihaljev@tvz.hr</a></p>
</footer>

</body>
</html>

<?php
mysqli_close($conn);
?>
