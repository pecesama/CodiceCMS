<?php
class utils{
	//Debug 
	public function pre($arr,$exit=true){
		echo "<pre>";print_r($arr);echo"</pre>";
		if($exit)exit;
	}

	public function convert2HTML($content){
		$content = htmlspecialchars($content);
		return str_replace("$","&#36;",$content);
	}

	public function htmlentities($msg){
		$msg = str_replace("<","&lt;",$msg);
		$msg = str_replace(">","&gt;",$msg);
		return $msg;
	}

	public function getIP(){
		if($ip = getenv('HTTP_X_FORWARDED_FOR'))
			return $ip;
		elseif($ip = getenv('REMOTE_ADDR'))
			return $ip;		
		return false;
	}
	
	public function nl2br($comment){
		if(preg_match('/<code.+/',$comment)){
			$result = preg_replace_callback("/(.*?)<code(.*?)>(.*?)<\/code>(.*?)/siU",	create_function('$a','return nl2br($a[1])."<code{$a[2]}>{$a[3]}</code>".nl2br($a[4]);'), $comment);
			return $result;
		}else{
			return nl2br($comment);
		}	
	}
}