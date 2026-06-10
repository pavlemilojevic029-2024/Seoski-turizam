<?php 



require_once 'config.php';
require_once 'classes/User.php';



if($_POST) {
    $user = new User();
    
    $result = $user->register(
        $_POST['username'],
        $_POST['email'],
        $_POST['password'],
        $_POST['ime'],
        $_POST['prezime'],
        $_POST['selo'],
        $_POST['telefon']
    );

    if($result) {
        echo "<div class='alert alert-success'>Registracija uspešna! <a href='login.php'>Uloguj se</a></div>";
    } else {
        echo "<div class='alert alert-danger'>Greška pri registraciji!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registracija - Seoski Turizam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Registracija Domaćina</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Ime</label>
                                    <input type="text" name="ime" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Prezime</label>
                                    <input type="text" name="prezime" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Korisničko ime</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Šifra</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Selo</label>
                                <input type="text" name="selo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Telefon</label>
                                <input type="text" name="telefon" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Registruj se</button>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3">
                    Već imaš nalog? <a href="login.php">Uloguj se</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>