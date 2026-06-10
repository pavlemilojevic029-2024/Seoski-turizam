<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Soba.php';   
$soba = new Soba();
$sobe = $soba->getAllByUser($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moje Sobe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Moje Sobe</h2>
        <a href="create.php" class="btn btn-success mb-3">+ Dodaj novu sobu</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Tip</th>
                    <th>Broj kreveta</th>
                    <th>Cena po noći</th>
                    <th>Dostupna</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sobe as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['naziv']) ?></td>
                    <td><?= htmlspecialchars($s['tip_sobe']) ?></td>
                    <td><?= $s['broj_kreveta'] ?></td>
                    <td><?= number_format($s['cena_po_noci'], 2) ?> RSD</td>
                    <td><?= $s['dostupna'] ? '✅' : '❌' ?></td>
                    <td>
                        <a href="edit.php?id=<?= $s['id'] ?>" class="btn btn-warning btn-sm">Izmeni</a>
                        <a href="delete.php?id=<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sigurno obrisati?')">Obriši</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <a href="../dashboard.php" class="btn btn-secondary">Nazad na Dashboard</a>
    </div>
</body>
</html>