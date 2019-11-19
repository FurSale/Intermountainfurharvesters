<?php
//Get URL pieces
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
if(in_array($_SERVER['SERVER_PORT'],array(80, 443))){
	$serv_port = '';
}else{
	$serv_port=':'.$_SERVER['SERVER_PORT'];
}

//global variables
$GLOBALS['HOST'] = $protocol.$_SERVER['HTTP_HOST'].$serv_port.$path;
$site_version = '0.0.1';
$db_compatability = '0.0.1';

//global constants
define('USER_DIR','user-data/');
define('USER_DIR_URL',$GLOBALS['HOST'].'/'.USER_DIR);

function require_multi($files) {
    $files = func_get_args();
    foreach($files as $file)
        require_once($file);
}
?>
