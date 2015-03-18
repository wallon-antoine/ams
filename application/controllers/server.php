<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends CI_Controller {



   public function __construct() {
      parent::__construct();
      $this->load->library('cas');
      $this->cas->force_auth();
      $this->Users->create();
      $this->load->library('form_validation');  
      $this->load->helper(array('form', 'url'));
   }
   
   public function add() {
      if(is_admin()  || is_role() == 4) {
	  
	  
	    // Vérification du formulaire
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"> <a href="#" class="close" data-dismiss="alert">&times;</a>', '</div>');
	    $this->form_validation->set_rules('nom', 'Nom', 'trim|required|is_unique[servers.nom]');
	    $this->form_validation->set_rules('distrib', 'Distribution', 'trim|required');
	    $this->form_validation->set_rules('ip', 'IP', 'trim|required|valid_ip');
	    $this->form_validation->set_rules('description', 'Description', 'trim|required');
	    $this->form_validation->set_rules('referent', 'Referent', 'trim|required');
	    $this->form_validation->set_rules('type_machine', 'Type de Machine', 'trim|required');
	  
	  
	     // si pas submit
	 if ($this->form_validation->run() == FALSE) {
	     $data['title'] = "Ajout d'un server dans la base";
	     // liste les services du cri ex: gestion
	     $data['liste_service']= $this->Ams->get_groupes();
	     $data['user'] = $this->cas->user()->userlogin;  
	     $this->load->view('themes/header', $data);
	     $this->load->view('server/add',$data);
	     $this->load->view('themes/footer');
	 }
	 else {
	      $this->load->model('Servers');
	       // Ajout du serveur dans la base
	      $this->Servers->add_server(
					  $this->input->post('nom'),
                                          $this->input->post('os'),
					  $this->input->post('distrib'),
                                          $this->input->post('dependance'),
					  $this->input->post('ip'),
                                          $this->input->post('ip2'),
					  $this->input->post('url'),
					  nl2br($this->input->post('description')),
					  $this->input->post('referent'),
					  $this->input->post('referent2'),
					  $this->input->post('referent3'),
					  $this->input->post('bdd'),
					  $this->input->post('type_machine'),
					  $this->input->post('id_groupes')
	      );
            // Ajout des référents dans la table users  
            $referent=$this->ldap->search_entry($this->input->post('referent'),'uid');
            $this->Users->create($referent[0]['uid'][0],$referent[0]['mail'][0]);
            
            $referent2=$this->ldap->search_entry($this->input->post('referent2'),'uid');
            $this->Users->create($referent2[0]['uid'][0],$referent2[0]['mail'][0]);              

            $referent3=$this->ldap->search_entry($this->input->post('referent3'),'uid');
            $this->Users->create($referent3[0]['uid'][0],$referent3[0]['mail'][0]);     
              
	      $data['title'] = "ajout d'un server dans la base"; 
              $data['user'] = $this->cas->user()->userlogin;  
	      $this->load->view('themes/header', $data);
	      $this->load->view('server/addok');
	      $this->load->view('themes/footer');	 
	 }
      }
      else {
	 show_error("You have insufficient privileges to view this page",403);
      }
   }
   /*
    * affiche la liste des serveurs 
    */
   
    public function liste($id_groupes = NULL) {
	 
	 if($id_groupes == $this->Users->get_info()->id_groupe || is_admin() || is_role() == 3) {
	 
	    $this->load->model('Servers');
	    $data['status'] ="";
	    $data['liste_servers']= $this->Servers->get_servers($id_groupes);
	    $data['nom_service']= $this->Ams->get_groupe($id_groupes);
	    $data['title'] = "Liste des serveurs géré par ".$data['nom_service'];
            $data['id_service']=$id_groupes;
            $data['user'] = $this->cas->user()->userlogin;
            
	    if($this->input->get('delete')) {
	       $data['status'] = "Entrée supprimé";
	       $this->Servers->delete($this->input->get('delete'));
               redirect('/server/liste', 'refresh');
	    }
	    $data['user'] = $this->cas->user()->userlogin;
	    $this->load->view('themes/header', $data);
	    $this->load->view('server/liste', $data);
	    $this->load->view('themes/footer');
	 }
	 else {
	    show_error("You have insufficient privileges to view this page",403);
	 }    
      }

    public function edit($ids = NULL) {

        if(isset($ids)) {
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"> <a href="#" class="close" data-dismiss="alert">&times;</a>', '</div>');
	    $this->form_validation->set_rules('nom', 'Nom', 'trim|required');
	    $this->form_validation->set_rules('distrib', 'Distribution', 'trim|required');
	    $this->form_validation->set_rules('ip', 'IP', 'trim|required|valid_ip');
	    $this->form_validation->set_rules('description', 'Description', 'trim|required');
	    $this->form_validation->set_rules('referent', 'Referent', 'trim|required');
	    $this->form_validation->set_rules('type_machine', 'Type de Machine', 'trim|required');
            
            
            
            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->cas->user()->userlogin;
                $this->load->model('Servers');
                $this->load->model('Ams');
                $data['server']= $this->Servers->get_server($ids);
                $data['ids']= $ids;
                $data['liste_service']= $this->Ams->get_groupes();
                $data["groupes"] = $this->db->get('groupes')->result();
                $data['title'] = "Edition";
                /*
                 * envoi les variables $readonly et $disabled le propriétaire de la fiche n'est pas indiqué comme le référent ou qu'il n'est pas le super admin
                 */
                
                if($data['server']->referent !== $data['user'] && (is_role() == 2 || is_role() == 3) ) { 
                    $data['readonly']="readonly"; 
                    $data['disabled']="disabled";
                }
                else {
                    $data['readonly']="";
                    $data['disabled']="";
                }
                $this->load->view('themes/header', $data);
                $this->load->view('server/edit', $data);
                $this->load->view('themes/footer');
            }
            else {
                $this->load->model('Servers');
	       // Ajout du serveur dans la base
                $this->Servers->edit_server(
                                            $this->input->post('nom'),
                                            $this->input->post('os'),
                                            $this->input->post('distrib'),
                                            $this->input->post('dependance'),
                                            $this->input->post('ip'),
                                            $this->input->post('ip2'),
                                            $this->input->post('url'),
                                            nl2br($this->input->post('description')),
                                            $this->input->post('referent'),
                                            $this->input->post('referent2'),
                                            $this->input->post('referent3'),
                                            $this->input->post('bdd'),
                                            $this->input->post('type_machine'),
                                            $this->input->post('id_groupes'),
                                            $ids
                );
	      $data['title'] = "edition d'une fiche"; 
              $data['user'] = $this->cas->user()->userlogin;  
	      $this->load->view('themes/header', $data);
	      $this->load->view('server/addok');
	      $this->load->view('themes/footer');	                 
            }  
        }
        elseif(is_admin() == false) {
            show_error("You have insufficient privileges to view this page",403);
        }
	else {
	 show_404();
	}
   }   

   
}