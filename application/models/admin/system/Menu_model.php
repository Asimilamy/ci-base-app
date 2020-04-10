<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    protected $table = 'menus';
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
        $data['primaryKey'] = 'me.' . $this->primaryKey;
        $data['columns'] = array(
            array(
                'db' => 'me.' . $this->primaryKey, 'dt' => 1, 'field' => $this->primaryKey,
                'formatter' => function ($d) use ($csrf_name, $csrf_hash) {
                    $data = [
                        'csrf_name' => $csrf_name,
                        'csrf_hash' => $csrf_hash,
                        'id' => $d
                    ];
                    return view('pages.admin.system.menu.table_btn', $data);
                }
            ),
            array('db' => 'me.' . $this->primaryKey, 'dt' => 2, 'field' => $this->primaryKey),
            array('db' => 'p_me.name AS parent_name', 'dt' => 3, 'field' => 'parent_name',
                'formatter' => function ($d) {
                    return !empty($d) ? $d : '-' ;
                }),
            array('db' => 'me.name', 'dt' => 4, 'field' => 'name'),
            array('db' => 'me.title', 'dt' => 5, 'field' => 'title'),
            array('db' => 'me.level', 'dt' => 6, 'field' => 'level'),
            array('db' => 'me.order', 'dt' => 7, 'field' => 'order'),
            array('db' => 'me.module', 'dt' => 8, 'field' => 'module'),
            array('db' => 'me.is_active', 'dt' => 9, 'field' => 'is_active',
                'formatter' => function ($d) {
                    return $d == '1' ? 'Active' : 'Unactive' ;
                }),
            array('db' => 'me.is_global', 'dt' => 10, 'field' => 'is_global',
                'formatter' => function ($d) {
                    return $d == '1' ? 'Yes' : 'No' ;
                }),
            array(
                'db' => 'me.created_at', 'dt' => 11, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ),
            array(
                'db' => 'me.updated_at', 'dt' => 12, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    return !empty($d) ? date('d-m-Y H:i:s', strtotime($d)) : '-' ;
                }
            ),
        );
        $data['joinQuery'] = 'FROM ' . $this->table . ' AS me LEFT JOIN menus AS p_me ON p_me.id = me.parent_id';
        $data['where'] = '';

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
        $this->db->from($this->table . ' AS me')
            ->join('menus AS p_me', 'p_me.id = me.parent_id', 'left')
            ->select('me.*, p_me.name AS parent_name')
            ->where(['me.id' => $id]);
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
        $this->load->model('base_model');
        if (!empty($request['parent_id'])) {
            $parent = $this->base_model->get_row('menus', ['id' => $request['parent_id']]);
            $grandparent = $parent->parent_id;
            $request['level'] = !empty($grandparent) ? '2' : '1' ;
        } else {
            $request['level'] = '0';
        }
        $request['module'] = 'admin';
        $request['link'] = empty($request['link']) || $request['link'] == '#' ? 'javascript:void(0);' : $request['link'] ;
        $request['icon'] = empty($request['icon']) ? 'fa fa-circle-o' : $request['icon'] ;
        $request['is_global'] = !isset($request['is_global']) ? '0' : $request['is_global'] ;
        $request['is_active'] = !isset($request['is_active']) ? '0' : $request['is_active'] ;
        return $request;
    }
}

/* End of file Menu_model.php */
