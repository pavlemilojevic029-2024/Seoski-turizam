<?php 
require_once 'config.php';
require_once 'classes/User.php';

$login_error = "";

if($_POST) {
    $user = new User();
    $loggedUser = $user->login($_POST['username'], $_POST['password']);

    if($loggedUser) {
        $_SESSION['user_id'] = $loggedUser['id'];
        $_SESSION['username'] = $loggedUser['username'];
        $_SESSION['ime'] = $loggedUser['ime'];
        
        header("Location: dashboard.php");
        exit();
    } else {
        $login_error = "Pogrešno korisničko ime ili šifra!";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Seoski Turizam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Prijava Domaćina</h4>
                    </div>
                    <div class="card-body">
                        <?php if($login_error): ?>
                            <div class="alert alert-danger"><?php echo $login_error; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label>Korisničko ime ili Email</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Šifra</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Uloguj se</button>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3">
                    Nemaš nalog? <a href="register.php">Registruj se</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>