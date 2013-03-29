<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 


class File_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $CI = & get_instance();
    }

    public function save_upload_img( $data )
    {  
        $this->db->insert('file', $data);
        $id = $this->db->insert_id();
        return $id;
    }
}

?>