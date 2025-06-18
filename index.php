<?php

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['amount'])) {
    http_response_code(400);
    echo json_encode(["error" => "Amount is required"]);
    exit();
}

$key_id = "rzp_live_1jk7IOT6sogUUl";
$key_secret = "K8Zk20RBm9Lv2rC3SkkRjOsS";

$data = [
    "amount" => $input["amount"],
    "currency" => "INR",
    "receipt" => $input["receipt"]
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
