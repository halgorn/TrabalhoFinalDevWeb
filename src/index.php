<?php

session_start();
include 'autoload.php';

$_SESSION['REGISTER_SUCCESS'] = '';
$_SESSION['USER'] = '';
$error = '';

if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['name']) &&
    isset($_POST['symptoms'])
) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $symptoms = $_POST['symptoms'];

    try {
        $createUserController = CreateUserControllerFactory::make();
        $createUserDTO = new CreateUserDTO($name, $email, $password, $symptoms);

        $createdUser = $createUserController->handle($createUserDTO);

        if (isset($createdUser->id)) {
            $_SESSION['REGISTER_SUCCESS'] = 'Cadastro efetuado com successo';

            Redirect::to('login.php');
        } else {
            $error = 'Erro ao cadastrar, tente novamente';
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
    <title>Cadastro COVID-19 - Trabalho DWI</title>
</head>
<body>
    <div class="container p-4">
        <div class="row text-center mb-4">
            <h1>Cadastro COVID-19 </h1>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger p-2">
                <strong><?= $error ?></strong>
            </div>
        <?php endif ?>
        <form action="" method="POST">
            <div class="row mb-2">
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
            <div class="row mb-4">
                <div class="col">
                    <input
                        class="form-control"
                        name="name"
                        type="text"
                        placeholder="Nome"
                        required
                    >
                </div>
                <div class="col">
                    <input
                        class="form-control"
                        name="symptoms"
                        type="text"
                        placeholder="Sintomas"
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
                        Cadastrar usuário
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="d-flex p-0">
                    <a class="btn btn-link inline-block" href="./login.php">
                        Já se cadastrou? Faça login aqui
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
