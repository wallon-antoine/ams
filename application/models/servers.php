<?php

class Servers extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
/**
 * Récupère tout les infos des serveurs
 *
 * Récupère tout les infos des serveurs en fonction du groupe
 *
 * @access	public
 * @param interger $id_groupe Nom du groupe
 * @return	array
 */ 
	public function get_servers($id_groupe = NULL) {
		
		if(isset($id_groupe)) {
			$this->db->where('groupe', $id_groupe);
		}
		
		$query = $this->db->get('servers');
		return $query;
	}
      

/**
 * Ajoute un serveur dans la base
 *
 *
 * @access	public
 * @param string $nom du serveur
 * @param string $os Description
 * @return	array
 */ 	
	public function add_server($nom,$os,$distrib,$dependance,$ip,$ip2,$url,$description,$referent,$referent2,$referent3,$bdd,$type_machine,$id_groupes) {
		$data = array(
			'nom' => $nom,
                        'os' => $os,
			'distrib' => $distrib,
                        'dependance' => $dependance,
			'ip' => $ip,
                        'ip2' => $ip2,
			'url' => $url,
			'description' => $description,
			'referent' => $referent,
			'referent2' => $referent2,
			'referent3' => $referent3,
			'bdd' => $bdd,
			'type_machine' => $type_machine,
			'groupe' => $id_groupes,
			'ajoute_par' => $this->cas->user()->userlogin,
		);
			
	
		$this->db->set('timestamp', 'NOW()', FALSE);
		$this->db->insert('servers', $data);
	}
	// update d'un serveur dans la base
	
	public function edit_server($nom,$os,$distrib,$dependance,$ip,$ip2,$url,$description,$referent,$referent2,$referent3,$bdd,$type_machine,$id_groupes,$id) {
		$data = array(
			'nom' => $nom,
                        'os' => $os,
			'distrib' => $distrib,
                        'dependance' => $dependance,
			'ip' => $ip,
                        'ip2' => $ip2,
			'url' => $url,
			'description' => $description,
			'referent' => $referent,
			'referent2' => $referent2,
			'referent3' => $referent3,
			'bdd' => $bdd,
			'type_machine' => $type_machine,
			'groupe' => $id_groupes,
			'ajoute_par' => $this->cas->user()->userlogin,
		);
			
                $this->db->set('timestamp', 'NOW()', FALSE);
		$this->db->where('ids', $id);
		$this->db->update('servers', $data);
	}        
/*
 *	Récupère les information d'un serveur si l'id est renseigné
 */
	public function get_server($ids) {
            
            if($ids) {
                $this->db->where('ids',$ids);
                $query=$this->db->get('servers');
                $result = $query->result();
                $row = $result[0];
                return $row;
            }
            else {
                return false;
            }
        }
/*
 *	Supprime une entrée serveur dans la table servers
 */
	public function delete($ids) {
		$this->db->delete('servers', array('ids' => $ids)); 
	}
/*
 *	Récupère tout les infos des serveurs
 */

	public function last_servers() {
                $this->db->order_by("nom", "desc"); 
                $this->db->limit(5);
                $this->db->where("groupe",is_groupe());
                $query = $this->db->get('servers');
		return $query;
	}
        
        
        
}
