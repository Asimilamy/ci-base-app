<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_model extends CI_Model
{
    /**
     * Retrive all data from table
     * @param String $table
     * @param Array $params
     * @param Array $orders
     * @return Object $result
     */
    public function get_all($table, $params = [], $orders = [])
    {
        $this->db->from($table);
        if (count($params) > 0) :
            $this->db->where($params);
        endif;
        if (count($orders) > 0) :
            foreach ($orders as $col => $ordering) :
                $this->db->order_by($col, $ordering);
        endforeach;
        endif;
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /**
     * Retrive single row from table
     * @param String $table
     * @param Array $params
     * @param Array $orders
     * @return Object $row
     */
    public function get_row($table, $params, $orders = [])
    {
        $this->db->from($table)
            ->where($params);
        if (count($orders) > 0) {
            foreach ($orders as $column => $order) {
                $this->db->order_by($column, $order);
            }
        }
        $query = $this->db->get();
        $result = $query->row();
        $row = $this->render_table_column($query, $result);
        return $row;
    }

    /**
     * Render table column
     * so it won't show errors of undefined
     * @param String $query
     * @param Object $row
     * @return Object $result
     */
    public function render_table_column($query, $row = null)
    {
        foreach ($query->field_data() as $field) {
            if ($field->type == 'date') {
                $result[$field->name] = isset($row->{$field->name}) ? date('d-m-Y', strtotime($row->{$field->name})) : '' ;
            } elseif ($field->type == 'datetime' || $field->type == 'timestamp') {
                $result[$field->name] = isset($row->{$field->name}) ? date('d-m-Y H:i:s', strtotime($row->{$field->name})) : '' ;
            } else {
                $result[$field->name] = isset($row->{$field->name}) ? $row->{$field->name} : '' ;
            }
        }
        return (object) $result;
    }

    /**
     * Submit data to table
     * @param String $table
     * @param Array $request
     * @param String $primary_key
     * @param Bool $has_date
     * @return Array $result
     */
    public function submit($table, $request, $primary_key = 'id', $has_date = true)
    {
        $columns = $this->db->list_fields($table);
        foreach ($columns as $column) {
            if (isset($request[$column])) {
                if (!is_null($request[$column]) && $request[$column] != '') {
                    $data[$column] = $request[$column];
                } else {
                    $data[$column] = null;
                }
            }
        }
        if (empty($data[$primary_key])) {
            if ($has_date) {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
            }
            $result['status'] = $this->db->insert($table, $data);
            $result['submit_id'] = $this->db->insert_id();
        } else {
            if ($has_date) {
                $data['updated_at'] = date('Y-m-d H:i:s');
            }
            $result['status'] = $this->db->update($table, $data, [$primary_key => $request[$primary_key]]);
            $result['submit_id'] = $request[$primary_key];
        }
        return $result;
    }

    /**
     * Update session value
     * @param Mixed $data
     * @return Void
     */
    public function update_session($data)
    {
        foreach ($data as $key => $value) {
            $_SESSION['auth'][$key] = $value;
        }
    }

    /**
     * Render form validation warning
     * @param Mixed $request
     * @return Array $result
     */
    public function form_warning($request)
    {
        foreach ($request as $input => $value) {
            if ($input != 'submit_url' || $input != 'id') {
                $result[] = !empty(form_error($input)) ? form_error($input, '<li>', '</li>') : '';
            }
        }
        return $result;
    }

    /**
     * Get total data of table
     * @param String $table
     * @param Mixed $params
     * @return Int $result
     */
    public function count_data($table, $params = [])
    {
        $this->db->from($table)
            ->where($params);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }

    /**
     * Generate code for transaction
     * @param String $table
     * @param String $code
     * @param String $date
     * @return String $result
     */
    public function create_code($table, $code, $date)
    {
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $date_format = date('Y/m', strtotime($date));
        $count = $this->count_data($table, ['MONTH(created_at)' => $month, 'YEAR(created_at)' => $year]);
        $num = $count + 1;
        return $code . '/' . $date_format . '/' . $num;
    }
}

/* End of file Base_model.php */
