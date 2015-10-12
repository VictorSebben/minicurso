<?php
namespace minicurso\classes;

class User {
    protected $id;
    protected $username;
    protected $password;

    /**
     * @var DB
     */
    protected $db;

    public function __construct() {
        $this->db = DB::getInstance();
    }

    public function findByUsername($username) {
        $user = new User();

        // encontrar usuário por 'username'
        $sql = "SELECT id, username FROM users WHERE username = :username";
        $db = $this->db->query($sql, array(array('name' => 'username', 'value' => $username)));

        if ($db->isOk() && ($db->getRowCount() == 1)) {
            $res = $db->getResults();
            $user->id = $res->id;
            $user->username = $res->username;
        }

        return $user;
    }

    public function find($id) {
        $user = new User();

        // encontrar usuário por 'username'
        $sql = "SELECT id, username FROM users WHERE id = :id";
        $db = $this->db->query($sql, array(array('name' => 'id', 'value' => $id)));

        if ($db->isOk() && ($db->getRowCount() == 1)) {
            $res = $db->getResults();
            $user->id = $res->id;
            $user->username = $res->username;
        }

        return $user;
    }

    public function isLoggedIn() {
        // verificar se o usuário está na sessão
        if (isset($_SESSION["user"])) {
            $userId = $_SESSION["user"];
            $user = $this->find($userId);

            // se o usuário existe no banco de dados, retornar true
            if (is_numeric($user->id)) {
                return true;
            }
        }

        return false;
    }

    public function login($username = null, $password = null) {
        // testa token do formulário
        if (!check_token($_POST['token'])) return false;

        // verificar se username existe
        $user = $this->findByUsername($username);

        if (is_numeric($user->id)) {
            // verificar senha digitada
            if (!$password) return false;

            $this->db->query("SELECT password FROM users WHERE id = :id", array(array('name' => 'id', 'value' => $user->id)));
            $res = $this->db->getResults();

            if ($this->db->isOk() && (password_verify($password, $res->password))) {
                $_SESSION["user"] = $user->id;
                return true;
            }
        }

        return false;
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function save() {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $this->db->query(
            $sql,
            array(array('name' => 'username', 'value' => $this->username),
            array('name' => 'password', 'value' => $this->password))
        );
    }
}
