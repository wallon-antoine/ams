<?php

class Search_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }


/**
 * Recherche simple
 *
 * returne le résultat de la recherche simple en fonction du term
 *
 * @access	public
 * @param	string term
 * @return	string
 */         
    public function get_results($search_term) {
        $this->db->select('*');
        $this->db->from('servers');
        $this->db->like('nom',$search_term);
        $this->db->or_like('referent', $search_term);
        $this->db->or_like('ip', $search_term);
        $this->db->or_like('distrib', $search_term);
        $this->db->or_like('referent2', $search_term);
        $this->db->or_like('referent3', $search_term);
        $this->db->or_like('description', $search_term);
        $this->db->where('is_active', "1");

        $query = $this->db->get();

        return $query->result_array();   
    }
/**
 * Recherche Avancé
 *
 * returne le résultat de la recherche avancé
 *
 * @access	public
 * @param	string  nom
 * @param string $distrib Distribution du serveur
 * @param string $ip IP du serveur
 * @param string $referent Référent 1 2 ou 3 du serveur
 * @return	array
 */       
    
    public function advanced($nom,$distrib,$ip,$referent) {
        $this->db->select('*');
        $this->db->from('servers');
        if($nom) {
            $this->db->like('nom',$nom);
        }
        if($referent) {
            $this->db->or_like('referent', $referent);
            $this->db->or_like('referent2', $referent);
            $this->db->or_like('referent3', $referent); 
        }   
        if($ip) {
            $this->db->or_like('ip', $ip);
        }
        if($distrib) {
            $this->db->or_like('distrib', $distrib);
        }
        $this->db->where('is_active', "1");
        
        $query = $this->db->get();
        return $query->result_array();
    }    
/**
 * Export Recherche Avancé
 *
 * returne le résultat de la recherche avancé pour l'export
 *
 * @access	public
 * @param	string  nom
 * @param string $distrib Distribution du serveur
 * @param string $ip IP du serveur
 * @param string $referent Référent 1 2 ou 3 du serveur
 * @return	array
 */       
    
    public function advanced_export($nom,$distrib,$ip,$referent) {
        $this->db->select('*');
        $this->db->from('servers');
        if($nom) {
            $this->db->like('nom',$nom);
        }
        if($referent) {
            $this->db->or_like('referent', $referent);
            $this->db->or_like('referent2', $referent);
            $this->db->or_like('referent3', $referent); 
        }   
        if($ip) {
            $this->db->or_like('ip', $ip);
        }
        if($distrib) {
            $this->db->or_like('distrib', $distrib);
        }
        $this->db->where('is_active', "1");
        
        $query = $this->db->get();
        return $query;
    }     
                
        
}

