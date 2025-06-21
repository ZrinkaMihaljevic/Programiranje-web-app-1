<?php 
include "connect.php";

$sql_kategorije = "SELECT DISTINCT kategorija FROM clanak WHERE prikaz = ?";
$stmt_kategorije = mysqli_prepare($conn, $sql_kategorije);
$prikaz = 0;
mysqli_stmt_bind_param($stmt_kategorije, "i", $prikaz);
mysqli_stmt_execute($stmt_kategorije);
$rezultat_kategorije = mysqli_stmt_get_result($stmt_kategorije);
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
                <li><a href="administrator.php">Administracija</a></li>
            </ul>
        </nav>

    </header>
    

    <div class="homepage-wrapper">
<main class="homepage">

<?php
while ($kategorija = mysqli_fetch_assoc($rezultat_kategorije)) {
    $kat = $kategorija['kategorija'];

    $sql_clanci = "SELECT id, naslov, slika FROM clanak WHERE kategorija = ? AND prikaz = 0 ORDER BY datum_unosa DESC";
    $stmt = mysqli_prepare($conn, $sql_clanci);
    mysqli_stmt_bind_param($stmt, "s", $kat);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id, $naslov, $slika);

        echo '<h2 class="naslov-kategorije">' . htmlspecialchars($kat) . '</h2>';
        echo '<section class="kategorija-container">';

        while (mysqli_stmt_fetch($stmt)) {
            echo '<article class="kategorija-item">';
            echo '<a href="clanak.php?id=' . $id . '">';
            echo '<img src="slike/' . htmlspecialchars($slika) . '" alt="' . htmlspecialchars($naslov) . '">';
            echo '</a>';
            echo '<a href="clanak.php?id=' . $id . '">' . htmlspecialchars($naslov) . '</a>';
            echo '</article>';
        }

        echo '</section>';
    }

    mysqli_stmt_close($stmt);
}
?>

<h2>Dobrodošli u svijet kave</h2>
        
        <p>Kava nije samo piće — ona je ritual, miris doma i trenutak opuštanja. Bilo da je pijete ujutro kako biste započeli dan ili popodne u dobrom društvu, kava je uvijek tu da popravi raspoloženje.</p>
        
        <p>Postoji bezbroj načina pripreme kave — od espressa, turske, filter kave do modernih varijanti poput cappuccina i latte macchiata. Svaka šalica krije posebnu priču i stil života onoga tko ju pije.</p>
        
        <p>Naša stranica posvećena je ljubiteljima kave. Ovdje možete pronaći zanimljive činjenice, savjete za pripremu, galeriju aparata i šalica te povezati se s drugima koji dijele istu strast.</p>
        
        <div class="image-text-block">
            <img src="slike/salicakave.webp" alt="Šalica kave" class="coffee-image">
            <p class="image-caption">Miris svježe mljevene kave može promijeniti cijeli dan. Uživajte u svakom gutljaju.</p>
        </div>

        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
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