<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_auth(false, 'admin/auth');
    }

    public function properties()
    {
        $data = [
            'title' => 'profile',
            'subtitle' => 'profile form',
            'breadcrumbs' => [['' => 'profile']],
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        return $data;
    }

    public function index()
    {
        $data = $this->properties();
        $this->output->set_output(view('pages.admin.profile.form', $data));
    }

    public function update()
    {
        $this->load->model('base_model');
        $this->load->library('form_validation');
        $response = [
            'status' => false,
            'message' => 'WHAT THE FUCK ARE YOU TRYING TO DO!!!'
        ];
        if ($this->input->method() == 'post') {
            $request = $this->input->post();
            $request['id'] = $_SESSION['auth']['id'];
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $this->form_rules($request);
            if ($this->form_validation->run() == false) {
                $form_warning = $this->base_model->form_warning($request);
                $response['message'] = implode('', $form_warning);
            } else {
                $submit = $this->base_model->submit('users', $request);
                if ($submit) {
                    $this->base_model->update_session($request);
                    $response['status'] = true;
                    $response['message'] = 'Success update profile!';
                } else {
                    $response['message'] = 'Error updating profile!';
                }
            }
        }
        return $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function form_rules($request)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', ['required', 'callback_chk_username']);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if (!empty($request['password'])) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confPassword', 'Confirm Password', 'required|matches[password]');
        }
    }

    public function chk_username(string $str)
    {
        $this->load->model(['base_model']);
        if ($str == 'test') {
            $this->form_validation->set_message('chk_username', 'The {field} field can\'t be the word \'test\'');
            return false;
        } else {
            $chk_user = $this->base_model->count_data('users', ['username' => $str, 'id !=' => $_SESSION['auth']['id']]);
            if ($chk_user > 0) {
                $this->form_validation->set_message('chk_username', '{field} already exist, pick anothoer {field}!');
                return false;
            } else {
                return true;
            }
        }
    }
}

/* End of file Profile.php */
