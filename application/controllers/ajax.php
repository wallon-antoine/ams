<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('cas');
        $this->cas->force_auth();
        $this->Users->create();
    }
   
    public function configuser() {
            if($this->input->post()) {
                $this->Users->update_user_id_groupes($this->input->post('id'),$this->input->post('value'));
            }
    }
    public function configgroupe() {
            if($this->input->post()) {
                $this->Ams->update_groupe($this->input->post('id'),$this->input->post('value'));
            }
    }    
    public function configrole() {
            if($this->input->post()) {
                $this->Users->update_user_id_role($this->input->post('id'),$this->input->post('value'));
            }
    }

}