<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';

    /**
     * Render datatables
     * @return Array $response
     */
    public function ssp_table()
    {
        $this->load->helper('basic');
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();

        $data['dbConnection'] = db_connect();
        $data['table'] = $this->table;
        $data['primaryKey'] = $this->primaryKey;
        $data['columns'] = array(
            array(
                'db' => $this->primaryKey, 'dt' => 1, 'field' => $this->primaryKey,
                'formatter' => function ($d) use ($csrf_name, $csrf_hash) {
                    $data = [
                        'csrf_name' => $csrf_name,
                        'csrf_hash' => $csrf_hash,
                        'id' => $d
                    ];
                    return view('pages.admin.master.customer.table_btn', $data);
                }
            ),
            array('db' => $this->primaryKey, 'dt' => 2, 'field' => $this->primaryKey),
            array('db' => 'name', 'dt' => 3, 'field' => 'name'),
            array('db' => 'address', 'dt' => 4, 'field' => 'address'),
            array(
                'db' => 'created_at', 'dt' => 5, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ),
            array(
                'db' => 'updated_at', 'dt' => 6, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ),
        );
        $data['joinQuery'] = '';
        $data['where'] = 'is_active = \'1\'';

        return $data;
    }

    /**
     * Get resource for joined table
     * @param String $id
     * @return Object $result
     */
    public function get_row($id = null)
    {
        $this->load->model('base_model');
        $this->db->from($this->table . ' AS us')
            ->join('privileges AS pr', 'pr.id = us.privilege_id', 'left')
            ->select('us.*, pr.name AS privilege')
            ->where(['us.id' => $id]);
        $query = $this->db->get();
        $row = $query->row();
        $result = $this->base_model->render_table_column($query, $row);
        return $result;
    }

    /**
     * Create request to submit data
     * @param Array $request
     * @return Array $response
     */
    public function create_request($request)
    {
        if (!empty($request['password'])) {
            $request['password'] = password_hash($request['password'], PASSWORD_BCRYPT);
        } else {
            unset($request['password']);
        }
        return $request;
    }
}

/* End of file Customer_model.php */
