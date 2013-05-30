<?php
/**
* Mpbot Debugger v.1.0 
*
* This program is simple realtime logger by HTML5 server-sent event 
* and HTTP redirector between developer's local and callback server.
* You can debug HTTP request/responses and implement early features 
* using developer's PC inner intranet.
*
* @author Channy Yun (channy@gmail.com)
* @copyright Daum DNA Lab
* @link http://github.com/channy/mpbot_debugger
*
*/

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$local_server="http://10.10.1.1/action.php"; // Your PC's server
$mypeople_server="https://apis.daum.net"; 
$logfile="log.txt"; 

echo "retry: 400\n\n"; // Push period: 0.4sec(400) is proper

// ------- HTTP forwarding ---------//
if($_POST['action'] OR $_GET['action']) {
        if($_POST['action']) $url= $local_server;
	elseif($_GET['action'])  $url= $mypeople_server.$_GET['action'];

	// HTTP Redirection
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

	// HTTP Logging
	$url= explode("?", $url);

        $post_data = "<b>".date('Y-m-d H:i:s')."</b>\nURL:".$url[0]."\n".print_r($_POST, true);
        $post_data .= file_get_contents($logfile);
        file_put_contents($logfile, $post_data);
}

// Push after reading logs
$handle = fopen('log.txt', 'r'); 
    while ($buffer = fgets($handle, 4096)) {
	$buffer=eregi_replace("\n","<br>",$buffer);
        $line .="$buffer";
    }
fclose($handle);
echo "data: ".$line."\n\n";
flush();

// Delete logs when size up 4k
if(filesize($logfile) > 4095) file_put_contents($logfile, "");
?>
