<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Soba.php';
$sobaObj = new Soba();

$message = "";
$soba = null;

// Dohvati sobu za edit
if(isset($_GET['id'])) {
    $soba = $sobaObj->getById($_GET['id'], $_SESSION['user_id']);
}

if($_POST && isset($_GET['id'])) {
    $result = $sobaObj->update(
        $_GET['id'],
        $_SESSION['user_id'],
        $_POST['naziv'],
        $_POST['tip_sobe'],
        $_POST['broj_kreveta'],
        $_POST['cena_po_noci'],
        $_POST['opis']
    );

    if($result) {
        $message = "✅ Soba uspešno izmenjena!";
        header("Location: index.php");
        exit();
    } else {
        $message = "❌ Greška pri izmeni!";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Izmeni sobu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Izmeni sobu</h2>
        
        <?php if($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <?php if($soba): ?>
        <form method="POST" class="card p-4">
            <div class="mb-3">
                <label>Naziv sobe</label>
                <input type="text" name="naziv" value="<?= htmlspecialchars($soba['naziv']) ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tip sobe</label>
                <select name="tip_sobe" class="form-control" required>
                    <option value="Jednokrevetna" <?= $soba['tip_sobe']=='Jednokrevetna'?'selected':'' ?>>Jednokrevetna</option>
                    <option value="Dvokrevetna" <?= $soba['tip_sobe']=='Dvokrevetna'?'selected':'' ?>>Dvokrevetna</option>
                    <option value="Trokrevetna" <?= $soba['tip_sobe']=='Trokrevetna'?'selected':'' ?>>Trokrevetna</option>
                    <option value="Apartman" <?= $soba['tip_sobe']=='Apartman'?'selected':'' ?>>Apartman</option>
                    <option value="Studio" <?= $soba['tip_sobe']=='Studio'?'selected':'' ?>>Studio</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Broj kreveta</label>
                    <input type="number" name="broj_kreveta" value="<?= $soba['broj_kreveta'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Cena po noći (RSD)</label>
                    <input type="number" name="cena_po_noci" value="<?= $soba['cena_po_noci'] ?>" class="form-control" step="0.01" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Opis</label>
                <textarea name="opis" class="form-control" rows="4"><?= htmlspecialchars($soba['opis'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-warning">Sačuvaj izmene</button>
            <a href="index.php" class="btn btn-secondary">Odustani</a>
        </form>
        <?php else: ?>
            <p>Soba nije pronađena.</p>
        <?php endif; ?>
    </div>
</body>
</html>