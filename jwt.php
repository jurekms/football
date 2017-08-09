<?php
use \Firebase\JWT\JWT;
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL );

require('application/libraries/JWT/JWT.php');
require('application/libraries/JWT/ExpiredException.php');
require('application/libraries/JWT/SignatureInvalidException.php');



		$key = "ssssss";
		$jwtToken = array(
		    "iss" => "http://football.org",
		    "aud" => "http://football.org",
		    "iat" => time(),
				'exp' => time()+600,
				'payload' => array(	'username' => 'jurekm',
														"role"=>"user")
		);


		$jwtTokenEncode = JWT::encode($jwtToken, $key);

print_r($jwtToken);
print_r($jwtTokenEncode);

$key = "ssssss";
$cookieJwtToken = $jwtTokenEncode;
try {
	$jwtTokenDecode = (array) JWT::decode($cookieJwtToken, $key, array('HS256'));
	print_r($jwtTokenDecode);
}
catch ( Exception $e) {
	print_r($e->getMessage());
}
?>
