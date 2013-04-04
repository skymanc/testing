<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Editor extends CI_Controller {
 
    public $data = array();

    public function Editor(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('user_model');
        $this->data = $this->user_model->checkLogged();
    }
 
   public function index(){
        $data = $this->user_model->checkLogged();
        if( $data['fbid'] == '' )
        {
            redirect('/');
        }
        else
        {
            $this->template->append_metadata("<link rel='stylesheet' href='../assets/css/editor_main.css'>");
            $this->template->append_metadata("<link rel='stylesheet' href='../assets/css/editor/editor_css.css'>");
            $this->template->append_metadata("<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>");
            $this->template->append_metadata("<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js'></script>");
            $this->template->append_metadata("<script src='../assets/js/editor/fb.0.9.15.min.js'></script>");
            $this->template->append_metadata("<script src='../assets/framework/colorbox/jquery.colorbox-min.js'></script>");
            $this->template->append_metadata("<link rel='stylesheet' href='../assets/framework/colorbox/colorbox.css'>");
            $this->template->append_metadata("<script src='../assets/js/editor/ready.js'></script>");
            $this->template->append_metadata("<script src='../assets/js/editor/function.js'></script>");
            $this->template->title('故事編輯器!!'); 
            $this->template->set_partial('header', 'header');
            $this->template->set_layout("temp")->build("editor",$this->data);
        }
        
    } 
}
 
?>