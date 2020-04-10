<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('base_model');
    }

    public function index()
    {
        check_auth(true, 'admin/dashboard');
        $this->login();
    }

    public function login()
    {
        check_auth(true, 'admin/dashboard');
        $data = [
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        $this->output->set_output(view('pages.admin.auth.login.form', $data));
    }

    public function do_login()
    {
        $response = [
            'status' => false,
            'message' => 'WHAT THE FUCK ARE YOU TRYING TO DO!!!'
        ];
        if ($this->input->method() == 'post') {
            $request = $this->input->post();
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $user = $this->base_model->get_row('users', ['username' => $request['username']]);
            if (!empty($user->id)) {
                if (password_verify($request['password'], $user->password)) {
                    $this->base_model->update_session($user);
                    $response['status'] = true;
                    $response['message'] = 'Welcome ' . $user->name . '!';
                } else {
                    $response['message'] = 'Password doesn\'t match username!';
                }
            } else {
                $response['message'] = 'Username doesn\'t exist!';
            }
        }
        return $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function logout()
    {
        session_destroy();
        redirect('admin/auth');
    }
}

/* End of file Auth.php */
