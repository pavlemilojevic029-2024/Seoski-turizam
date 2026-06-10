<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Soba.php';

$message = "";

if($_POST) {
    $soba = new Soba();
    
    $result = $soba->create(
        $_SESSION['user_id'],
        $_POST['naziv'],
        $_POST['tip_sobe'],
        $_POST['broj_kreveta'],
        $_POST['cena_po_noci'],
        $_POST['opis']
    );

    if($result) {
        $message = "✅ Soba uspešno dodata!";
        
        
    } else {
        $message = "❌ Greška pri dodavanju sobe!";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dodaj novu sobu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Dodaj novu sobu</h2>
        
        <?php if($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" class="card p-4">
            <div class="mb-3">
                <label class="form-label">Naziv sobe</label>
                <input type="text" name="naziv" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tip sobe</label>
                <select name="tip_sobe" class="form-control" required>
                    <option value="">Izaberi tip...</option>
                    <option value="Jednokrevetna">Jednokrevetna</option>
                    <option value="Dvokrevetna">Dvokrevetna</option>
                    <option value="Trokrevetna">Trokrevetna</option>
                    <option value="Apartman">Apartman</option>
                    <option value="Studio">Studio</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Broj kreveta</label>
                    <input type="number" name="broj_kreveta" class="form-control" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cena po noći (RSD)</label>
                    <input type="number" name="cena_po_noci" class="form-control" step="0.01" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Opis sobe</label>
                <textarea name="opis" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj sobu</button>
            <a href="index.php" class="btn btn-secondary">Nazad na listu</a>
        </form>
    </div>
</body>
</html>