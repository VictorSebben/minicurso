<?php

function get_link_order_by($field) {
    $order = filter_input(INPUT_GET, 'ord', FILTER_SANITIZE_SPECIAL_CHARS);
    $direction = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($order === $field) {
        $direction = ($direction == 'ASC') ? 'DESC' : 'ASC';
    } else {
        $direction = 'ASC';
    }

    return "tweets.php?ord={$field}&dir={$direction}";
}
