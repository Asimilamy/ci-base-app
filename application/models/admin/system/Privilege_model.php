<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privilege_model extends CI_Model
{
    protected $table = 'privileges';
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
        $data['primaryKey'] = 'pr.' . $this->primaryKey;
        $data['columns'] = array(
            array(
                'db' => 'pr.' . $this->primaryKey, 'dt' => 1, 'field' => $this->primaryKey,
                'formatter' => function ($d) use ($csrf_name, $csrf_hash) {
                    $data = [
                        'csrf_name' => $csrf_name,
                        'csrf_hash' => $csrf_hash,
                        'id' => $d
                    ];
                    return view('pages.admin.system.privilege.table_btn', $data);
                }
            ),
            array('db' => 'pr.' . $this->primaryKey, 'dt' => 2, 'field' => $this->primaryKey),
            array('db' => 'p_pr.name AS parent_name', 'dt' => 3, 'field' => 'parent_name',
                'formatter' => function ($d) {
                    return !empty($d) ? $d : '-' ;
                }),
            array('db' => 'pr.name', 'dt' => 4, 'field' => 'name'),
            array('db' => 'pr.is_active', 'dt' => 5, 'field' => 'is_active',
                'formatter' => function ($d) {
                    return $d == '1' ? 'Active' : 'Unactive' ;
                }),
            array('db' => 'pr.notes', 'dt' => 6, 'field' => 'notes',
                'formatter' => function ($d) {
                    return empty($d) ? '-' : $d ;
                }),
            array(
                'db' => 'pr.created_at', 'dt' => 7, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ),
            array(
                'db' => 'pr.updated_at', 'dt' => 8, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    return !empty($d) ? date('d-m-Y H:i:s', strtotime($d)) : '-' ;
                }
            ),
        );
        $data['joinQuery'] = 'FROM ' . $this->table . ' AS pr LEFT JOIN privileges AS p_pr ON p_pr.id = pr.parent_id';
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
        $this->db->from($this->table . ' AS pr')
            ->join('privileges AS p_pr', 'p_pr.id = pr.parent_id', 'left')
            ->select('pr.*, p_pr.name AS parent_name, p_pr.level AS parent_level')
            ->where(['pr.id' => $id]);
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
        $request['level'] = !empty($request['parent_level']) ? $request['parent_level'] + 1 : 0 ;
        $request['is_active'] = !isset($request['is_active']) ? '0' : $request['is_active'] ;
        return $request;
    }

    /**
     * Build query to search resource
     * @param Array $request
     * @return Object $result
     */
    public function search($request)
    {
        $this->db->from($this->table)
            ->where('name LIKE', '%' . $request['q'] . '%')
            ->where('is_active', '1');
        if (!empty($request['id'])) {
            $this->db->where('id !=', $request['id'])
                ->group_start()
                    ->where('`parent_id` IS', 'NULL', false)
                    ->or_where('parent_id !=', $request['id'])
                ->group_end();
        }
        if (isset($request['level']) && $request['level'] != '') {
            $this->db->where('level <=', $request['level']);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /**
     * Create request to submit menu data
     * @param Array $request
     * @return Array $response
     */
    public function create_menu_request($request)
    {
        $response = [];
        $accesses = ['can_create', 'can_read', 'can_update', 'can_delete'];
        $total_menu = count($request['menu_id']);
        for ($i = 0; $i < $total_menu; $i++) {
            $menu_id = $request['menu_id'][$i];
            foreach ($accesses as $access) {
                if (!isset($response[$menu_id])) {
                    $response[$menu_id] = [
                        'privilege_id' => $request['id'],
                        'menu_id' => $menu_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        $access => 0
                    ];
                } else {
                    $response[$menu_id] = array_merge($response[$menu_id], [$access => 0]);
                }
                if (isset($request[$access][$menu_id])) {
                    $response[$menu_id][$access] = 1;
                    if (is_array($request[$access][$menu_id])) {
                        foreach ($request[$access][$menu_id] as $parent_id => $grandparent_id) {
                            $response[$parent_id][$access] = 0;
                            if (isset($request[$access][$menu_id][$parent_id])) {
                                $response[$parent_id][$access] = 1;
                                if (is_array($request[$access][$menu_id][$parent_id])) {
                                    foreach ($request[$access][$menu_id][$parent_id] as $grandparent_id => $value) {
                                        $response[$grandparent_id][$access] = isset($request[$access][$menu_id][$parent_id][$grandparent_id]) ? 1 : 0 ;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $response;
    }
}

/* End of file Privilege_model.php */
