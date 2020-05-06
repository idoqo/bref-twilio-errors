<?php
/**
 * Responds to incoming webhook from the Twilio Console Debugger
 * 
 * @author  Michael Okoko <michaelsokoko@gmail.com>
 * @license https://mchl.xyz MIT
 */

require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Content-type: application/json");
if (isset($_GET['message'])) {
    echo json_encode(['message' => "Hello 🌍"]);
} else {
    echo json_encode(['message' => "Hello"]);
}
exit(0);
