<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jsons extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('cas');
        $this->cas->force_auth();
        $this->Users->create();
    }
   
    public function distributionlist() {
        header("Content-Type: application/json");  
        $this->db->select('distrib');
        $this->db->like('distrib',$this->input->get('term'));
        $this->db->distinct();
	$query = $this->db->get('servers');
	if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
		$row_set[] = htmlentities(stripslashes($row['distrib'])); //build an array
            }
            echo json_encode($row_set); //format the array into json data
	}
    }
//    public function referentlist() {
//        header("Content-Type: application/json");  
//        $this->db->select('nom');
//        $this->db->like('nom',$this->input->get('term'));
//        $this->db->distinct();
//	$query = $this->db->get('users');
//	if($query->num_rows > 0){
//            foreach ($query->result_array() as $row){
//		$row_set[] = htmlentities(stripslashes($row['nom'])); //build an array
//            }
//            echo json_encode($row_set); //format the array into json data
//	}
//    }
      
    public function referentlist() {
       header("Content-Type: application/json");  
        $rows=$this->ldap->search($this->input->get('term'),'uid');
            echo $rows; //format the array into json data
	
    }    
    public function servernamelist() {
        header("Content-Type: application/json");  
        $this->db->select('nom');
        $this->db->like('nom',$this->input->get('term'));
        $this->db->distinct();
	$query = $this->db->get('servers');
	if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
		$row_set[] = htmlentities(stripslashes($row['nom'])); 
            }
            echo json_encode($row_set); //format the array into json data
	}
    }     
}