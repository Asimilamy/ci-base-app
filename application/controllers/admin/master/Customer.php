<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_auth(false, 'admin/auth');
        $this->load->library(['custom_ssp', 'form_validation']);
        $this->load->model(['base_model', 'admin/master/customer_model']);
    }

    public function properties()
    {
        $data = [
            'title' => 'customer',
            'subtitle' => 'customer table',
            'breadcrumbs' => [['' => 'master'], ['' => 'customer']],
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        return $data;
    }

    public function index()
    {
        $data = $this->properties();
        $this->output->set_output(view('pages.admin.master.customer.table', $data));
    }

    public function datatables()
    {
        $data = $this->customer_model->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($this->input->get(), $data['dbConnection'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'])
        ));
    }

    public function form($id = null)
    {
        $row = $this->base_model->get_row('customers', ['id' => $id]);
        $data = array_merge($this->properties(), ['row' => $row]);
        $data['subtitle'] = 'customer form';
        $this->output->set_output(view('pages.admin.master.customer.form', $data));
    }

    public function detail($id)
    {
        if (!empty($id)) {
            $row = $this->base_model->get_row('customers', ['id' => $id]);
            $data = array_merge($this->properties(), ['row' => $row]);
            $data['subtitle'] = 'customer detail';
            $this->output->set_output(view('pages.admin.master.customer.detail', $data));
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
            $action = $this->base_model->submit('customers', $request);
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
            $request['is_active'] = 1;
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $this->form_rules($request);
            if ($this->form_validation->run() == false) {
                $form_warning = $this->base_model->form_warning($request);
                $response['message'] = implode('', $form_warning);
            } else {
                $submit = $this->base_model->submit('customers', $request);
                $submit_type = !empty($request['id']) ? 'update' : 'insert' ;
                if ($submit['status']) {
                    $response['status'] = true;
                    $response['message'] = 'Success ' . $submit_type . ' customer data!';
                    $response['redirect_to'] = base_url('admin/master/customer/detail/' . $submit['submit_id']);
                } else {
                    $response['message'] = 'Error ' . $submit_type . ' customer data!';
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
        $this->form_validation->set_rules('address', 'Address', 'required');
    }

    public function search()
    {
        $request = $this->input->get();
        $result = $this->base_model->get_all('customers', ['name LIKE' => '%' . $request['q'] . '%']);
        $response = [
            'items' => $result,
            'total_count' => count($result)
        ];
        $this->output->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }
}

/* End of file Customer.php */
