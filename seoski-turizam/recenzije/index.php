<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Recenzija.php';
$recenzija = new Recenzija();
$recenzije = $recenzija->getAllByUser($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recenzije</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Recenzije mojih smeštaja</h2>
        <a href="create.php" class="btn btn-success mb-3">+ Nova recenzija</a>
        
        <?php if(empty($recenzije)): ?>
            <div class="alert alert-info">Još uvek nema recenzija.</div>
        <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Soba</th>
                    <th>Gost</th>
                    <th>Ocena</th>
                    <th>Komentar</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($recenzije as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['soba_naziv']) ?></td>
                    <td><?= htmlspecialchars($r['gost_ime']) ?></td>
                    <td><strong><?= $r['ocena'] ?> / 5</strong></td>
                    <td><?= htmlspecialchars($r['komentar']) ?></td>
                    <td><?= date('d.m.Y', strtotime($r['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        
        <a href="../dashboard.php" class="btn btn-secondary">Nazad na Dashboard</a>
    </div>
</body>
</html>