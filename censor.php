<?php 
/*
Plugin Name: Orea Censor
Plugin URI: http://orea.daruisoft.com
Description: 减轻您言论审核的压力，让您的网站远离敏感信息威胁。
Version: 1.1
Author: Reage
Author URI: http://reage.diandian.com
*/
include dirname( __FILE__ ).'/admin.php';
define('OREA_ID', '%orea_id%');
define('OREA_KEY', '%orea_key%');
define('OREA_VER', '1.0');

add_filter('content_save_pre', 'orea_start');
//add_action('publish_post', 'orea_start');
/**
 * Orea entrance
 * @param string $content
 * @return string
 */
function orea_start($content){
	$timestamp = time();
	$sign = md5(OREA_KEY.$timestamp);
	$curlPost = 'id='.OREA_ID.'&sign='.$sign.'&timestamp='.$timestamp.'&content='.urlencode(base64_encode($content));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://orea.daruisoft.com/open.php/1/orea/filter.json');
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'OREA FOR WORDPRESS '.OREA_VER.' FROM:'.OREA_ID);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	$data = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($data, true);
	if (isset($result['error_code'])) {
		write_log($result['error_code'], $result['description']);
	}else{
		$content = base64_decode($result['content']);
	}
	
	return $content;
}
/**
 * Log recorder
 * @param int $error_code
 * @param string $error_description
 */
function write_log($error_code, $error_description) {
	$log = file_get_contents(dirname( __FILE__ ).'/error.log');
	$log = $error_code."($error_description)<br />".$log;
	file_put_contents(dirname( __FILE__ ).'/error.log', $log);
}
if (isset($_POST['submit'])) {
	$file = file_get_contents(dirname( __FILE__ ).'/censor.php');
	$file = str_replace(OREA_ID, $_POST['id'], $file);
	$file = str_replace(OREA_KEY, $_POST['key'], $file);
	file_put_contents(dirname( __FILE__ ).'/censor.php', $file);
}
?>