<?php
/**
 * Created by PhpStorm.
 * User: harrisonchow
 * Date: 11/11/15
 * Time: 12:23 AM
 */
$getPost = json_decode($_POST["jsonData"]);
echo($getPost . "\n");
print_r($getPost);
echo("\n");
require '../../vendor/autoload.php';

//$sendTo = "iamnobodyrandom@yahoo.com";
$sendTo = $_POST["email"];
$sendToName = $_POST["fullName"];
$sendFrom = "info@westerncyber.club";
$sendFromName = "Western Cyber Security Club";
$sendGridUsr = "app43353028@heroku.com";
$sendGridPassword = "khpoaec44366";

$emailBody = "Test message";
$emailSubject = "Test email";
$sendGridTemplateId = "daf01737-4403-4218-92cc-0b888254d80c";

$sendgrid = new SendGrid($sendGridUsr, $sendGridPassword);

$message = new SendGrid\Email();
$message
    ->addTo($sendTo, $sendToName)
    ->setFrom($sendFrom)
    ->setFromName($sendFromName)
    ->setSubject($emailSubject)
    ->setHtml($emailBody)
    ->setTemplateId($sendGridTemplateId)
;

try {
    $sendgrid->send($message);

} catch(SendGrid\Exception $e) {
    echo $e->getCode();
    foreach($e->getErrors() as $er) {
        echo $er;
    }
}

echo "{'result': 'success'}";
?>

