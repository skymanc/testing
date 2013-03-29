<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Editor extends CI_Controller {
 
    public $data = array();

    public function Editor(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->data = $this->user_model->checkLogged();
    }
 
   public function index(){

        $this->template->append_metadata("<link rel='stylesheet' href='../assets/css/editor_main.css'>");
        $this->template->append_metadata("<link rel='stylesheet' href='../assets/css/editor/editor_css.css'>");
        $this->template->append_metadata("<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>");
        $this->template->append_metadata("<script src='../assets/js/editor/fb.0.9.15.min.js'></script>");
        $this->template->title('故事編輯器!!'); 
        $this->template->set_partial('header', 'header');
        $this->template->set_layout("temp")->build("editor",$this->data);
    } 
}
 
?>