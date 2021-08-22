<?php

session_start();
include 'autoload.php';

$_SESSION['REGISTER_SUCCESS'] = '';
$error = '';

if (!isset($_SESSION['USER'])) {
    Redirect::to('login.php');
}

$user = null;
$users = [];

try {
    $fetchUserController = FetchUserControllerFactory::make();
    $user = $fetchUserController->handle($_SESSION['USER']);
} catch (\Throwable $th) {
    Redirect::to('login.php');
}

try {
    $fetchUsersController = FetchUsersControllerFactory::make();
    $users = $fetchUsersController->handle();
} catch (\Throwable $th) {
    $error = $th->getMessage();
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
    <link rel="stylesheet" href="./assets/map.css">
    <title>Home - Trabalho DWI</title>
</head>
<body>
    <div class="container p-4">
        <div
            class="
                d-flex
                flex-row
                justify-content-between
                align-items-center
                mb-4
            "
        >
            <h1>Cadastro Covid 19 - Home</h1>
            <div>
                <button class="btn btn-success px-4" type="button">
                    Bem vindo <?= $user->name ?>
                </button>
                <a class="btn btn-primary px-4" href="./login.php">Sair</a>
            </div>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger p-2">
                <strong><?= $error ?></strong>
            </div>
        <?php endif ?>
        <?php if (sizeof($users)): ?>
            <table class="table table-hover mb-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Sintomas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->name ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->symptoms ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
        <div>
            <h2 class="h1">Localização do Hospital Regional Alto Vale - Rio do Sul</h2>
            <div id="map" class="map mt-4"></div>
            <p id="info" class="info"></p>
        </div>
    </div>
    <script src="./assets/map.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnFTI3jGZL6_fPREsCM-6PUR48j8pFQyk&callback=init"></script>
</body>
</html>
