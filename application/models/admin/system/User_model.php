<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';
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
        $data['primaryKey'] = 'us.' . $this->primaryKey;
        $data['columns'] = array(
            array(
                'db' => 'us.' . $this->primaryKey, 'dt' => 1, 'field' => $this->primaryKey,
                'formatter' => function ($d) use ($csrf_name, $csrf_hash) {
                    $data = [
                        'csrf_name' => $csrf_name,
                        'csrf_hash' => $csrf_hash,
                        'id' => $d
                    ];
                    return view('pages.admin.system.user.table_btn', $data);
                }
            ),
            array('db' => 'us.' . $this->primaryKey, 'dt' => 2, 'field' => $this->primaryKey),
            array('db' => 'us.name', 'dt' => 3, 'field' => 'name'),
            array('db' => 'us.username', 'dt' => 4, 'field' => 'username'),
            array('db' => 'us.email', 'dt' => 5, 'field' => 'email'),
            array('db' => 'pr.name AS privilege', 'dt' => 6, 'field' => 'privilege'),
            array(
                'db' => 'us.created_at', 'dt' => 7, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ),
            array(
                'db' => 'us.updated_at', 'dt' => 8, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ),
        );
        $data['joinQuery'] = 'FROM users AS us LEFT JOIN privileges AS pr ON pr.id = us.privilege_id';
        $data['where'] = 'us.' . $this->primaryKey . ' != \'' . $_SESSION['auth']['id'] . '\'';

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

/* End of file User_model.php */
