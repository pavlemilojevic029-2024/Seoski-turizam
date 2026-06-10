<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - <?= htmlspecialchars($_SESSION['ime'] ?? 'Domaćin') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Seoski Turizam</a>
        
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3 text-light">
                    Dobrodošao, <strong><?= htmlspecialchars($_SESSION['ime'] ?? 'Domaćin') ?></strong>
                </span>
                <a href="logout.php" class="btn btn-outline-light">Odjava</a>
        </div>
    </div>
</nav>

    <div class="container mt-5">
        <h2 class="mb-4">Dobrodošli u vaš panel</h2>
        
        <div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Moje Sobe</h5>
                <p class="card-text">Upravljajte svojim smeštajem</p>
                <a href="sobe/index.php" class="btn btn-primary">Pogledaj sobe</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Rezervacije</h5>
                <p class="card-text">Pregledajte i dodajte rezervacije</p>
                <a href="rezervacije/index.php" class="btn btn-primary">Pogledaj rezervacije</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Recenzije</h5>
                <p class="card-text">Ocene i komentari gostiju</p>
                <a href="recenzije/index.php" class="btn btn-primary">Pogledaj recenzije</a>
            </div>
        </div>
    </div>
</div>
</html>