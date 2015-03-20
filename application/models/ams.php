<?php

class Ams extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

/**
 * Ressort la liste des services au seins du cri
 *
 * Ressort la liste des services au seins du cri
 *
 * @access	public
 * @return	string
 */        
        public function get_groupes() {
            $this->db->where_not_in('id_service', "100");
            $query = $this->db->get('groupes');
	    return $query;
        }
/**
 * Ressort la liste des roles
 *
 *
 * @access	public
 * @return	string
 */        
        public function get_roles() {
            $query = $this->db->get('role');
	    return $query;
        }        
/**
 * Affiche le nom du service dans la liste des serveurs
 *
 * Affiche le nom du service dans la liste des serveurs
 * Si $id_groupes ne renvoi rien le texte "le CRI" est retourné 
 *
 * @access	public
 * @param	integer
 * @return	integer
 */          
        public function get_groupe($id_groupes) {
            
            if($id_groupes) {
                $this->db->where('id_service',$id_groupes);
                $query=$this->db->get('groupes');
                $result = $query->result();
                $row = $result[0];
                return "le service ".$row->service;
            }
            else {
                return "le CRI ";
            }
        }        
}