<?php

try {
    $dsn = "pgsql:dbname=minicurso;host=127.0.0.1";
    $pdo = new PDO($dsn, 'ifsul', 'ifsul');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = "foo";
    $password = crypt('1234');

    $sql = "INSERT INTO users (username, password)
            VALUES (:username, :password)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $stmt->closeCursor();

    $username = 'bar';
    $password = crypt('1234');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}
