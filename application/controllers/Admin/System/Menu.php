<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_auth(false, 'admin/auth');
        $this->load->library(['custom_ssp', 'form_validation']);
        $this->load->model(['base_model', 'admin/system/menu_model']);
    }

    public function properties()
    {
        $data = [
            'title' => 'menu',
            'subtitle' => 'menu table',
            'breadcrumbs' => [['' => 'system'], ['' => 'menu']],
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        return $data;
    }

    public function index()
    {
        $data = $this->properties();
        $this->output->set_output(view('pages.admin.system.menu.table', $data));
    }

    public function datatables()
    {
        $data = $this->menu_model->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($this->input->get(), $data['dbConnection'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'])
        ));
    }

    public function form($id = null)
    {
        $row = $this->menu_model->get_row($id);
        $data = array_merge($this->properties(), ['row' => $row]);
        $data['subtitle'] = 'menu form';
        $this->output->set_output(view('pages.admin.system.menu.form', $data));
    }

    public function detail($id)
    {
        if (!empty($id)) {
            $row = $this->menu_model->get_row($id);
            $data = array_merge($this->properties(), ['row' => $row]);
            $data['subtitle'] = 'menu detail';
            $this->output->set_output(view('pages.admin.system.menu.detail', $data));
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
            $action = $this->base_model->submit('menus', $request);
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
                $request = $this->menu_model->create_request($request);
                $submit = $this->base_model->submit('menus', $request);
                $submit_type = !empty($request['id']) ? 'update' : 'insert' ;
                if ($submit['status']) {
                    $response['status'] = true;
                    $response['message'] = 'Success ' . $submit_type . ' menu data!';
                    $response['redirect_to'] = base_url('admin/system/menu/detail/' . $submit['submit_id']);
                } else {
                    $response['message'] = 'Error ' . $submit_type . ' menu data!';
                }
            }
        }
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function form_rules()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('order', 'Order', 'required');
    }

    public function search()
    {
        $request = $this->input->get();
        $params = [
            'name LIKE' => '%' . $request['q'] . '%',
            'is_active' => '1',
            'level !=' => '2'
        ];
        $result = $this->base_model->get_all('menus', $params);
        $total_count = count($result);
        $response = [
            'items' => $result,
            'total_count' => $total_count
        ];
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function get_user_menu()
    {
        $this->db->from('menus AS me')
            ->join('privilege_menus AS p_m', 'p_m.menu_id = me.id', 'left')
            ->select('me.*')
            ->where(['p_m.privilege_id' => $_SESSION['auth']['privilege_id']]);
        $query = $this->db->get();
        $result = $query->result();
        $sidebar = view('layouts.admin.db_sidebar', ['menus' => $result]);
        $response = [
            'sidebar' => $sidebar
        ];
        $this->output->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }
}

/* End of file Menu.php */
