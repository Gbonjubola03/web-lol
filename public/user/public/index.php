<?php
session_start();
require '../vendor/autoload.php';

use GuzzleHttp\Client;

$config = require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['step']) && $_POST['step'] === '1') {
    // Step 1: Collect initial details
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $recipientName = $_POST['recipient_name'];
    $amount = $_POST['amount'];

    $client = new Client([
      'base_uri' => 'https://gate.qorepay.com/api/v1/',
      'headers' => [
        'Authorization' => 'Bearer ' . $config['api_key'],
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ],
    ]);

    try {
      // Create a new payout
      $response = $client->post('payouts/', [
        'json' => [
          'client' => [
            'email' => $email,
            'phone' => $phone,
          ],
          'payment' => [
            'amount' => $amount,
            'currency' => 'NGN',
            'description' => 'pinnocent',
          ],
          'sender_name' => 'pinnocent',
          'brand_id' => $config['brand_id'],
        ],
      ]);

      $payoutData = json_decode($response->getBody(), true);
      $executionUrl = $payoutData['execution_url'];

      // Store details in session
      $_SESSION['execution_url'] = $executionUrl;
      $_SESSION['email'] = $email;
      $_SESSION['phone'] = $phone;
      $_SESSION['recipient_name'] = $recipientName;
      $_SESSION['amount'] = $amount;

      // Get bank list
      $response = $client->get($executionUrl);
      $bankData = json_decode($response->getBody(), true);
      $_SESSION['banks'] = $bankData['detail']['data'];
      $_SESSION['payout_url'] = $bankData['payout_url'];

      // Redirect to step 2
      header('Location: index.php?step=2');
      exit;
    } catch (Exception $e) {
      $message = 'Error: ' . $e->getMessage();
    }
  } elseif (isset($_POST['step']) && $_POST['step'] === '2') {
    // Step 2: Collect bank details
    $accountNumber = $_POST['account_number'];
    $bankCode = $_POST['bank_code'];

    $client = new Client([
      'base_uri' => 'https://gate.qorepay.com/api/v1/',
      'headers' => [
        'Authorization' => 'Bearer ' . $config['api_key'],
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ],
    ]);

    try {
      // Execute payout
      $payoutUrl = $_SESSION['payout_url'];
      $response = $client->post($payoutUrl, [
        'json' => [
          'account_number' => $accountNumber,
          'bank_code' => $bankCode,
          'recipient_name' => $_SESSION['recipient_name'],
        ],
      ]);

      $executionData = json_decode($response->getBody(), true);

      if ($executionData['status'] === 'pending') {
        $message = 'Payout initiated successfully. Status: Pending.';
      } else {
        $message = 'Payout execution completed.';
      }

      // Clear session
     
    } catch (Exception $e) {
      $message = 'Error: ' . $e->getMessage();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payout Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f4f4f4;
    }
    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    p {
      text-align: center;
      color: red;
    }
  </style>
  <script>
    function updateBankCode() {
      const bankSelect = document.getElementById('bank_name');
      const bankCodeInput = document.getElementById('bank_code');
      const selectedBank = bankSelect.options[bankSelect.selectedIndex];
      bankCodeInput.value = selectedBank.getAttribute('data-code');
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>Payout Form</h1>
    <?php if (isset($message)): ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?>
    <?php if (!isset($_GET['step']) || $_GET['step'] === '1'): ?>
      <form method="POST" action="">
        <input type="hidden" name="step" value="1">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        <label for="recipient_name">Recipient Name:</label>
        <input type="text" id="recipient_name" name="recipient_name" required>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Next</button>
      </form>
    <?php elseif (isset($_GET['step']) && $_GET['step'] === '2'): ?>
      <form method="POST" action="">
        <input type="hidden" name="step" value="2">
        <label for="account_number">Account Number:</label>
        <input type="text" id="account_number" name="account_number" required>
        <label for="bank_name">Bank Name:</label>
        <select id="bank_name" name="bank_name" onchange="updateBankCode()" required>
          <option value="">Select a bank</option>
          <?php foreach ($_SESSION['banks'] as $bank): ?>
            <option value="<?php echo $bank['name']; ?>" data-code="<?php echo $bank['code']; ?>"><?php echo $bank['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="hidden" id="bank_code" name="bank_code" required>
        <button type="submit">Submit</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
