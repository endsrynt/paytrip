<?php


echo "\e[0;33m[!] Reff: \e[0m";
$reff =trim(fgets(STDIN));

echo "\e[0;33m[!] Wallet Address Utama: \e[0m";
$address =trim(fgets(STDIN));
start:
function nama()
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	// $rand = json_decode($rnd_get, true);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
	return $name[2][mt_rand(0, 14) ];
	}

    function angkarand($length)
    {
        $str        = "";
        $characters = '1234567890';
        $max        = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }     
function randomstr($length)
{
    $str        = "";
    $characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $max        = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
      $rand = mt_rand(0, $max);
      $str .= $characters[$rand];
  }
  return $str;
}

$nama = explode(" ", nama());
$nama1 = strtolower($nama[0]);
$nama2 = strtolower($nama[1]);
$rand = angkarand(3);
$namalengkap = "$nama1$nama2$rand";
$domain = "gmailya.com";
$email = "$namalengkap@$domain";
$reff = "PT-vxWZu";
$deviceid = randomstr(16);
$rand1 = randomstr(4);
$rand2 = randomstr(6);
$fcmid = "f9kvv4ofQOGOzXiWDeGKKy:APA91bFehJKyt0nnQwqTEHgRIqbxmwDeN3mwr_d2huslz8SIpnQXBH9Afm93CFvEOZUfRrukzFVvMjrMHa6zyLOgHWE'.$rand2.'_DZHXVd6XdK7EPYmU8xLYmLKUjT6gZ6FqYvIhyL'.$rand1.'";
$pwd = "$nama1@$rand1";

echo "\e\33[32;1mRegistration $email\n";
echo "\e[0;33m[!]\e[0m STATUS     : ";

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.paytripapp.com/user/signup',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "username": "'.$namalengkap.'",
    "email": "'.$email.'",
    "password": "'.$pwd.'",
    "referredBy": "'.$reff.'",
    "country": "Indonesia",
    "gender": "male",
    "fcmID": "'.$fcmid.'",
    "deviceType": "Handset",
    "version": "1.9.4.3",
    "buildNumber": 44,
    "deviceVersion": 7.1,
    "deviceId": "'.$deviceid.'",
    "platform": "A5010"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$result = json_decode($response);
$status1 = $result->data->msg;
$otp = $result->data->code;

echo "\e[0;32m$status1\e[0m\n";
echo "\e[0;33m[!]\e[0m OTP        : ";
echo "\e[0;32m$otp\e[0m\n";
echo "\e[0;33m[!]\e[0m STATUS     : ";


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.paytripapp.com/user/verify',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "code": "'.$otp.'",
    "email": "'.$email.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$result = json_decode($response);
$status2 = $result->data->msg;
$privatekey = $result->data->privatekey;

echo "\e[0;32m$status2\e[0m\n";
echo "\e[0;33m[!]\e[0m PRIVATEKEY : ";
echo "\e[0;32m$privatekey\e[0m\n";
echo "\e[0;33m[!]\e[0m STATUS     : ";

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.paytripapp.com/user/login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "email": "'.$email.'",
    "password": "'.$pwd.'",
    "fcmID": "'.$fcmid.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$result = json_decode($response);
$status3 = $result->data->msg;

echo "\e[0;32m$status3\e[0m\n";
echo "\e[0;33m[!]\e[0m ADDRESS    : ";


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.paytripapp.com/user/profile',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "email": "'.$email.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$result = json_decode($response);
$address = $result->data->accountaddress;

echo "\e[0;32m$address\e[0m\n";
echo "\e[0;33m[!]\e[0m STATUS     : ";



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.paytripapp.com/contract/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "sendFrom": "'.$address.'",
    "privateKey": "'.$privatekey.'",
    "receiver": "0x488513bE846B178614fA416575C2d5608a91caB7",
    "amount": "50"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$result = json_decode($response);
$status4 = $result->data->msg;

echo "\e[0;32m$status4\e[0m\n";


goto start;
