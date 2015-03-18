<?php

class Ldap {

	public function __construct(){
		if (!function_exists('ldap_bind')){
			show_error('<strong>ERROR:</strong> You need to install the PHP module
				<strong><a href="http://php.net/ldap">ldap</a></strong> to be able
				to use ldap librarie.');
		}
                $CI =& get_instance();
		$this->CI = $CI;      

        }
        
        private function connect() {
      
            $connect = ldap_connect($this->CI->config->item('ldapuri'), $this->CI->config->item('ldapport'));
            
            ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);;
            ldap_bind($connect, $this->CI->config->item('binddn'), $this->CI->config->item('bindpw'));
            
            return $connect;
        }
        
        
        public function search_entry($filter,$type) {
            $justthese = array("sn", "givenname", "uid");
            $read = ldap_search($this->connect(), "ou=People,".$this->CI->config->item('basedn'), $type."=".$filter,$justthese);
            $info = ldap_get_entries($this->connect(), $read);
            if ($info != NULL) {
                return $info;
            }
            ldap_close($this->connect());
        }

        public function search($filter,$type) {

            //on découpe la chaine en fonction du séparateur
            $separateur = explode(" ", $filter);
            //on affiche tout les résultats
            foreach ($separateur AS $null => $person) {
                $person = trim($person);
                //$filter    = "$person*";
                $filter="(|(uid=*$person*))";
                $justthese = array("sn", "givenname", "uid");
                $sr        = ldap_search($this->connect(),"ou=People,".$this->CI->config->item('basedn'), $filter,$justthese);
                $info      = ldap_get_entries($this->connect(), $sr);
                $result = array();
                if ($info != NULL) {

                    for ($i = 0; $i < $info["count"]; $i++) {     
                        //array_push($result,$info[$i]['givenname'][0]." ".$info[$i]['sn'][0]);
                        array_push($result,$info[$i]['uid'][0]);
                        //array_push($result,);
                    }
                }
                else {
                   echo "La recherche l'a donnée aucun résultat";
                }
            }
            echo json_encode($result); 

            $entry = ldap_first_entry($this->connect(), $sr);
            $dn = ldap_get_dn($this->connect(), $entry);
            ldap_close($this->connect());            
        }
}