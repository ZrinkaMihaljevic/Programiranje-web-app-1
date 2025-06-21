<?php
include "connect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Nevažeći ID članka.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM clanak WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "Članak nije pronađen.";
    exit;
}

$clanak = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($conn);
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
    <title><?= htmlspecialchars($clanak['naslov']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="clanak-body">
    <div class="clanak-container">
        <h1><?= htmlspecialchars($clanak['naslov']) ?></h1>
        <p class="datum"><?= date("d.m.Y.", strtotime($clanak['datum_unosa'])) ?></p>
        <?php if (!empty($clanak['slika'])): ?>
            <figure>
                <img src="slike/<?= htmlspecialchars($clanak['slika']) ?>" alt="<?= htmlspecialchars($clanak['naslov']) ?>">
                <?php if (!empty($clanak['opis'])): ?>
                    <figcaption><?= htmlspecialchars($clanak['opis']) ?></figcaption>
                <?php endif; ?>
            </figure>
        <?php endif; ?>
        <div class="sadrzaj"><?= nl2br(htmlspecialchars($clanak['sadrzaj'])) ?></div>
    </div>

    <div class="nazad-wrapper">
        <a href="kategorija.php?id=<?= urlencode($clanak['kategorija']) ?>" class="nazad-link">Nazad na novosti</a>
    </div>

    <footer>
        <p class="footer-name">Zrinka Mihaljević</p>
        <p class="footer-year"><?php echo date("Y"); ?>. godina</p>
        <p>Kontakt: <a href="mailto:zmihaljev@tvz.hr">zmihaljev@tvz.hr</a></p>
    </footer>
</body>
</html>
