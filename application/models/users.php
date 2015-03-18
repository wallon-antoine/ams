<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {
	
    public function __construct() {
	parent::__construct();
    }

    // Création de l'utilisateur dans la table users si il n'existe pas avec un rid = 2 (user)
    
    public function create($username = NULL, $email = NULL) {
        
        if($this->cas->is_authenticated() == true) {    
        
            if($username) {
                $user=$username;   
            }
            else {
                $user=$this->cas->user()->userlogin;
            }
            if($email) {
                $mail=$email;
            }
            else {
                $mail=$this->cas->user()->attributes['mail'];
            }
            $this->db->like('nom', $user);
            $this->db->from('users');
            $user_exist=$this->db->count_all_results();
        
            if($user_exist == 0) {
                $data = array(
                    'nom' => $user,
                    'mail' => $mail,
                    'rid' => '2',
                    'id_groupe' => '6'
                    
                );
                $this->db->insert('users', $data);
            }
        }
    
    }
/*
 * Récupère une information sur un utilisateur
 */    
    public function get_info() {
        $this->db->where('nom',$this->cas->user()->userlogin);
        $query=$this->db->get('users');
        $result = $query->result();
        $row = $result[0];
        return $row;
    }
    /*
     * Affiche la liste des utilisateurs par ordre croissant
     */
    public function liste() {
        $this->db->select('id, users.nom AS unom, role.nom AS rnom, mail, id_groupe');
        $this->db->join('role', 'role.idr = users.rid');
        $this->db->order_by("users.nom", "asc"); 
        $query=$this->db->get('users');

        return $query->result();
    }
    
    /*
     * ajoute l'utilisateur à un service 
     */
    public function update_user_id_groupes($id,$id_groupe) {

        $data = array(
	            'id_groupe' => $id_groupe
                );
	$this->db->where('id',$id);
        $this->db->update('users', $data);	
    }
    /*
     * ajoute l'utilisateur à un service 
     */
    public function update_user_id_role($id,$id_role) {

        $data = array(
	            'rid' => $id_role
                );
	$this->db->where('id',$id);
        $this->db->update('users', $data);	
    } 
}