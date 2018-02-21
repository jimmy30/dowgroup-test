<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageUploader extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
         * 
         * 
	 */
    
        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->library('session');
                $this->load->library('image_lib');
        }
	public function index()
	{
            
		$this->load->view('index',["msg"=>'']);
	}
        public function upload_image()
        {
            // can manage thumb and water mark option from image config file
            $this->do_upload($this->config->item('create_thump'), $this->config->item('create_watermark'));
            redirect('/');
        }
        
        public function do_upload($is_tumb, $is_watermark)
        {
            
                $config['upload_path']          = $this->config->item('upload_path');
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = $this->config->item('max_size');
                $config['max_width']            = $this->config->item('max_width');
                $config['max_height']           = $this->config->item('max_height');
                $config['file_name'] = time().$_FILES["userfiles"]['name'];
                

                $this->load->library('upload', $config);


                if ( ! $this->upload->do_upload('userfile'))
                {

                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                }
                else
                {
                    $data = $this->upload->data();

                    if($data)
                    {
                        if($is_tumb)
                            $this->create_thumb($data["file_name"]);

                        if($is_watermark)
                            $this->create_watermark($data["file_name"]);

                        $this->session->set_flashdata('msg', 'Image has been uplaoded successfully!');

                    }
                    else
                    {
                        $this->session->set_flashdata('msg', 'Couldn\'t upload!');
                    }
                       
                }
        }
        
        public function create_thumb($filename)
        {
            $image_cfg['image_library'] = 'GD2';
            $image_cfg['source_image'] = $this->config->item('upload_path') . $filename;
            $image_cfg['create_thumb'] = TRUE;
            $image_cfg['maintain_ratio'] = TRUE;
            $image_cfg['width'] = $this->config->item('thumbail_size')["width"];
            $image_cfg['height'] = $this->config->item('thumbail_size')["height"];
            $image_cfg['quality']           = $this->config->item('image_quality');
            $this->image_lib->initialize($image_cfg);
            $this->image_lib->resize();
            $this->image_lib->clear();
        }
        public function create_watermark($filename)
        {
            $image_cfg = array();
            $image_cfg['image_library'] = 'GD2';
            $image_cfg['source_image'] = $this->config->item('upload_path') . $filename;
            $image_cfg['wm_overlay_path'] = 'uploads/watermark.png';
            $image_cfg['new_image'] = $this->config->item('upload_path').'mark_'.$filename;
            $image_cfg['wm_type'] = 'overlay';
            $image_cfg['wm_opacity'] = '10';
            $image_cfg['wm_vrt_alignment'] = 'middle';
            $image_cfg['wm_hor_alignment'] = 'center';
            $image_cfg['quality']           = $this->config->item('image_quality');
            $image_cfg['create_thumb'] = FALSE;

            $this->image_lib->initialize($image_cfg);
            $this->image_lib->watermark();
            $this->image_lib->clear();
        }
        
}
