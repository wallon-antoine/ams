<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
                $this->load->model('Servers');
	        $this->load->library('cas');
		$this->cas->force_auth();
		$this->Users->create();
		$head['user'] = $this->cas->user()->userlogin;
                $data['last_servers']= $this->Servers->last_servers();
                $data['nbserver']=$this->Ams->count('servers');
                $data['nbserver_service']=$this->Ams->count('servers','groupe',is_groupe());
                $data['nbserver_referent']=$this->Ams->count_nb_referent($this->cas->user()->userlogin);
		$head['title'] = "Bienvenue"; 
		$this->load->view('themes/header', $head);
		$this->load->view('accueil',$data);
		$this->load->view('themes/footer');	

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */