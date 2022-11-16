<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $amount = $_POST['amount']; //Amount to transact
  $phonenuber = $_POST['phone']; // Phone number paying
  $Account_no = 'FLEX ANGENCIES'; // Enter account number optional
  $url = 'https://tinypesa.com/api/v1/express/initialize';
  $data = array(
      'amount' => $amount,
      'msisdn' => $phonenuber,
      'account_no'=>$Account_no
  );
  $headers = array(
      'Content-Type: application/x-www-form-urlencoded',
      'ApiKey: jpUTbK4WyKU' // Replace with your api key
   );
  $info = http_build_query($data);

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  $resp = curl_exec($curl);
  $msg_resp = json_decode($resp);

  if($msg_resp ->success == 'true'){
    echo "
      <script>alert('Request send, Please wait for STK PUSH to enter PIN')</script>
       <script>window.location = '../index.php?'</script>";
  }

} else {
  header('location: ../forms.php');
}
?>
