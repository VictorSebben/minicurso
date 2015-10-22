<?php

require_once 'model/User.php';

try {
    $dsn = "pgsql:dbname=minicurso;host=127.0.0.1";
    $pdo = new PDO($dsn, 'ifsul', 'ifsul');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT id, username FROM users");
    $stmt->execute();
    $arrUsers = $stmt->fetchAll(PDO::FETCH_OBJ);

    echo '<pre>';
    print_r($arrUsers);
    echo '</pre>';

    $user = $arrUsers[0];
    echo $user->username;

    $id = 1;
    $getStmt = $pdo->prepare('SELECT username FROM users WHERE id = :id');
    $getStmt->bindParam(':id', $id);
    $getStmt->execute();
    $getStmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user = $getStmt->fetch();
    echo '<hr>';
    print_r($user);
} catch (PDOException $e) {
    die($e->getMessage());
}
