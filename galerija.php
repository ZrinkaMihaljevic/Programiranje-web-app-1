<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <main>
        <section class="gallery">
            <h2>Galerija naših kava</h2>
    
            <div class="gallery-row">
                <div class="gallery-item">
                    <img src="slike/espresso.jpg" alt="Espresso">
                    <p>Klasični espresso – snažan početak dana.</p>
                </div>
                <div class="gallery-item">
                    <img src="slike/latte.jpg" alt="Latte">
                    <p>Kremasti latte za opuštene trenutke.</p>
                </div>
                <div class="gallery-item">
                    <img src="slike/capuccino.jpg" alt="Cappuccino">
                    <p>Savršeno pjenasti cappuccino s cimetom.</p>
                </div>
            </div>
    
            <div class="gallery-row">
                <div class="gallery-item">
                    <img src="slike/iced-coffee.jpg" alt="Iced Coffee">
                    <p>Ledena kava za ljetne dane.</p>
                </div>
                <div class="gallery-item">
                    <img src="slike/mocha.jpg" alt="Mocha">
                    <p>Mocha – savršena kombinacija kave i čokolade.</p>
                </div>
                <div class="gallery-item">
                    <img src="slike/frappe.jpg" alt="Frappe">
                    <p>Osvježavajući frappe – savršen spoj hladne kave i pjene, idealan za vruće ljetne dane.</p>
                </div>
            </div>
        </section>
    </main>
    

    <footer>
        <p class="footer-name">Zrinka Mihaljević</p>
        <p class="footer-year"><?php echo date("Y"); ?>. godina</p>
        <p>Kontakt: <a href="mailto:zmihaljev@tvz.hr">zmihaljev@tvz.hr</a></p>
    </footer>
</body>
</html>
