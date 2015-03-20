<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cas');
        $this->cas->force_auth();
        $this->Users->create();
    }
    
    public function users() {
        if(is_admin() || is_role() == 4) {
            $data['title'] = "Gestion des droits utilisateurs";
            $data['user'] = $this->cas->user()->userlogin;
            $data['users']= $this->Users->liste();
            $data['services']=$this->Ams->get_groupes();
            $data['roles']=$this->Ams->get_roles();
            $this->load->view('themes/header', $data);
            $this->load->view('config/users',$data);
            $this->load->view('themes/footer');
        }
        else {
            show_error("You have insufficient privileges to view this page",403);
        }        
    }
    public function groupes() {
        if(is_admin()  || is_role() == 4) {        
        $data['title'] = "Gestion des droits dans la base";
        $data['user'] = $this->cas->user()->userlogin;
        $data['users']= $this->Users->liste();
        $data['services']=$this->Ams->get_groupes();
        $this->load->view('themes/header', $data);
	$this->load->view('config/groupes',$data);
	$this->load->view('themes/footer');
        }
        else {
            show_error("You have insufficient privileges to view this page",403);
        }          
    }    
   
}