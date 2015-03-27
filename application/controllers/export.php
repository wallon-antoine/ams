<?php

class Export extends CI_Controller
{

    public function __construct() {
    
        parent::__construct();
        $this->load->library('cas');
        $this->cas->force_auth();
        $this->Users->create();        
        $this->load->helper('url');
	$this->load->model('Servers'); 
        $this->load->model('Search_model'); 
        $this->load->dbutil();
    }

    public function csv($id_groupes = NULL){

        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="ams_'.date('dMy').'.csv"');
        
	if(is_role() == 1 || is_role() == 4) {

            if ($this->input->get('nom') == FALSE && $this->input->get('distrib') == FALSE && $this->input->get('ip') == FALSE) {
                $query=$this->Servers->get_servers($id_groupes);
            }
            else {
                $query = $this->Search_model->advanced_export($this->input->get('nom'),$this->input->get('distrib'),$this->input->get('ip'),$this->input->get('referent'));
            }
            
            $delimiter = ",";
            $newline = "\r\n";
            echo $this->dbutil->csv_from_result($query, $delimiter, $newline); 
        }
            
    }
    public function xml($id_groupes = NULL) {
        header('Content-Type: application/xml');
        header('Content-Disposition: attachement; filename="ams_'.date('dMy').'.xml"');
	if($id_groupes == $this->Users->get_info()->id_groupe || is_admin()) {
            
            if ($this->input->get('nom') == "" && $this->input->get('distrib') == "" && $this->input->get('ip') == "") {
                $query=$this->Servers->get_servers($id_groupes);
                
            }
            else {
                
                $query = $this->Search_model->advanced_export($this->input->get('nom'),$this->input->get('distrib'),$this->input->get('ip'),$this->input->get('referent'));
                
            }
            
            $config = array (
                          'root'    => 'ams',
                          'element' => 'server',
                          'newline' => "\n",
                          'tab'    => "\t"
                        );
                        
            echo $this->dbutil->xml_from_result($query, $config); 
        }
    }
}

