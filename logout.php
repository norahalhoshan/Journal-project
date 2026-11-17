<?php

session_start();

// remove all session variables
$_SESSION = [];

// delete the session cookie from the browser
if(ini_get("session.use_cookies")){

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );

}

// destroy the session on the server
session_destroy();

header("Location: login.php");
exit();

?>
