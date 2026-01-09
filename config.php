<?php

// Make sure the website only uses session ID created by the server and makes the session ID more complex.
// Prevents people from editing the session cookies or gaining access to sensitive information.
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Correct domain
$domain = '.wheelspire.liamhilbers.dev';

// Check if HTTPS is used
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

// Set cookie params (30 min lifetime)
session_set_cookie_params(1800, '/', $domain, $isSecure, true);


// Starts the session after security params are defined.
session_start();

// Periodically regenerates the session ID every 30 minutes for security.
if (!isset($_SESSION['regeneration_time'])) {

    session_regenerate_id(true);
    $_SESSION['regeration_time'] = time();
} else {
    $time_interval = 60 * 30;
    if (time() - $_SESSION['regeneration_time'] >= $time_interval) {
        session_regenerate_id(true);
        $_SESSION['regeration_time'] = time();
    }
}
