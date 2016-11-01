<?

if(!class_exists("Translit")):

class Curl{

	protected $ch;

	function __construct($ch = 0){
		if($ch){
			$this->ch = $ch;
		}else{
			$this->ch = curl_init();
		}
	}

	function __destruct(){
		curl_close($this->ch);
	}

	function copy(){
		$ch = curl_copy_handle($this->ch);
		return self::build($ch);
	}

	static function build($ch = 0){
		return new self($ch);
	}

	function opt($opt, $val = NULL){
		if(is_array($opt)){
			$res = curl_setopt_array($this->ch, $opt);
		}else{
			$res = curl_setopt($this->ch, $opt, $val);
		}
		$this->check_err();
	}

	function info(){
		curl_getinfo();
		$this->check_err();
	}
		
	static function ver(){
		return curl_version();
	}

	static function def(){
#		get_defined_constants();
print_r(get_defined_constants(true));

	}

	function exec($url){
		$this->opt(CURLOPT_URL, $url);
		$res = curl_exec($this->ch);
		$this->check_err();
		return $res;
	}

	function check_err(){
		$errno = curl_errno($this->ch);
		if($errno != CURLE_OK){
			$hint = 0;
			switch($errno){
				case CURLE_FAILED_INIT:
					$hint = "Invalid OPTION?";
					break;
				case CURLE_SSL_PEER_CERTIFICATE:
					$hint = "try CURLOPT_SSL_VERIFYHOST=0";
					break;
			}
			if($hint){
				$hint = ", Hint: $hint";
			}else{
				$hint = "";
			}
			$error = curl_error($this->ch);
			throw new Exception("CURL: Error: $errno, '$error'$hint");
		}
	}
#$this->opt

}

endif;
