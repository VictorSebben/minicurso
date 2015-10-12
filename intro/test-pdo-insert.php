<?php

try {
    $arrParam = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $pdo = new PDO('pgsql:dbname=minicurso;host=127.0.0.1', 'ifsul', 'ifsul', $arrParam);

    $username = 'victor';
    $password = password_hash('1234', PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

    // preparar query
    $stmt = $pdo->prepare($sql);
    // atribuir valor aos campos
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    // executar query
    $stmt->execute();

    $stmt->closeCursor();

    /***** outro usuário *****/
    $username = 'foo';
    $password = password_hash('bar', PASSWORD_DEFAULT);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $stmt->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
