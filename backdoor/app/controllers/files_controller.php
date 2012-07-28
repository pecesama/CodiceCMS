<?php

class files_controller extends appcontroller{
	public function __construct(){
		parent::__construct();
		
		if($this->User->isLogged() === FALSE){
			$this->redirect("login");
		}
	}
	
	public function index($id = NULL){
		$this->view->setLayout("admin");
		$this->title_for_layout($this->l10n->__("Archivos - Codice CMS"));
		$f= new file();
		$this->view->files = $f->findAll();
		//Comprobamos que el directorio destino exista
		if(!is_dir('app/'.$this->config["blog"]['blog_upload_folder'])){
			$this->messages->addMessage($this->l10n->__("To upload files you must exist and have the appropriate access permissions to the directory").$this->config["blog"]['blog_upload_folder']);
			$this->view->disableUploadForm = true;
		}else{
			$this->view->disableUploadForm = false;
		}
		/////////////////////////////////
		$total_rows = count($f);
		$page = $id;
		$page = (is_null($page)) ? 1 : $page ;
		$limit = 5;
		$offset = (($page-1) * $limit);
		$limitQuery = $offset.",".$limit;
		$targetpage = $this->path.'comments/';
		$pagination = $this->pagination->init($total_rows, $page, $limit, $targetpage);
		$this->view->pagination = $pagination;
		/////////////////////////////////
		$this->render();
	}
	
	
	public function remove($id){
		$file = new file();
		$file->find($id);
		$file->delete();
		try{
			unlink('app/'.$this->config["blog"]['blog_upload_folder'].'/'.$file->name);
			$this->messages->addMessage($this->l10n->__("Deleted"));
		}catch(Exception $e){
			$this->messages->addMessage($this->l10n->__("Could not delete the file, check directory permissions"));
		}
		$this->redirect("files");
	}
	
	public function view($id){
		$file = new file();
		$file->find((int)$id);
		if($file->exists()){
			$password = (isset($_POST['file_'.$file->id_file.'psw']))? $_POST['file_'.$file->id_file.'psw']: '';
			if($password != $file->password){
				if(isset($_POST['file_'.$file->id_file.'psw'])){
					$this->messages->addMessage('Invalid password');
				}
				$this->redirect('files/password/'.$file->id_file.'/'.$file->name);
				exit();
			}
			$ref = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ''; 
			if($file->hotlink === 1 && !empty($ref) && strpos($ref,$this->config["blog"]['blog_siteurl'])===0 || strpos($ref,'http')!==0){
				header('HTTP/1.0 403 Forbidden');
				exit();
			}
			$file_url = 'app/'.$this->config["blog"]['blog_upload_folder'].'/'.$file->url;
			$file->touch(); // actualiza los tiempos de acceso
			$stat=stat($file_url);
			// Caching control
			$notModified = false;
			$time = $_SERVER['REQUEST_TIME'];
			$expires = $time + 3600;
			$etag = md5($stat[9]);
			if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])  || isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
				if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
					$ifModifiedSince = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']);
					$lastModified = strtotime($stat[9]);
					if ($lastModified <= $ifModifiedSince) {
						$notModified = true;
					}
				}else if ($etag == $_SERVER['HTTP_IF_NONE_MATCH']) {
					$notModified = true;
				}
			}
			header('ETag: '.$etag);
			header('Content-Type: '.$file->type);
			header("Cache-Control: public; max-age=3600", true);
			header("Expires: " . gmdate("D, d M Y H:i:s", $expires) . " GMT", true);
			header('Content-Length: '.$stat[7]);
			header('Last-Modified: '.$stat[9]);
			header('Content-Disposition: attachment;filename='.$file->name);
			if($notModified){
				header('HTTP/1.0 304 Not Modified', true);
				header('Content-Length: 0', true);
			}else{
				readfile($file_url);
			}
		}else{
			header('HTTP/1.0 404 Not Found');
		}
		header('Conection: close', true);
		exit();
	}
	
	public function add(){
		if ($_SERVER["REQUEST_METHOD"]=="POST" && !empty($_FILES['new_file']['type'])){
			$error = false;
			if(!empty($_POST['password'])){
				$url = md5(time());
			}else{
				$url = urlencode($_FILES['new_file']['name']);
			}
			$file = new file();
			$file->name = ($_FILES['new_file']['name']);
			$file->url = $url;
			$file->hotlink = (int)(isset($_POST['hotlinking']));
			$file->stats = (int)(isset($_POST['statistics']));
			$file->password = $_POST['password'];
			$file->type = $_FILES['new_file']['type'];
			if (!$error && $file->isDuplicated()) {
				$this->messages->addMessage("Duplicate file");
				$error = true;
			}
			if(!$error && move_uploaded_file($_FILES['new_file']['tmp_name'],'app/'.$this->config["blog"]['blog_upload_folder'].'/'.$_FILES['new_file']['name'])){
				$file->save();
				$this->messages->addMessage('Added');
			}else{
				//Error raro
			}
			
			
		}
		$this->redirect("files/index");
	}
	
	public function password($id=''){
		if(empty($id)) $this->redirect('index');
		$file = new file();
		$file->find($id);
		if($file->exists()){
			$this->view->setLayout("admin");
			$this->title_for_layout($this->l10n->__("Archivo protegido"));
			$this->view->name = $file->name;
			$this->view->file_id = $file->id_file;
			$this->render();
		}else{
			header('HTTP/1.0 404 Not Found', true);
			exit();
		}
	}
	
	public function change_password($id = null){
		if(!is_null($id) && isset($_POST['new_password'])){
			$file = new file();
			$file->find($id);
			$file->password = $_POST['new_password'];
			$file->save();
			$this->messages->addMessage($this->l10n->__("The password has been changed"));
			$this->redirect("files");
		}
	}
	
}
