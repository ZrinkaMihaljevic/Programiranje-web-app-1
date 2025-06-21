<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['korisnicko']) && isset($_POST['lozinka'])) {
    $korisnicko = $_POST['korisnicko'];
    $lozinka = $_POST['lozinka'];

    $stmt = $conn->prepare("SELECT * FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $korisnik = $result->fetch_assoc();
        if (password_verify($lozinka, $korisnik['lozinka'])) {
            if ($korisnik['razina'] == 1) {
                $_SESSION['ime'] = $korisnik['ime'];
                $_SESSION['uloga'] = 'admin';
            } else {
                $_SESSION['ime'] = $korisnik['ime'];
                $_SESSION['uloga'] = 'korisnik';
                $greska = $korisnik['korisnicko_ime'] . ", nemate dovoljna prava za pristup ovoj stranici.";
            }
        } else {
            $greska = "Neispravna lozinka.";
        }
    } else {
        $greska = "Korisnik ne postoji. <a href='registracija.php'>Registriraj se ovdje</a>";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: administrator.php");
    exit;
}
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
    
    <main class="homepage">
        <section class="login-section">
            <?php if (isset($_SESSION['uloga']) && $_SESSION['uloga'] === 'admin'): ?>
                <h2>Dobrodošao, <?php echo htmlspecialchars($_SESSION['ime']); ?> (admin)</h2>
                <p>Ovdje možeš uređivati sadržaj stranice ili dodavati nove članke.</p>
                <a href="unos.php" class="gumb">Dodaj novi članak</a><br><br>
                <a href="administracija.php" class="gumb">Uredi i briši članke</a><br><br>
                <a href="administrator.php?logout=1" class="gumb">Odjavi se</a>
            <?php elseif (isset($_SESSION['uloga'])): ?>
                <h2>Dobrodošao, <?php echo htmlspecialchars($_SESSION['ime']); ?>!</h2>
                <p><?php echo htmlspecialchars($_SESSION['korisnicko']); ?>, nemate dovoljna prava za pristup ovoj stranici.</p>
                <a href="administrator.php?logout=1" class="gumb">Odjavi se</a>
            <?php else: ?>
                <h2>Prijava</h2>
                <?php if (isset($greska)) echo "<p style='color: red;'>$greska</p>"; ?>
                <form name="prijava" method="POST" action="administrator.php" class="contact-form">
                    <label for="korisnicko">Korisničko ime:</label><br>
                    <input type="text" name="korisnicko" id="korisnicko" required><br><br>

                    <label for="lozinka">Lozinka:</label><br>
                    <input type="password" name="lozinka" id="lozinka" required><br><br>

                    <input type="submit" value="Prijavi se" class="read-more">
                </form>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p class="footer-name">Zrinka Mihaljević</p>
        <p class="footer-year"><?php echo date("Y"); ?>. godina</p>
        <p>Kontakt: <a href="mailto:zmihaljev@tvz.hr">zmihaljev@tvz.hr</a></p>
    </footer>

</body>
</html>