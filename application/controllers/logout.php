<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    
   public function __construct() {
      parent::__construct();
      $this->load->library('cas');
      $this->cas->force_auth();
      $this->Users->create();
   }
   
   public function index() {
       
       phpCAS::logoutWithRedirectService(site_url());
       
   }
    
    
}
