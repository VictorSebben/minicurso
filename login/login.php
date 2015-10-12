<?php
use minicurso\classes\User;

require_once 'init.php';
require_once 'lib.inc.php';

if (isset($_POST["submit"])) {
    $user = new User();

    // filter_input() não utilizado propositalmente nos valores que vêm do formulário,
    // para testar a proteção dos prepared statements
    $login = $user->login($_POST['username'], $_POST['password']);

    if ($login) {
        header('Location: ./');
    } else {
        $_SESSION['error'] = 'Nome de usuário ou senha incorreto.';
    }
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<?php
if (isset($_SESSION['error'])) :
?>
    <div class="error-msg">
        <p><?= $_SESSION['error'] ?></p>
    </div>
<?php
    unset($_SESSION['error']);
endif;
?>
    <form action="" method="post">
        <div class="field">
            <label for="username">Usuário</label>
            <input type="text" name="username" id="username" autocomplete="on">
        </div>

        <div class="field">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" autocomplete="off">
        </div>

        <input type="hidden" name="token" value="<?= gen_token(); ?>">
        <input type="submit" value="Log in" name="submit">
    </form>
</body>
</html>
