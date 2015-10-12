<?php

require_once 'model/User.php';

try {
    $arrParam = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    );
    $pdo = new PDO('pgsql:dbname=minicurso;host=localhost', 'ifsul', 'ifsul');

    $sql = 'SELECT id, username FROM users';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $arrUsers = $stmt->fetchAll(PDO::FETCH_OBJ);
    //$arrUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    echo '<pre>';
    print_r($arrUsers);
    echo '</pre>';

    $id = 18;
    $getStmt = $pdo->prepare('SELECT id, username, password FROM users WHERE id = :id');
    $getStmt->bindParam(':id', $id);
    $getStmt->execute();
    $getStmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user = $getStmt->fetch();
    echo "<h1>Hello, {$user->getUsername()}</h1>";
    var_dump($user);
} catch (PDOException $e) {
    die($e->getMessage());
}
