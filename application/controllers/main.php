<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
    public function Main(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->helper('url');
    }
 
    function index(){
        //首頁
        $data = $this->user_model->checkLogged();
        $this->template->title('我的天啊!!'); 
        $this->template->append_metadata("<link rel='stylesheet' href='../assets/css/main.css'>");
        $this->template->append_metadata("<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>");
        $this->template->append_metadata("<script src='../assets/framework/fileUpload/ajaxfileupload.js'></script>");
        $this->template->append_metadata("<script src='../assets/js/upload.js'></script>");
        $this->template->set_partial('header', 'header');
        $this->template->set_layout("temp")->build("main_index2",$data);

        
    }

    function test()
    {
        $data = $this->user_model->checkLogged();
        $this->template->title('我的天啊!!'); 
        $this->template->append_metadata("<link rel='stylesheet' href='../assets/css/main.css'>");
        $this->template->append_metadata("<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>");
        $this->template->append_metadata("<script src='../assets/framework/fileUpload/ajaxfileupload.js'></script>");
        $this->template->append_metadata("<script src='../assets/js/upload.js'></script>");
        $this->template->set_partial('header', 'header');
        $this->template->set_layout("temp")->build("main_index2",$data);
    }
 
}
 
?>