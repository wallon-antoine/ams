<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Return user is admin
 *
 * Return user iif is admin (rid =1)
 *
 * @access	public
 * @param	string
 * @return	string
 */

function is_admin() {
    $CI =& get_instance();
    return $CI->cas->is_admin();
}

/**
 * Return user role
 *
 * Return user role
 *
 * @access	public
 * @param	string
 * @return	integer
 */

function is_role() {
    $CI =& get_instance();
    return $CI->Users->get_info()->rid;
    
}

/**
 * Return user group
 *
 * Return user group
 *
 * @access	public
 * @param	string
 * @return	integer
 */

function is_groupe() {
    $CI =& get_instance();
    return $CI->cas->is_groupe();
}