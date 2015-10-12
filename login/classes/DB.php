<?php
namespace minicurso\classes;

use \PDO;
use \PDOException;

class DB {

    /**
     * @var PDO
     */
    protected $pdo;
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

    public function query($sql, $params = array(), $list = false) {
        // caso alguma consulta prévia tenha resultado em erro, limpar a propriedade error
        $this->error = false;
        $this->results = array();
        $this->rowCount = 0;

        if ($stmt = $this->pdo->prepare($sql)) {
            if (count($params)) {
                for ($i = 0; $i < count($params); $i++) {
                    $stmt->bindParam($params[$i]['name'], $params[$i]['value']);
                }
            }

            if ( ! $stmt->execute()) {
                $this->error = true;
            } else {
                if ($list)
                    $this->results = $stmt->fetchAll(PDO::FETCH_OBJ);
                else
                    $this->results = $stmt->fetch(PDO::FETCH_OBJ);
                $this->rowCount = $stmt->rowCount();
            }
        }

        $stmt->closeCursor();
        return $this;
    }

    public function getQuery() {

    }
}
