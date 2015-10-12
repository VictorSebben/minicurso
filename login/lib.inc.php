<?php

function gen_token() {
    return $_SESSION['token'] = md5(uniqid());
}

function check_token($token) {
    if ( isset( $_SESSION[ 'token' ] ) && ( $token === $_SESSION[ 'token' ] ) ) {
        unset( $_SESSION[ 'token' ] );
        return true;
    }

    return false;
}

function flash($name, $msg = '') {
    if (isset($_SESSION[$name])) {
        $text = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $text;
    } else {
        $_SESSION[$name] = $msg;
    }
}

function ppr($obj) {
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}
