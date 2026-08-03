<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpanel extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index($menu1='login',$menu2='')
	{
        $isAjax =false;
		$content="";
		$contentType="extjs";
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (strpos($contentType, 'application/json') !== false) {
            $isAjax =true;
        }
       
        $path='./src_cpanel/'. $menu1 . ($menu2 !=''  ? '/'. $menu2 : '').'/init.php';
        if(file_exists($path)){
            include $path;
			//$this->result->end();
			if($isAjax==true){
				$this->result->setData($content)->end();
			}else{
				$this->load->view('cpanel',array('content'=>$content,'contentType'=>$contentType));
			}
		    
        }else{
            show_404();
        }

        
	}
}
