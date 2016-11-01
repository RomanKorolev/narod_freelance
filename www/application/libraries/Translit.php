<?php

if(!class_exists("Translit")):

class Translit{
	function __construct($russian_enc = 'windows-1251', $safe = false){
		if($safe){
			$this->lat = preg_split('# #', "A B V G D E Jo Zh Z I J K L M N O P R S T U F H C Ch Sh Sch _ Y _ Je Ju Ja a b v g d e jo zh z i j k l m n o p r s t u f h c ch sh sch _ y _ je ju ja");
		}else{
			$this->lat = preg_split('# #', "A B V G D E Jo Zh Z I J K L M N O P R S T U F H C Ch Sh W ## Y \" Je Ju Ja a b v g d e jo zh z i j k l m n o p r s t u f h c ch sh w # y ' je ju ja");
		}
		$this->russian_enc = $russian_enc;
		$this->init_tables($russian_enc);
	}

	protected function init_tables($enc){
		$rus2lat = array();
		$lat2rus = array();
		$rus_cp1251 = "À Á Â Ã Ä Å ¨ Æ Ç È É Ê Ë Ì Í Î Ï Ð Ñ Ò Ó Ô Õ Ö × Ø Ù Ú Û Ü Ý Þ ß à á â ã ä å ¸ æ ç è é ê ë ì í î ï ð ñ ò ó ô õ ö ÷ ø ù ú û ü ý þ ÿ";
		#'KOI8-U', 'UTF-8', 'CP866', 'Windows-1251'
		$rus_cp1251 = iconv('Windows-1251', $enc, $rus_cp1251);
		$lat = $this->lat;
		$rus = preg_split('# #', $rus_cp1251);
		for($i = 0; $i < count($lat); $i++){
			$l = $lat[$i];
			$r = $rus[$i];
			$rus2lat[$r] = $l;
			$lat2rus[$l] = $r;
		}
		$this->rus2lat = $rus2lat;
		$this->lat2rus = $lat2rus;
	}

	protected function char_to_lat($c){
		return isset($this->rus2lat[$c]) ? $this->rus2lat[$c] : $c;
	}

	protected function char_to_rus($c){
		return isset($this->lat2rus[$c]) ? $this->lat2rus[$c] : $c;
	}

	function to_lat($s, $s_enc = null){
		if($s_enc){
			$s = iconv($s_enc, $this->russian_enc, $s);
		}
		$out = '';
		for($i = 0; $i < strlen($s); $i++){
			$out .= $this->char_to_lat($s[$i]);
		}
		return $out;
	}

	function to_rus($s){
		$out = '';
		$len = strlen($s);
		for($i = 0; $i < $len; $i++){
			$c1 = $s[$i];
			$c2 = (($i + 1) < $len) ? $s[$i + 1] : '';
			$s2 = $c1 . $c2;
			$s2_ = $this->char_to_rus($s2);
			if($s2 == $s2_){
				$out .= $this->char_to_rus($c1);
			}else{
				$out .= $s2_;
				$i++;
			}
		}
		return $out;
	}

}

endif;
