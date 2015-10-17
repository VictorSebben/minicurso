<?php

namespace tweets\classes;

use \PDO;
use \PDOException;

class DB {

    /**
     * @var PDO
     */
    public $pdo;
    protected static $instance;
    protected $error;

    // resultado da consulta
    protected $results;

    // número de rows obtidas na consulta
    protected $rowCount;

    public function __construct() {
        $this->error = false;
        $this->rowCount = 0;

        try {
            $arrOpt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];

            $this->pdo = new PDO("pgsql:dbname=minicurso;host=127.0.0.1", "ifsul", "ifsul", $arrOpt);
        } catch (PDOException $e) {
            die('Falha na conexão');
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public function getResults() {
        return $this->results;
    }

    public function getRowCount() {
        return $this->rowCount;
    }

    public function isOk() {
        return ! $this->error;
    }

    public function get($sql, $params = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $this->query($sql, $params);
        if ($this->isOk()) {
            $this->results = $this->stmt->fetch($fetchMode);
            $this->rowCount = $this->stmt->rowCount();
        }
    }

    public function getList($sql, $params = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $this->query($sql, $params);
        if ($this->isOk()) {
            $this->results = $this->stmt->fetchAll($fetchMode);
            $this->rowCount = $this->stmt->rowCount();
        }
    }

    public function query($sql, $params = array(), $list = false) {
        // alguma consulta prévia pode ter resultado em erro:
        // Portanto, vamos limpar a propriedade $this->error
        $this->error = false;
        $this->results = array();
        $this->rowCount = 0;

        if ($this->stmt = $this->pdo->prepare($sql)) {
            if (count($params)) {
                for ($i = 0; $i < count($params); $i++) {
                    $this->stmt->bindParam($params[$i]['name'], $params[$i]['value']);
                }
            }

            if ( ! $this->stmt->execute()) {
                $this->error = true;
            }
        }
    }
}
