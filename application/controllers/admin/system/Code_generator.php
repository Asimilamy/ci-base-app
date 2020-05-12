<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Code_generator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_auth(false, 'admin/auth');
        $this->load->library(['custom_ssp', 'form_validation']);
        $this->load->model(['base_model', 'admin/system/code_generator_model']);
    }

    public function properties()
    {
        $data = [
            'title' => 'code_generator',
            'subtitle' => 'code generator table',
            'breadcrumbs' => [['' => 'system'], ['' => 'code_generator']],
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        return $data;
    }

    public function index()
    {
        $data = $this->properties();
        $this->output->set_output(view('pages.admin.system.code_generator.table', $data));
    }

    public function datatables()
    {
        $data = $this->code_generator_model->ssp_table();
        $this->output->set_output(json_encode(
            Custom_ssp::simple($this->input->get(), $data['dbConnection'], $data['table'], $data['primaryKey'], $data['columns'], $data['joinQuery'], $data['where'])
        ));
    }

    public function form($id = null)
    {
        $data = $this->properties();
        $data['subtitle'] = 'code generator form';
        $data['row'] = $this->base_model->get_row('code_generators', ['id' => $id]);
        $data['on_reset_options'] = $this->code_generator_model->on_reset_options();
        $data['code_parts'] = json_encode($this->base_model->get_all('code_generator_parts', ['code_generator_id' => $id]));
        $data['parts'] = json_encode($this->code_generator_model->code_parts());
        $data['separators'] = json_encode($this->code_generator_model->code_separators());
        $this->output->set_output(view('pages.admin.system.code_generator.form', $data));
    }

    public function detail($id)
    {
        $data = $this->properties();
        $data['subtitle'] = 'code generator detail';
        $data['row'] = $this->base_model->get_row('code_generators', ['id' => $id]);
        $data['code_sample'] = $this->code_generator_model->generate_code($data['row']->at_table);
        $view = view('pages.admin.system.code_generator.detail', $data);
        $this->output->set_output($view);
    }

    public function submit()
    {
        $response = [
            'status' => false,
            'message' => 'WHAT THE FUCK ARE YOU DOING!!!',
            'FormData' => $this->input->post(),
        ];
        if ($this->input->method() == 'post') {
            $request = $this->input->post();
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $this->form_rules();
            if ($this->form_validation->run() == false) {
                $form_warning = $this->base_model->form_warning($request);
                $response['message'] = implode('', $form_warning);
            } else {
                $this->db->trans_begin();
                $master = $this->code_generator_model->process($request);
                $submit = $this->base_model->submit('code_generators', $master);
                $submit_type = !empty($request['id']) ? 'update' : 'insert' ;
                if ($submit['status']) {
                    $request['id'] = $submit['submit_id'];
                    $detail = $this->code_generator_model->process_part($request);
                    if ($detail['status']) {
                        $action['batch'] = $this->db->insert_batch('code_generator_parts', $detail['data']);
                        $action['update'] = $this->base_model->submit('code_generators', ['id' => $request['id'], 'format' => $detail['format']]);
                        if ($action['batch'] && $action['update']['status']) {
                            $this->db->trans_commit();
                            $response['status'] = true;
                            $response['message'] = 'Success ' . $submit_type . ' code generator data!';
                            $response['redirect_to'] = base_url('admin/system/code_generator/detail/' . $submit['submit_id']);
                        } else {
                            $this->db->trans_rollback();
                            $response['message'] = 'Error ' . $submit_type . ' code generator parts!';
                        }
                    } else {
                        $this->db->trans_rollback();
                        $response = $detail;
                        $response['csrf_name'] = $this->security->get_csrf_token_name();
                        $response['csrf_hash'] = $this->security->get_csrf_hash();
                    }
                } else {
                    $this->db->trans_rollback();
                    $response['message'] = 'Error ' . $submit_type . ' code generator data!';
                }
            }
        }

        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function delete()
    {
        $response = [
            'status' => false,
            'message' => 'WHAT THE FUCK ARE YOU DOING!!!'
        ];
        if ($this->input->method() == 'post') {
            $this->db->trans_start();
            $request = $this->input->post();
            $response['csrf_name'] = $this->security->get_csrf_token_name();
            $response['csrf_hash'] = $this->security->get_csrf_hash();
            $action['master'] = $this->db->delete('code_generators', ['id' => $request['id']]);
            $action['detail'] = $this->db->delete('code_generator_parts', ['code_generator_id' => $request['id']]);
            if ($action) {
                $this->db->trans_commit();
                $response['status'] = true;
                $response['message'] = 'Successfully delete data!';
            } else {
                $this->db->trans_rollback();
                $response['message'] = 'Error on deleting data!';
            }
        }
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response));
    }

    public function form_rules()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('at_table', 'Table', 'required');
        $this->form_validation->set_rules('at_column', 'Column', 'required');
        $this->form_validation->set_rules('on_reset', 'On Reset', 'required');
    }
}
