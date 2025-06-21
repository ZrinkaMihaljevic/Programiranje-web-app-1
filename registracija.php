<?php
include 'connect.php';

$poruka = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $korisnicko = trim($_POST['korisnicko']);
    $lozinka = $_POST['lozinka'];
    $lozinka2 = $_POST['lozinka2'];

    if ($lozinka !== $lozinka2) {
        $poruka = "Lozinke se ne podudaraju!";
    } else {
        $stmt = $conn->prepare("SELECT id FROM korisnik WHERE korisnicko_ime = ?");
        $stmt->bind_param("s", $korisnicko);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $poruka = "Korisničko ime već postoji, odaberite drugo.";
        } else {
            $hash_lozinka = password_hash($lozinka, PASSWORD_DEFAULT);
            $razina = 0;

            $stmt = $conn->prepare("INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $ime, $prezime, $korisnicko, $hash_lozinka, $razina);

            if ($stmt->execute()) {
                $poruka = "Registracija uspješna. <a href='administrator.php'>Prijavi se</a>";
            } else {
                $poruka = "Greška: " . $stmt->error;
            }
        }
        $stmt->close();
    }
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
            <h2>Registracija korisnika</h2>
            <form name="registracija" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="contact-form">
                <label for="ime">Ime:</label><br>
                <input type="text" id="ime" name="ime" required autocomplete="off"><br><br>

                <label for="prezime">Prezime:</label><br>
                <input type="text" id="prezime" name="prezime" required autocomplete="off"><br><br>

                <label for="korisnicko">Korisničko ime:</label><br>
                <input type="text" id="korisnicko" name="korisnicko" required autocomplete="off"><br><br>

                <label for="lozinka">Lozinka:</label><br>
                <input type="password" id="lozinka" name="lozinka" required autocomplete="off"><br><br>

                <label for="lozinka2">Ponovi lozinku:</label><br>
                <input type="password" id="lozinka2" name="lozinka2" required autocomplete="off"><br><br>

                <input type="submit" value="Registriraj se" class="read-more">
            </form>

            <?php if (!empty($poruka)) : ?>
                <p class="form-message" style="margin-top: 10px; font-weight: bold; color: <?= strpos($poruka, 'Greška') !== false || strpos($poruka, 'Lozinke') !== false ? 'red' : 'green' ?>">
                    <?= $poruka ?>
                </p>
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