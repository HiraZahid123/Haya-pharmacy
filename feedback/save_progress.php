<?php
session_start();

if (isset($_POST['key']) && isset($_POST['value'])) {
    $key = $_POST['key'];
    $val = $_POST['value'];

    if (in_array($key, ['1', '2', '3', '4'])) {
        $_SESSION['q' . $key] = $val;
    } else {
        $_SESSION[$key] = $val;
    }
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
