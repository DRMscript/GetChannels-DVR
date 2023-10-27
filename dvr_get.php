<?php
header('Content-Type: text/plain');
header("Content-Type: application/x-mpegURL");
$server = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

$id = base64_decode($_GET['id']);
$ts = $_GET['ts'];

if (isset($ts)) {
     header('Content-Type: video/MP2T');
    echo cURL(ocultar('decrypt', $_GET['ts']));
    exit();
    }
 
//===========================================
//===========================================

//============ Version 1.0.8 ================

//===========================================
//===========================================

$master = "http://localhost:8089/devices/ANY/channels/".$id."/hls/master.m3u8?abr=false";
$path = explode("/" , $master);
$path_master = str_replace(end($path) , "" , $master);
$stream = explode(PHP_EOL , str_replace("stream" , $path_master."stream" , cURL($master)));
$search = array(",".PHP_EOL);
$replace = array(",".PHP_EOL.$path_master);
$ts = str_replace($search , $replace , cURL($stream[3]));
$part = explode(PHP_EOL, $ts);
for ($i = 0; $i < count($part) - 1; $i++) {
	if (strpos($part[$i], '#') !== false) {
		echo $part[$i] . PHP_EOL;
		}else{
			echo  $server."?ts=".ocultar('encrypt', $part[$i]).PHP_EOL;
			}
		}



function cURL($url){
	$headers = 
	[
	'Connection: keep-alive',
	'Sec-Fetch-Dest: empty',
	'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36',
	'Dnt: 1',
	'Accept: */*',
	'Sec-Fetch-Site: same-origin',
	'Sec-Fetch-Mode: cors',
	'Referer: http://localhost:8089/admin/guide/grid',
	'Accept-Language: en-US,en;q=0.9,pt-BR;q=0.8,pt;q=0.7,es;q=0.6,la;q=0.5'
	];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
	$content = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
		}
	curl_close($ch);
	return $content;
	}


function ocultar($action = 'encrypt', $string = false){
    $action = trim($action);
    $output = false;
    $myKey = 'key1';
    $myIV = 'key2';
    $encrypt_method = 'AES-256-XTS';
    $secret_key = hash('sha256', $myKey);
    $secret_iv  = substr(hash('sha256', $myIV), 0, 16);
    if ($action && ($action == 'encrypt' || $action == 'decrypt') && $string) {
        $string = trim(strval($string));
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
            $output = base64_encode($output);
        }
        if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $secret_key, 0, $secret_iv);
        }
    }
return $output;
}

?>
