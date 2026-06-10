<?php 
require_once '../config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Recenzija.php';
require_once '../classes/Soba.php';

$recenzija = new Recenzija();
$sobaObj = new Soba();
$sobe = $sobaObj->getAllByUser($_SESSION['user_id']);

$message = "";

if($_POST) {
    $result = $recenzija->create(
        $_POST['soba_id'],
        $_SESSION['user_id'],
        $_POST['gost_ime'],
        $_POST['ocena'],
        $_POST['komentar']
    );

    if($result) {
        $message = "✅ Recenzija uspešno dodata!";
        header("Location: index.php");
        exit();
    } else {
        $message = "❌ Greška pri dodavanju recenzije!";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova Recenzija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Dodaj novu recenziju</h2>
        
        <?php if($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" class="card p-4">
            <div class="mb-3">
                <label>Izaberi sobu</label>
                <select name="soba_id" class="form-control" required>
                    <option value="">-- Izaberi sobu --</option>
                    <?php foreach($sobe as $s): ?>
                        <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['naziv']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Ime gosta</label>
                <input type="text" name="gost_ime" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Ocena (1-5)</label>
                <select name="ocena" class="form-control" required>
                    <option value="">Izaberi ocenu...</option>
                    <option value="5">5 - Odlična</option>
                    <option value="4">4 - Veoma dobra</option>
                    <option value="3">3 - Dobra</option>
                    <option value="2">2 - Osrednja</option>
                    <option value="1">1 - Loša</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Komentar</label>
                <textarea name="komentar" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Sačuvaj recenziju</button>
            <a href="index.php" class="btn btn-secondary">Nazad</a>
        </form>
    </div>
</body>
</html>