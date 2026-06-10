<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Rezervacija.php';
require_once '../classes/Soba.php';

$rezervacija = new Rezervacija();
$sobaObj = new Soba();

$message = "";

// Dohvati sobe tog domaćina
$sobe = $sobaObj->getAllByUser($_SESSION['user_id']);

if($_POST) {
    $result = $rezervacija->create(
        $_POST['soba_id'],
        $_SESSION['user_id'],
        $_POST['gost_ime'],
        $_POST['gost_prezime'],
        $_POST['gost_email'] ?? '',
        $_POST['gost_telefon'] ?? '',
        $_POST['datum_dolaska'],
        $_POST['datum_odlaska'],
        $_POST['broj_osoba']
    );

    if($result) {
        $message = "✅ Rezervacija uspešno dodata!";
        header("Location: index.php");
        exit();
    } else {
        $message = "❌ Greška pri dodavanju rezervacije!";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova Rezervacija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Nova Rezervacija</h2>
        
        <?php if($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" class="card p-4">
            <div class="mb-3">
                <label>Izaberi sobu</label>
                <select name="soba_id" class="form-control" required>
                    <option value="">-- Izaberi sobu --</option>
                    <?php foreach($sobe as $s): ?>
                        <option value="<?= $s['id'] ?>">
                            <?= htmlspecialchars($s['naziv']) ?> (<?= number_format($s['cena_po_noci'], 2) ?> RSD)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Ime gosta</label>
                    <input type="text" name="gost_ime" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Prezime gosta</label>
                    <input type="text" name="gost_prezime" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Email gosta</label>
                    <input type="email" name="gost_email" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Telefon gosta</label>
                    <input type="text" name="gost_telefon" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Datum dolaska</label>
                    <input type="date" name="datum_dolaska" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Datum odlaska</label>
                    <input type="date" name="datum_odlaska" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Broj osoba</label>
                <input type="number" name="broj_osoba" value="1" min="1" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj rezervaciju</button>
            <a href="index.php" class="btn btn-secondary">Nazad</a>
        </form>
    </div>
</body>
</html>