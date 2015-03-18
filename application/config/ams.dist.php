<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Configuration du CAS
 */

$config['cas_server_url'] = 'https://sso-cas.univ.fr/';
$config['phpcas_path'] = '/var/www/html/ams/plugins/CAS-1.3.3';
$config['cas_disable_server_validation'] = TRUE;
// $config['cas_debug'] = TRUE; // <--  use this to enable phpCAS debug mode

//Config LDAP
$config['ldapuri']= "ldap.univ.fr";
$config['ldapport'] = "389";
$config['basedn']= "dc=univ,dc=fr";
$config['binddn']= "uid=admin,ou=admins,dc=univ,dc=fr";
$config['bindpw']= "Passw0rd";


/*
 * Do not edit this line
 */

$config['version_ams']="0.1 beta";
