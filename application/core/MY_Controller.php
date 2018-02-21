<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

   protected $_data = array();

	 function __construct()
   {
      parent::__construct();

      //$this->load->module('Login');
      $this->load->module('Errors');

       //$this->load->model("LoginModel");
       $uri_array = array("login","users","users/check_login","logout","api/");

       $api_uri_part =  substr(uri_string(),0,4); // extract first 4 characters for excluding api uri

       if(in_array(uri_string(),$uri_array) == FALSE && in_array($api_uri_part,$uri_array) == FALSE){
       	if(!$this->session->userdata('cms_user_id')){
        		redirect(base_url("users"));
        	}
        }
//       	else{

      		$this->load->module('Template');
      		$this->load->module('Admin');
//       	}
//       }

      if(!($this->session->userdata('language')))
      {
          $this->session->set_userdata('language','english');
      }

     if(!($this->session->userdata('db_language')))
      {
          $this->session->set_userdata('db_language','En');
      }
      
      //$this->session->set_userdata('db_language','Ar');

      $this->_data['user_language']  = $this->session->userdata('language');
      
      $this->_data['db_user_language']  = $this->session->userdata('db_language');
      
        $arrFilter = array();

        $arrFilter["period_today"] = 0;
        $arrFilter["period_last_week"] = 0;
        $arrFilter["period_30_days"] = 0;
        $arrFilter["period_range"] = 0;

        $arrFilter["idea_type"] = 1;
        $arrFilter["comment_type"] = 1;
        
        $this->_data['arrFilter']  = $arrFilter;
        
   }

}
