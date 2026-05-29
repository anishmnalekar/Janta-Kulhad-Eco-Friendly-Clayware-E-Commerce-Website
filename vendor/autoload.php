<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . "/classes/" . $class . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

// Load external dependencies manually
require_once __DIR__ . '/fpdf/fpdf.php';
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';
require_once __DIR__ . '/phpmailer/Exception.php';
require_once __DIR__ . '/helpers/utility_functions.php';
?>
