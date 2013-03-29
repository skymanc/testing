<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
    public function Main(){
        parent::__construct();
        $this->load->library('session');
    }
 
    function index(){

        $this->load->model('user_model');
        $data = $this->user_model->checkLogged();

        //print_r($data);
        $this->load->view("main_index",$data);

        
    }

    function test()
    {
        $this->load->model('user_model');
        $data = $this->user_model->checkLogged();
        $this->template->title('我的天啊!!'); 
        $this->template->append_metadata("<link rel='stylesheet' href='../assets/css/main.css'>");
        $this->template->append_metadata("<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>");
        $this->template->append_metadata("<script src='../assets/framework/fileUpload/ajaxfileupload.js'></script>");
        $this->template->append_metadata("<script src='../assets/js/upload.js'></script>");
        $this->template->set_partial('header', 'header');
        $this->template->set_layout("temp")->build("main_index2",$data);
    }
 
}
 
?>