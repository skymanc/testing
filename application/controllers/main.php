<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
    public function Main(){
        parent::__construct();
        $CI = & get_instance();
        $this->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
        $this->load->library('session');
    }
 
    function index(){

        $this->load->model('user_model');
        $data = $this->user_model->checkLogged();

        //print_r($data);
        $this->load->view("main_index",$data);

        
    }
 
}
 
?>