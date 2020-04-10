<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privilege extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_auth(false, 'admin/auth');
        $this->load->library(['custom_ssp', 'form_validation']);
        $this->load->model(['base_model', 'admin/system/privilege_model']);
    }

    public function properties()
    {
        $data = [
            'title' => 'privilege',
            'subtitle' => 'privilege table',
            'breadcrumbs' => [['' => 'system'], ['' => 'privilege']],
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        return $data;
    }

    public function index()
    {
        $data = $this->properties();
        $this->output->set_output(view('pages.admin.system.privilege.table', $data));
    }

    public function datatables()
    {
        $data = $this->privilege_model->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($this->input->get(), $data['dbConnection'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'])
        ));
    }

    public function form($id = null)
    {
        $row = $this->privilege_model->get_row($id);
        $data = array_merge($this->properties(), ['row' => $row]);
        $data['subtitle'] = 'privilege form';
        $this->output->set_output(view('pages.admin.system.privilege.form', $data));
    }

    public function detail($id)
    {
        if (!empty($id)) {
            $row = $this->privilege_model->get_row($id);
            $data = array_merge($this->properties(), ['row' => $row]);
            $data['subtitle'] = 'privilege detail';
            $this->output->set_output(view('pages.admin.system.privilege.detail', $data));
        }
    }

    public function menu($id)
    {
        if (!empty($id)) {
            $row = $this->base_model->get_row('privileges', ['id' => $id]);
            $menus = $this->base_model->get_all('menus', [], ['order' => 'asc']);
            $privilege_menus = $this->base_model->get_all('privilege_menus', ['privilege_id' => $id]);
            $privilege = [];
            foreach ($privilege_menus as $privilege_menu) {
                $privilege[$privilege_menu->menu_id] = [
                    'can_create' => $privilege_menu->can_create,
                    'can_read' => $privilege_menu->can_read,
                    'can_update' => $privilege_menu->can_update,
                    'can_delete' => $privilege_menu->can_delete,
                ];
            }
            $data = array_merge($this->properties(), ['row' => $row, 'menus' => $menus, 'privilege' => $privilege]);
            $data['subtitle'] = 'privilege menu';
            $this->output->set_output(view('pages.admin.system.privilege.menu', $data));
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
            $request['is_active'] = 0;
            $action = $this->base_model->submit('privileges', $request);
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
                $form_warning = $this->base_model->form_warning();
                $response['message'] = implode('', $form_warning);
            } else {
                $request = $this->privilege_model->create_request($request);
                $submit = $this->base_model->submit('privileges', $request);
                $submit_type = !empty($request['id']) ? 'update' : 'insert' ;
                if ($submit['status']) {
                    $response['status'] = true;
                    $response['message'] = 'Success ' . $submit_type . ' privilege data!';
                    $response['redirect_to'] = base_url('admin/system/privilege/detail/' . $submit['submit_id']);
                } else {
                    $response['message'] = 'Error ' . $submit_type . ' privilege data!';
                }
            }
        }
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function submit_menu()
    {
        $response = [
            'status' => false,
            'message' => 'WHAT THE FUCK ARE YOU DOING!!!'
        ];
        if ($this->input->method() == 'post') {
            $this->db->trans_begin();
            $request = $this->input->post();
            $privilege_id = $request['id'];
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $request = $this->privilege_model->create_menu_request($request);
            $delete = $this->db->delete('privilege_menus', ['privilege_id' => $privilege_id]);
            if ($delete) {
                $insert = $this->db->insert_batch('privilege_menus', $request);
                if ($insert) {
                    $this->db->trans_commit();
                    $response['status'] = true;
                    $response['message'] = 'Success updating privilege menu!';
                    $response['redirect_to'] = base_url('admin/system/privilege');
                } else {
                    $this->db->trans_rollback();
                    $response['message'] = 'Error when updating privilege menu!';
                }
            } else {
                $this->db->trans_rollback();
                $response['message'] = 'Failed to submit privilege menu data!';
            }
        }
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function form_rules()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
    }

    public function search()
    {
        $request = $this->input->get();
        $result = $this->privilege_model->search($request);
        $total_count = count($result);
        $response = [
            'items' => $result,
            'total_count' => $total_count
        ];
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }
}

/* End of file Privilege.php */
