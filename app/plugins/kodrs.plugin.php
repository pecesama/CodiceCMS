<?php

class kodrs extends plugins {   

	function __construct(){
		parent::__construct();
		$this->registry = registry::getInstance();
		
		if (!defined('GESHI_VERSION')) {
			require_once(Absolute_Path."app/plugins/geshi/GeSHi.php");
		}
		
		$this->addAction('index_post_content', 'source_code_beautifier');
		$this->addAction('admin_comments_content', 'comment_source_code_beautifier');
		$this->addAction('index_comment_content', 'comment_source_code_beautifier');
	}

	public function source_code_beautifier() {
		$rows = $this->registry->posts;

		if(count($rows)>0){
			foreach($rows as $key=>$post){
				$text = $rows[$key]['content'];            

				#$regexp = "/<code\s+.*lang\s*=\"(.*)\">(.*)<\/code>/siU";
				$regexp = "/<code(.*)>(.*)<\/code>/siU";

				$result = preg_replace_callback($regexp, array('kodrs', 'replace_with_geshi'), $text);
				$rows[$key]['content'] = $result;
			}
		}
		
		$this->registry->modify('posts',$rows);
	}

	public function comment_source_code_beautifier() {
		$rows = $this->registry->comments;

		if(count($rows)>0){
			foreach($rows as $key=>$post){
				$text = $rows[$key]['content'];            

				$result = preg_replace_callback("/<code\s+(.*)>(.*)<\/code>/siU", array('kodrs', 'replace_with_geshi'), $text);
				$rows[$key]['content'] = $result;
			}
		}
		
		$this->registry->modify('comments',$rows);
	}

	private function replace_with_geshi($matches) {         
		$params = $this->getParams(strtolower($matches[1]));
		$code = trim($matches[2]);
		$lang = $params['lang'];
		$geshi = new geshi($code, (isset($lang)) ? $lang : "");    
		$geshi->enable_classes(false);
		$geshi->set_overall_id('geshi_code');

		if(isset($params['title'])){
			$geshi->highlight_lines_extra(array($params['title']));
		}

		$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);

		$geshi->set_tab_width(3);
		$geshi->set_header_type(GESHI_HEADER_DIV);

		$code = "<div class=\"kodrs\">".@$geshi->parse_code()."</div>";

		return $code;
	}

	private function getParams($data){
		// utils::pre($data,false);
		
		preg_match_all("/(\w+?)\s*=\s*\"(.+?)\"/",$data,$out);
		unset($out[0]);
		
		foreach($out[2] as $k => $v){
			$resultado[$out[1][$k]] = trim($v);
		}

		//lineas a resaltar, las metemos en un arreglo.
		if(isset($resultado["title"])){
			$lines = explode(",",$resultado['title']);
			//utils::pre($lines,false);

			foreach($lines as $k => $v){
				if(strpos($v,"-")){
					unset($lines[$k]);
					$values = explode("-",$v);
				
					$c = $values[0];
					$lines[] = $c;
					do{
						$c++;
						$lines[] = $c;
					}while($c<=$values[1]-1);
				}
			}
			$resultado['title'] = $lines; 
		}
		/*
			para decir que lineas quiero resaltar use el parametro 'title' porque es un
			parametro estandar de la etiqueta <code>, de lo contrario si el plugin no 
			estuviera activado habria un error en el codigo HTML.
		*/
		
		//utils::pre($lines);
		
		//utils::pre($out,false);
		
		//utils::pre($resultado);
		if(isset($resultado))
			return $resultado;
		else
			return false;
	}

}
