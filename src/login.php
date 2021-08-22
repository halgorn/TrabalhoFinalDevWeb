<?php

session_start();
include 'autoload.php';

$_SESSION['USER'] = '';
$error = '';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $authenticateUserController = AuthenticateUserControllerFactory::make();
        $authenticateUserDTO = new AuthenticateUserDTO($email, $password);

        $userId = $authenticateUserController->handle($authenticateUserDTO);

        if (isset($userId)) {
            $_SESSION['USER'] = $userId;

            Redirect::to('home.php');
        } else {
            $error = 'Erro ao fazer login, tente novamente';
        }
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <title>Login - Cadastro Covid 19</title>
</head>
<body>
    <div class="container p-4">
        <div class="row text-center mb-4">
            <h1>Cadastro Covid 19 - Login</h1>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger p-2">
                <strong><?= $error ?></strong>
            </div>
        <?php endif ?>
        <?php if ($_SESSION['REGISTER_SUCCESS']): ?>
            <div class="alert alert-success p-2">
                <strong><?= $_SESSION['REGISTER_SUCCESS'] ?></strong>
            </div>
        <?php endif ?>
        <form action="" method="POST">
            <div class="row mb-4">
                <div class="col">
                    <input
                        class="form-control"
                        name="email"
                        type="email"
                        placeholder="Email"
                        required
                    >
                </div>
                <div class="col">
                    <input
                        class="form-control"
                        name="password"
                        type="password"
                        placeholder="Senha"
                        required
                    >
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <button
                        class="btn btn-primary"
                        type="submit"
                    >
                        Fazer Login
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="d-flex p-0">
                    <a class="btn btn-link inline-block" href="./index.php">
                        Ainda não se cadastrou? Cadastre-se aqui
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
