<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class File extends CI_Controller
{
    private $upload_config = array(
        //上傳路徑(※最後需要有斜線)
        'upload_path' => './uploads/',
        //合法的檔案類型
        'allowed_types' => 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG',
        //限定檔案大小，0=不限定
        'max_size' => '2048KB',
        //限定寬度(圖片時)，0=不限定
        'max_width' => '0',
        //限定高度(圖片時)，0=不限定
        'max_height' => '0',
        //限定檔名長度，0=不限定
        'max_filename' => '0',
        //重新亂數命名
        //'encrypt_name' => TRUE,
        //移除檔名中的空白
        'remove_spaces' => TRUE,
    );

    public function File()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function upload_img( $field_name = 'upload1' )
    {
        $type = $this->input->post('type');
        $user_id = $this->session->userdata('fbid');
        $error = "";
        $msg = "";
        $fileElementName = 'upload1';    
    
        $upload = $this->upload_config;
        //都先上傳到temp中
        $id = uniqid();
        $upload["file_name"] = $id ;//$_FILES[$fileElementName]['name'];//$this->redisdb->getImageID();
        $upload["upload_path"] = "{$this->upload_config["upload_path"]}temp";
        $this->load->library('upload', $upload);
        

        $data = array();
        if (!$this->upload->do_upload($fileElementName))
        {
            //儲入執行結果與錯誤訊息
            $data['result'] = FALSE;
            $data['error_message'] = $this->upload->display_errors();
            $data['upload_data'] = array();
        }
        else
        {
            //上傳成功
            $data['upload_data'] = $this->upload->data();
            //儲入執行結果與成功的檔案資訊
            $data['result'] = TRUE;
            $data['error_message'] = NULL;
            
            $data['upload_data']['cover_path'] = $data['upload_data']['raw_name'];
            //$id = $this->awslib->upload_file(NULL,'temp/' . $data['upload_data']['file_name'],'element');
            $data['upload_data']['file_name']=$id;

            $fileData = array(
                'file_name'     => $data['upload_data']['file_name'],
                'file_full_name'=> $data['upload_data']['file_name'].$data['upload_data']['file_ext'],
                'file_ext'      => $data['upload_data']['file_ext'],
                'file_user_id'  => $user_id,
                'display'       => 1
            );
            $this->load->model('file_model');
            $dbid = $this->file_model->save_upload_img($fileData);
            $data['upload_data']['file_id']=$dbid;
            //寫一筆資料到files，display = no
        }
        //echo json_encode($data);
        print_r($data);
    }
 
}
 
?>