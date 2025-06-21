<?php 
include "connect.php"; 

$kategorija = isset($_GET['id']) ? trim($_GET['id']) : '';

$sql = "SELECT * FROM clanak WHERE kategorija = ? AND prikaz = 0 ORDER BY datum_unosa DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $kategorija);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($kategorija) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="slike/logokave.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="banner">
            <img src="slike/coffeeheader.png" alt="Coffee Header">
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
                <li><a href="administrator.php">Administracija</a></li>
            </ul>
        </nav>

    </header>

    <main>
    <h1 class="naslov-kategorije"><?php echo strtoupper(htmlspecialchars($kategorija)); ?></h1>
    <section class="kategorija-container">
        <?php 
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<article class="kategorija-item">';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo '<img src="slike/' . htmlspecialchars($row['slika']) . '" alt="' . htmlspecialchars($row['naslov']) . '">';
                echo '</a>';
                echo '<a href="clanak.php?id=' . $row['id'] . '" class="clanak-naslov">' . htmlspecialchars($row['naslov']) . '</a>';
                echo '<p class="clanak-opis">' . nl2br(htmlspecialchars($row['opis'])) . '</p>';
                echo '<p class="clanak-datum">Objavljeno: ' . date("d. m. Y.", strtotime($row['datum_unosa'])) . '</p>';
                echo '</article>';
            }
        } else {
            echo '<p class="prazna-kategorija">Nema dostupnih članaka u ovoj kategoriji.</p>';
        }
        ?>
    </section>
</main>

    <footer>
        <p class="footer-name">Zrinka Mihaljević</p>
        <p class="footer-year"><?= date("Y") ?>. godina</p>
        <p>Kontakt: <a href="mailto:zmihaljev@tvz.hr">zmihaljev@tvz.hr</a></p>
    </footer>
</body>
</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
