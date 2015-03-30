<?php

class Mail extends CI_Model {
	
    public function __construct() {
	parent::__construct();
    }
/**
 * Envoi un email utilisant les views dans mail_template
 * 
 * @param sting $mail
 * @param array $data
 * @param string $subject
 * @param sting $template
 */
    
    public function sendmail($mail,$data,$subject,$template){
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);       
        $this->email->from($this->config->item('email_from'), $this->config->item('email_from_name'));
        $this->email->to($mail);
        $this->email->subject($subject);    
        $message=$this->load->view('mail_template/'.$template, $data,TRUE);
        $this->email->message($message);          
        $this->email->send();  
   }
    
    
}



?>

