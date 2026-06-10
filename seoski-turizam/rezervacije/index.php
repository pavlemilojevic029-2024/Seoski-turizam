<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Rezervacija.php';
$rezervacija = new Rezervacija();
$rezervacije = $rezervacija->getAllByUser($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rezervacije</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Rezervacije</h2>
        <a href="create.php" class="btn btn-success mb-3">+ Nova rezervacija</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Soba</th>
                    <th>Gost</th>
                    <th>Dolazak</th>
                    <th>Odlazak</th>
                    <th>Broj osoba</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rezervacije as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['soba_naziv']) ?></td>
                    <td><?= htmlspecialchars($r['gost_ime'] . ' ' . $r['gost_prezime']) ?></td>
                    <td><?= $r['datum_dolaska'] ?></td>
                    <td><?= $r['datum_odlaska'] ?></td>
                    <td><?= $r['broj_osoba'] ?></td>
                    <td><span class="badge bg-primary"><?= $r['status'] ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <a href="../dashboard.php" class="btn btn-secondary">Nazad</a>
    </div>
</body>
</html>