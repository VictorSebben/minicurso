<?php
use minicurso\classes\User;

require_once 'init.php';

$user = new User();
$user->setUsername('victor');
$user->setPassword(password_hash('1234', PASSWORD_DEFAULT));
$user->save();
