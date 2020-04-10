<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_auth(false, 'admin/auth');
    }

    public function properties()
    {
        $data = [
            'title' => 'dashboard',
            'subtitle' => 'control panel',
            'breadcrumbs' => [['' => 'dashboard']],
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        return $data;
    }

    public function index()
    {
        $data = $this->properties();
        $this->output->set_output(view('pages.admin.dashboard.index', $data));
    }
}

/* End of file Dashboard.php */
