<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Story_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    
    //Mix Edit User Upload self-element
    public function save_story( $data = array() ) {

        $this->db->insert('story', $data);
		return $this->db->insert_id();
    }
    public function save_storyPage( $data = array() )
    {
        $this->db->insert('storypage', $data);
        return $this->db->insert_id();
    }
	
    public function upload_storypage( $imgData , $user_id )
    {
        $fileName = $user_id."_".uniqid().".png";
        $uploadPath = $this->config->item('upload_path');
        $success = file_put_contents( $uploadPath.'story_page/'.$fileName,$imgData);
        return $fileName;
    }
}