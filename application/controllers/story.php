<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Story extends CI_Controller {
 
    public function Story(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->helper('url');
    }
 
    function index(){
    }

    function save_story()
    {
        $title = $this->input->post('title',true);
        $desc = $this->input->post('desc',true);
        $pfb = $this->input->post('pfb',true);
        $user_id = $this->session->userdata('fbid');
        if( isset($user_id) )
        {
            //開始存入資料
            $data = array(
                'title'     => $title,
                'description'=> $desc,
                'display'      => 1,
                'user_id'  => $user_id
            );

            $this->load->model('story_model');
            $id = $this->story_model->save_story($data);
            echo $id;
        }
    }

    function save_storypage()
    {
        $this->load->model('story_model');

        $id = $this->input->post('id',true);
        $img = $this->input->post('img');
        $order = $this->input->post('order',true);
        $story_json = $this->input->post('story_json',true);
        //save image
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $imgData = base64_decode($img);
        //base64_decode(urldecode($img));
        $user_id = $this->session->userdata('fbid');
        $fileName = $this->story_model->upload_storypage($imgData,$user_id);

        $data = array(
                'story_id'      => $id,
                'story_json'    => $story_json,
                'image_name'    => $fileName,
                'order'         => $order,
                'update_time'   => date("Y-m-d H:i:s",time())
            );
        $id = $this->story_model->save_storyPage($data);
        echo $id;
    }
}
 
?>