<?php
//Get URL pieces
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
if(in_array($_SERVER['SERVER_PORT'],array(80, 443))){
	$serv_port = '';
}else{
	$serv_port=':'.$_SERVER['SERVER_PORT'];
}

//global variables
$GLOBALS['HOST'] = $protocol.$_SERVER['HTTP_HOST'].$serv_port;
$site_version = '0.0.1';
$db_compatability = '0.0.1';

//global DB variables

//Site Info
$query="SELECT * FROM `site_info` WHERE `id` = 1";
$result=mysqli_query( $connection, $query);
$GLOBALS['site_info']=mysqli_fetch_array($result);

//global constant
?>
