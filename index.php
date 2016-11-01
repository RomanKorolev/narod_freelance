<?

error_reporting(E_ALL);
ini_set('display_error', '1');

require_once "socket/tcpsocket.php";


function make_req($host, $path){
	$req = "GET $path HTTP/1.0\r\n";
	$req .= "Host: $host\r\n";
	$req .= "\r\n";
	return $req;
}

function load_test($url, $threads_count = 1, $timeout = 3){
	$a = parse_url($url);
	$port = 80;
	if(isset($a['port'])){
		$port = (int) $a['port'];
	}
	$host = '';
	$path = '/';
	if(preg_match('#^http://[^/]+(.*)#', $url, $m)){
		$path = $m[1];
	}
	
	$s = new TCPSocket('185.56.220.184', 3128, 1);
	echo 'ok';
}


load_test('http://ya.ru/', 1);
