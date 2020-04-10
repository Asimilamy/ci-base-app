<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_auth(false, 'admin/auth');
        $this->load->library(['custom_ssp', 'form_validation']);
        $this->load->model(['base_model', 'admin/system/user_model']);
    }

    public function properties()
    {
        $data = [
            'title' => 'user',
            'subtitle' => 'user table',
            'breadcrumbs' => [['' => 'system'], ['' => 'user']],
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        return $data;
    }

    public function index()
    {
        $data = $this->properties();
        $this->output->set_output(view('pages.admin.system.user.table', $data));
    }

    public function datatables()
    {
        $data = $this->user_model->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($this->input->get(), $data['dbConnection'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'])
        ));
    }

    public function form($id = null)
    {
        $row = $this->user_model->get_row($id);
        $data = array_merge($this->properties(), ['row' => $row]);
        $data['subtitle'] = 'user form';
        $this->output->set_output(view('pages.admin.system.user.form', $data));
    }

    public function detail($id)
    {
        if (!empty($id)) {
            $row = $this->user_model->get_row($id);
            $data = array_merge($this->properties(), ['row' => $row]);
            $data['subtitle'] = 'user detail';
            $this->output->set_output(view('pages.admin.system.user.detail', $data));
        }
    }

    public function delete()
    {
        $response = [
            'status' => false,
            'message' => 'WHAT THE FUCK ARE YOU DOING!!!'
        ];
        if ($this->input->method() == 'post') {
            $request = $this->input->post();
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $action = $this->db->delete('users', ['id' => $request['id']]);
            if ($action) {
                $response['status'] = true;
                $response['message'] = 'Successfully delete data!';
            } else {
                $response['message'] = 'Error on deleting data!';
            }
        }
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function submit()
    {
        $response = [
            'status' => false,
            'message' => 'WHAT THE FUCK ARE YOU DOING!!!'
        ];
        if ($this->input->method() == 'post') {
            $request = $this->input->post();
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $this->form_rules($request);
            if ($this->form_validation->run() == false) {
                $form_warning = $this->base_model->form_warning($request);
                $response['message'] = implode('', $form_warning);
            } else {
                $request = $this->user_model->create_request($request);
                $submit = $this->base_model->submit('users', $request);
                $submit_type = !empty($request['id']) ? 'update' : 'insert' ;
                if ($submit['status']) {
                    $response['status'] = true;
                    $response['message'] = 'Success ' . $submit_type . ' user data!';
                    $response['redirect_to'] = base_url('admin/system/user/detail/' . $submit['submit_id']);
                } else {
                    $response['message'] = 'Error ' . $submit_type . ' user data!';
                }
            }
        }
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function form_rules($request)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', ['required', 'callback_chk_username']);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('privilege_id', 'Privilege', 'required');
        if (empty($request['id']) || !empty($request['password'])) {
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
            $chk_user = $this->base_model->count_data('users', ['username' => $str, 'id !=' => $this->input->post('id')]);
            if ($chk_user > 0) {
                $this->form_validation->set_message('chk_username', '{field} already exist, pick anothoer {field}!');
                return false;
            } else {
                return true;
            }
        }
    }
}

/* End of file User.php */
