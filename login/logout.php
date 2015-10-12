<?php
use minicurso\classes\User;

require_once 'init.php';

$user = new User();
$user->logout();

header('Location: ./');
