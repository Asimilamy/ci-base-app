<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Security extends CI_Security
{
    public function __construct()
    {
        parent::__construct();
    }

    public function csrf_show_error()
    {
        $response['status'] = true;
        $response['message'] = 'Your page will be reset, because your session has been expired!'."\n".'Please try again later!';
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
        } else {
            header('Location: ' . htmlspecialchars($_SERVER['REQUEST_URI']), true, 200);
        }
        exit(json_encode($response));
    }
}

/* End of file MY_Security.php */
