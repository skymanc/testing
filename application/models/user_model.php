<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 


class User_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $CI = & get_instance();
        $this->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
        $this->load->library('session');
    }

    function getUserById( $id )
    {
    	$this->db->where('user_id', $id);
    	$count = $this->db->count_all_results('mokafunp_db');
    	if( $count > 0 )
    	{
    		//已經註冊過
    	}
    	else
    	{
    		//新會元
    	}
    }

    function saveUser( $data )
    {
    	$this->db->where('fbid', $data['fbid']);
    	$count = $this->db->count_all_results('user');
    	if( $count < 1 )
    	{
    		$this->db->insert('user', $data); 
    		$id = $this->db->insert_id();
    	}
    	else
    	{
    		$this->updateLoginTime($data['fbid']);//更新登入時間
    	}
    	return  $data['fbid'];
    }

    function updateLoginTime( $fbid )
    {
    	$data = array(
    		'last_login' => date("Y-m-d H:i:s",time())
    	);
    	$this->db->where('fbid', $fbid );
		$this->db->update('user', $data); 
    }

    function checkLogged()//判斷是否登入狀態
    {
    	$userFbId = $this->session->userdata('fbid');
        $userId = $this->facebook->getUser();
        if( isset($userFbId) && strlen($userFbId) > 0  && $userId )
        {
            //登入中
            $data['username'] = $this->session->userdata('username');
            $data['email'] = $this->session->userdata('email');
            $data['fbid'] = $this->session->userdata('fbid');
            $data['image'] = $this->session->userdata('image');
            $data['url'] = '';
            
            return $data;
        }
        else
        {
	        // Generate a login url
            $data['username'] = '';
            $data['email'] = '';
            $data['fbid'] = '';
            $data['image'] = '';
	        $data['url'] = $this->facebook->getLoginUrl(array(
	            'scope' => 'email,offline_access,publish_stream,user_birthday,user_location,user_about_me,user_hometown',
	            'redirect_uri' => 'http://app.mokafunpp.com/login/checkUser'
	        ));
	        return $data;
        }
        
    }
}

?>