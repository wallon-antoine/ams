<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cas');
        $this->load->model('ams');
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
            $this->Mail->sendmail($this->config->item('email_admin'),array('user' => $this->cas->user()->userlogin,'url'=>current_url()),'Accès non autorisé','403');
            show_error("You have insufficient privileges to view this page",403);
        }        
    }
    public function groupes() {
        if(is_admin()  || is_role() == 4) {        
        $data['title'] = "Gestion des droits dans la base";
        $data['user'] = $this->cas->user()->userlogin;
        $data['users']= $this->Users->liste();
        $data['services']=$this->Ams->get_groupes();
        
        
	if($this->input->get('delete')) {
	       $this->ams->delete_groupe($this->input->get('delete'));
               redirect('config/groupes', 'refresh');
	}
        
        if($this->input->post('name')) {
            $this->ams->add_groupes($this->input->post("name"));
            redirect('config/groupes', 'refresh');
        }
        else {
            $this->load->view('themes/header', $data);
            $this->load->view('config/groupes',$data);
            $this->load->view('themes/footer');        
        }
        }
        else {
            $this->Mail->sendmail($this->config->item('email_admin'),array('user' => $this->cas->user()->userlogin,'url'=>current_url()),'Accès non autorisé','403');
            show_error("You have insufficient privileges to view this page",403);
        }          
    }    
   
}