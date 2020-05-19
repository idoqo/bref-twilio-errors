<?php
use Maknz\Slack\Client;
/**
 * Responds to incoming webhook from the Twilio Console Debugger
 *
 * @author  Michael Okoko <michaelsokoko@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 */
require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    if (strtoupper($_SERVER['REQUEST_METHOD'] != 'POST')) {
        throw new Exception("Received non-post request on webhook handler");
    }

    $params = json_decode($_POST['Payload']);

    $message = "New Twilio error at ". $_POST['Timestamp'] ."\n";
    $message .= "*Level:* ".$_POST['Level']."\n";
    $message .= "*Console URL:* https://www.twilio.com/console/debugger/".$_POST['Sid']."\n";
    $message .= "*Details: *\n";
    $message .= "```\n";
    $message .= json_encode($params->more_info, JSON_PRETTY_PRINT)."\n";
    $message .= "```";
    sendTwilioError($message);
}
catch (Exception $e) {
    sendHandlerError($e->getMessage());
}
header("Content-type: application/json");
echo json_encode(['message' => "OK"]);
exit(0);

function sendHandlerError($message) {
    $slackHookUrl = getenv("SLACK_HOOK_URL");
    $client = new Client($slackHookUrl);
    $client->to('#general')->send($message);
}

function sendTwilioError($message) {
    $slackHookUrl = getenv("SLACK_HOOK_URL");
    $client = new Client($slackHookUrl);
    $client->to('#general')
        ->enableMarkdown()
        ->send($message);
}

