<?php
session_start();

if (isset($_SESSION['name'])) {
    $name = htmlspecialchars($_SESSION['name']);
    $id = htmlspecialchars($_SESSION['id']);

    destroy_session_and_data();

    echo "Welcome back number $id. Your name is, $name.";
} else {
    echo "Please <a href='sessions.php'>Click here</a> to log in.";
}

function destroy_session_and_data() {
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}
