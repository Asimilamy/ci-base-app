<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Get CI DB connection setting
 * @return Array $connection
 */
function db_connect()
{
    $CI =& get_instance();
    $connection = [
        'user' => $CI->db->username,
        'pass' => $CI->db->password,
        'db'   => $CI->db->database,
        'host' => $CI->db->hostname
    ];
    return $connection;
}

function empty_string($str = '', $replacement = '-')
{
    $string = empty($str) ? $replacement : $str ;
    return $string;
}

/* End of file basic_helper.php */
