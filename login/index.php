<?php
use minicurso\classes\DB;
use minicurso\classes\User;

require_once 'init.php';

$db = DB::getInstance();
$user = new User();

// testar se usuário está logado
if ($user->isLoggedIn()) {
    $user = $user->find($_SESSION['user']);

    // se estiver logado, mostrar mensagem e link para fazer logout
    echo '<h2>Welcome, ' . $user->getUsername() . '</h2>';
    echo '<a href="logout.php">Logout</a>';
} else {
    // se não estiver logado, redirecionar para página de login
    header("Location: login.php");
}
