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

    <main class="contact-page">
        <h2>Kontaktirajte nas</h2>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d177977.12250135862!2d15.672218694531246!3d45.81341049999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d71ae5ad1eff%3A0x59e0d8778f8f377d!2zS3JhxaEgY2hvY28gJiBjYWbDqQ!5e0!3m2!1shr!2shr!4v1746200537655!5m2!1shr!2shr"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <section class="contact-form">
            <form name="kontakt-forma" action="#" method="post">
                <label for="firstname">Ime</label>
                <input type="text" id="firstname" name="firstname" required>

                <label for="lastname">Prezime</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="email">Email adresa</label>
                <input type="email" id="email" name="email" required>

                <label for="country">Country:</label>
    	            <select id="country" name="country" required>
                        <option value="" disabled selected>Odaberi državu</option>
                        <option value="Croatia">Hrvatska</option>
                        <option value="Slovenia">Slovenija</option>
                        <option value="Serbia">Srbija</option>
                        <option value="Bosnia">Bosna i Hercegovina</option>
                        <option value="Germany">Njemačka</option>
                        <option value="Austria">Austrija</option>
                        <option value="Italy">Italija</option>
                        <option value="France">Francuska</option>
                        <option value="United Kingdom">Ujedinjeno Kraljevstvo</option>
                        <option value="United States">Sjedinjene Američke Države</option>
                    </select>

                <label>
                    <input type="checkbox" name="newsletter" required>
                    Želim primati newsletter
                </label>

                <label for="subject">Poruka / Upit</label>
                <textarea id="subject" name="subject" rows="5" required></textarea>

                <button type="submit">Pošalji</button>
            </form>
        </section>
    </main>

    <footer>
        <p class="footer-name">Zrinka Mihaljević</p>
        <p class="footer-year"><?php echo date("Y"); ?>. godina</p>
        <p>Kontakt: <a href="mailto:zmihaljev@tvz.hr">zmihaljev@tvz.hr</a></p>
    </footer>
</body>
</html>
