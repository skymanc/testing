<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class login extends CI_Controller {
 
    public function Login(){
        parent::__construct();
        $CI = & get_instance();
        $this->load->helper('url');
        $this->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
    }

    function index(){

        // Try to get the user's id on Facebook
        $userId = $this->facebook->getUser();
 
        // If user is not yet authenticated, the id will be zero
        if($userId == 0){
            // Generate a login url
            $data['url'] = $this->facebook->getLoginUrl(array(
                'scope' => 'email,offline_access,publish_stream,user_birthday,user_location,user_about_me,user_hometown',
                'redirect_uri' => 'http://app.mokafunpp.com/facebook-php-sdk-master/examples/example.php'
            ));
            $this->load->view('main_index', $data);

            //print_r($data);
        } else {
            // Get user's data and print it
            //$user = $this->facebook->api('/me');
            //print_r($user);
            $data['url'] = $this->facebook->getLogoutUrl();
            $this->load->view('main_index', $data);
        }
    }

    function checkUser()
    {
        print_r("testinmg");
        $userId = $this->facebook->getUser();
        print_r($userId);
        if( $userId == 0 )
        {

        }
        else
        {
            //check db if user exists?
            $user_profile = $facebook->api('/me');

            //$this->load->model('userModel');
            //$this->userModel->saveUser($data);
        }
    }
 
}
 
?>