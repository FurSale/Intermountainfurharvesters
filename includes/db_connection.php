<?php
$xml = null;
if(file_exists(__DIR__.'\database.xml')){
	$xml = simplexml_load_file(__DIR__.'\database.xml');
}else{
	CreateXML();
	echo("Database config error. Enter correct DB info into XML file.");
	exit;
}
define("DB_SERVER",$xml->server);
define("DB_USER",$xml->username);
define("DB_PASS",$xml->password);
define("DB_NAME",$xml->name);

$connection = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . "<br/>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br/>";
	echo "Debugging error: " . mysqli_connect_error() . "<br/>";
	echo("Database config error. Enter correct DB info into XML file.");
    exit;
}

function confirm_query($result){
	global $connection;
	if(!$result){
		die("Query failed: ".mysqli_error($connection));	
	}else{
		return true;
	}
}

function CreateXML(){
    $doc = new DOMDocument();
			$doc->formatOutput = true;
			
			$b = $doc->createElement( "database" );
			
				$firstrun = $doc->createElement( "firstrun" );
				$firstrun->appendChild(
					$doc->createTextNode( "true" )
				);
				$b->appendChild( $firstrun );
				
				$server = $doc->createElement( "server" );
				$server->appendChild(
					$doc->createTextNode( "" ) 
				);
				$b->appendChild( $server );
				
				$username = $doc->createElement( "username" );
				$username->appendChild(
					$doc->createTextNode( "" )
				);
				$b->appendChild( $username );
				
				$password = $doc->createElement( "password" );
				$password->appendChild(
					$doc->createTextNode( "" )
				);
				$b->appendChild( $password );
				
				$name = $doc->createElement( "name" );
				$name->appendChild(
					$doc->createTextNode( "" )
				);
				$b->appendChild( $name );
			
			$doc->appendChild( $b );
			
			$doc->save(__DIR__.'\database.xml');
}
?>