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
 * Ajoute un groupe
 *
 * Ajoute un groupe
 *
 * @access	public
 */        
        public function add_groupes($name) {
            $this->db->where('service', $name);
            $this->db->from('groupes');
            $user_exist=$this->db->count_all_results();
        
            if($user_exist == 0) {
                $data = array(
                    'service' => $name
                    
                );
                $this->db->insert('groupes', $data);
            }
        }   
/**
 * Ajoute un groupe
 *
 * Ajoute un groupe
 *
 * @access	public
 */          
        
	public function delete_groupe($ids) {
            $this->db->delete('groupes', array('id_service' => $ids)); 
	} 
    /*
     * ajoute l'utilisateur à un service 
     */
    public function update_groupe($id,$service) {

        $data = array(
	            'service' => $service
                );
	$this->db->where('id_service',$id);
        $this->db->update('groupes', $data);	
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
/**
 * select count
 * @param sting $table
 * @param sting $column
 * @param string $search
 * @return int
 */        
        public function count($table,$column = NULL,$search =NULL) {
            if($column && $search) {
                $this->db->like($column, $search);
            }
            $this->db->from($table);
            return $this->db->count_all_results();            
        }
        
        public function count_nb_referent($name) {

            $this->db->like('referent', $name);
            $this->db->or_like('referent2', $name);
            $this->db->or_like('referent3', $name);
            $this->db->from('servers');
            return $this->db->count_all_results();            
        }          
}