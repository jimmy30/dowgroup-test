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
	 */
	public function index()
	{
            
            if($_POST)
            {
                print_r($_POST);
            exit;
                //$this->upload_model->do_upload(); //execute the upload function
                echo "sdfsdf";
                    exit;
                if(!empty($_FILES['userfile'])){
                    
                    
                //$this->do_thumb('file_name');
                //$this->watermark('file_name');
                    $filename = 'filename';

                
                        $image_cfg = array();
                        $image_cfg['image_library'] = 'GD2';
                        $image_cfg['source_image'] = 'upload/' . $filename;
                        $image_cfg['wm_overlay_path'] = 'upload/watermark.png';
                        $image_cfg['new_image'] = 'upload/mark_'.$filename;
                        $image_cfg['wm_type'] = 'overlay';
                        $image_cfg['wm_opacity'] = '10';
                        $image_cfg['wm_vrt_alignment'] = 'bottom';
                        $image_cfg['wm_hor_alignment'] = 'right';
                        $image_cfg['create_thumb'] = FALSE;

                        $this->image_lib->initialize($image_cfg);
                        $this->image_lib->watermark();
                        $this->image_lib->clear();

                //        echo $this->image_lib->display_errors();
                //        die();

                    

                        $image_cfg['image_library'] = 'GD2';
                        $image_cfg['source_image'] = 'upload/' . $filename;
                        $image_cfg['create_thumb'] = TRUE;
                        $image_cfg['maintain_ratio'] = TRUE;
                        $image_cfg['width'] = '200';
                        $image_cfg['height'] = '175';
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($image_cfg);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                }
            }    

		$this->load->view('index');
	}
        
        public function upload()
        {
            echo "sdfsdf";
            exit;
        }
        
}
