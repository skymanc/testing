<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller {
 
    public function Login(){
        parent::__construct();
        $CI = & get_instance();
        $this->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
        $this->load->library('session');
        $this->load->helper('url');
    }

    function index(){

        // Try to get the user's id on Facebook
        //$userId = $this->facebook->getUser();
 
    }

    function checkUser()
    {
        $userId = $this->facebook->getUser();
        if( $userId == 0 )
        {
            return "error";
        }
        else
        {
            //check db if user exists?
            $this->load->model('User_model');
            $user_profile = $this->facebook->api('/me');
            $gender = 1;
            if( $user_profile['gender'] == "female" )
                $gender = 0;

            $birth = explode("/",$user_profile['birthday']);
            $birthday = $birth[2]."-".$birth[0]."-".$birth[1];
            $data = Array(
                'fbid' => $user_profile['id'],
                'username' => $user_profile['name'],
                'nickname'=> '',
                'birthday'=> $birthday,
                'gender' => $gender,
                'email' => $user_profile['email'],
                'locale'=> $user_profile['locale'],
                'last_login'=> date("Y-m-d H:i:s",time()),
                'add_time'=>  date("Y-m-d H:i:s",time()),
                'user_img' =>"https://graph.facebook.com/".$userId."/picture"
                );
            
            $fbid = $this->User_model->saveUser($data);
            $newdata = array(
                   'username'  => $user_profile['name'],
                   'email'     => $user_profile['email'],
                   'fbid'      => $user_profile['id'],
                   'image'      => "https://graph.facebook.com/".$userId."/picture",
                   'logged_in' => TRUE
               );
            $this->session->set_userdata($newdata);
            redirect('/');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('fbid');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('image');
        redirect('/');
    }
 
}
 
?>