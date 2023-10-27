<?php

header('Content-Type: text/plain');

$server = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$path = str_replace ("list.php" , "dvr_get.php" , $server);

$guide = "http://localhost:8089/devices/ANY/guide";
$json = json_decode(cURL($guide) , true);

echo "#EXTM3U".PHP_EOL;
for($i=0 ; $i < count($json) ; $i++){
	$guide = $json[$i]['Airings'][0]['Title'];
	echo "#EXTINF:-1 group-title=\"DVR\" tvg-name=\"".$json[$i]['Channel']['Name']."\" tvg-logo=\"".$json[$i]['Channel']['Image']."\", ".strtoupper(str_replace("-" , " " , $json[$i]['Channel']['Name'])).PHP_EOL;
	echo $path."?id=".base64_encode($json[$i]['Channel']['Number'])."&type=master.m3u8".PHP_EOL.PHP_EOL;
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

?>
