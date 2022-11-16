<?php
include('../includes/dbh.inc.php');

header("Content-Type: application/json");

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "stkTinypesaResponse.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$callbackContent = json_decode($stkCallbackResponse);

$ResultCode = $callbackContent->Body->stkCallback->ResultCode;
$CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
$Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$PhoneNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[4]->Value;

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$sql->execute(array($id));
$data = $sql->fetch(PDO::FETCH_ASSOC);
$balance = $data['wallet'];

Database::disconnect();
if ($ResultCode == 0) {

    // Create connection
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO deposit(CheckoutRequestID,ResultCode,amount,MpesaReceiptNumber,PhoneNumber) VALUES (?, ?, ?, ?, ?)"

    $deposit = $pdo->prepare($sql);
    $deposit->execute(array($CheckoutRequestID, $ResultCode, $Amount, $MpesaReceiptNumber, $PhoneNumber));

    if ($deposit) {
      $new_balance = $balance + $Amount;
      $updated_balance = $pdo->prepare("UPDATE users SET wallet = ? WHERE phone = ?");
      $updated_balance->execute(array($new_balance, $PhoneNumber));
      Database::disconnect();
    }

}
