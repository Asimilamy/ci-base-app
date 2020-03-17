<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Check if user is authenticated
 * @param Bool $has_auth
 * @param String $redirect_url
 */
function check_auth(Bool $has_auth = false, String $redirect_url = 'auth')
{
    $CI =& get_instance();
    $CI->load->helper('url');
    if ($has_auth) {
        if (isset($_SESSION['auth']['id']) && !empty($_SESSION['auth']['id'])) {
            redirect($redirect_url);
        }
    } else {
        if (!isset($_SESSION['auth']['id']) || empty($_SESSION['auth']['id'])) {
            redirect($redirect_url);
        }
    }
}


/* End of file auth_helper.php */
