<?php
session_start();
if (!isset($_SESSION['uloga']) || $_SESSION['uloga'] !== 'admin') {
    header("Location: administrator.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="slike/logokave.png" type="image/x-icon">
    <title>Kava</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="banner">
            <img src="slike/coffeeheader.png" alt="Coffee Banner">
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

    <main class="contact-page">
        <h2>Unesite novi članak</h2>
        <div class="contact-form">
            <form name="unos" action="skripta.php" method="POST" enctype="multipart/form-data">
                <label for="naslov">Naslov:</label>
                <input type="text" id="naslov" name="naslov" required>

                <label for="opis">Kratki opis (sažetak):</label>
                <textarea id="opis" name="opis" rows="3" required></textarea>

                <label for="sadrzaj">Sadržaj:</label>
                <textarea id="sadrzaj" name="sadrzaj" rows="6" required></textarea>

                <label for="slika">Slika:</label>
                <input type="file" id="slika" name="slika" accept="image/*" required>

                <label for="kategorija">Kategorija:</label>
                <select id="kategorija" name="kategorija" required>
                    <option value="" disabled selected>Odaberite kategoriju</option>
                    <option value="Savjeti i vodiči">Savjeti i vodiči</option>
                    <option value="Recenzije kave i opreme">Recenzije kave i opreme</option>
                    <option value="Zdravlje i kava">Zdravlje i kava</option>
                    <option value="Intervjui i priče">Intervjui i priče</option>
                    <option value="Putovanja i kava">Putovanja i kava</option>
                </select>

                <div class="form-item">
                    <label>Spremiti u arhivu:
                        <input type="checkbox" name="archive">
                    </label>
                </div>
                <div class="form-item">
                    <button type="reset">Poništi</button>
                    <button type="submit" name="submit" value="Prihvati">Prihvati</button>
                </div>
            </form>
        </div>
    </main>


    <footer>
        <p class="footer-name">Zrinka Mihaljević</p>
        <p class="footer-year"><?php echo date("Y"); ?>. godina</p>
        <p>Kontakt: <a href="mailto:zmihaljev@tvz.hr">zmihaljev@tvz.hr</a></p>
    </footer>
</body>
</html>
