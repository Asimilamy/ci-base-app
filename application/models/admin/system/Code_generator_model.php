<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Code_generator_model extends CI_Model
{
    protected $table = 'code_generators';
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
        $data['columns'] = [
            [
                'db' => $this->primaryKey, 'dt' => 1, 'field' => $this->primaryKey,
                'formatter' => function ($d) use ($csrf_name, $csrf_hash) {
                    $data = [
                        'csrf_name' => $csrf_name,
                        'csrf_hash' => $csrf_hash,
                        'id' => $d
                    ];
                    return view('pages.admin.master.inventory.table_btn', $data);
                }
            ],
            ['db' => $this->primaryKey, 'dt' => 2, 'field' => $this->primaryKey],
            ['db' => 'name', 'dt' => 3, 'field' => 'name'],
            ['db' => 'at_table', 'dt' => 4, 'field' => 'at_table'],
            ['db' => 'at_column', 'dt' => 5, 'field' => 'at_column'],
            ['db' => 'format', 'dt' => 6, 'field' => 'format'],
            ['db' => 'on_reset', 'dt' => 7, 'field' => 'on_reset'],
            [
                'db' => 'created_at', 'dt' => 8, 'field' => 'created_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ],
            [
                'db' => 'updated_at', 'dt' => 9, 'field' => 'updated_at',
                'formatter' => function ($d) {
                    return date('d-m-Y H:i:s', strtotime($d));
                }
            ]
        ];
        $data['joinQuery'] = '';
        $data['where'] = '';

        return $data;
    }

    public function on_reset_options()
    {
        $opts = [
            0 => (object) ['key' => 'day', 'value' => 'Day'],
            1 => (object) ['key' => 'month', 'value' => 'Month'],
            2 => (object) ['key' => 'year', 'value' => 'Year'],
            3 => (object) ['key' => 'none', 'value' => 'None'],
        ];
        return $opts;
    }

    public function code_column(string $table)
    {
        if ($table == 'patients') {
            $column = 'patient_code';
        } elseif ($table == 'doctors') {
            $column = 'doctor_id';
        } elseif ($table == 'employees') {
            $column = 'employee_id';
        } elseif ($table == 'checkups') {
            $column = 'medical_record_id';
        } elseif ($table == 'supplier') {
            $column = 'supplier_code';
        } elseif ($table == 'purchase_return') {
            $column = 'no_retur';
        } elseif ($table == 'purchase') {
            $column = 'no_faktur';
        } elseif ($table == 'drug_purchase') {
            $column = 'no_faktur';
        } elseif ($table == 'sales_return') {
            $column = 'no_retur';
        }

        return $column;
    }

    public function code_parts()
    {
        $opts = [
            ['key' => 'yyyy', 'value' => 'Year (yyyy)'],
            ['key' => 'yy', 'value' => 'Year (yy)'],
            ['key' => 'mm', 'value' => 'Month (mm)'],
            ['key' => 'dd', 'value' => 'Day (dd)'],
            ['key' => 'yyyy_roman', 'value' => 'Year Roman (yyyy)'],
            ['key' => 'yy_roman', 'value' => 'Year Roman (yy)'],
            ['key' => 'mm_roman', 'value' => 'Month Roman (mm)'],
            ['key' => 'dd_roman', 'value' => 'Day Roman (dd)'],
            ['key' => 'increment', 'value' => 'Increment'],
            ['key' => 'alpha_numeric', 'value' => 'Alpha Numeric'],
        ];
        return $opts;
    }

    public function code_separators()
    {
        $opts = [
            ['key' => 'n', 'value' => 'None'],
            ['key' => '.', 'value' => 'Dot (.)'],
            ['key' => ',', 'value' => 'Comma (,)'],
            ['key' => '/', 'value' => 'Slash (/)'],
            ['key' => '\\', 'value' => 'Backslash (\)'],
            ['key' => '|', 'value' => 'Vertical Line (|)'],
            ['key' => '-', 'value' => 'Stripe (-)'],
            ['key' => '_', 'value' => 'Underscore (_)'],
            ['key' => '&nbsp;', 'value' => 'Space ( )'],
        ];
        return $opts;
    }

    public function form_rules()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('column', 'Column', 'required');
        $this->form_validation->set_rules('on_reset', 'On Reset', 'required');
    }

    public function process($request)
    {
        $response = [
            'id' => $request['id'],
            'name' => $request['name'],
            'at_table' => $request['at_table'],
            'at_column' => $request['at_column'],
            'on_reset' => $request['on_reset']
        ];

        return $response;
    }

    public function process_part($request)
    {
        $response = [
            'status' => false,
            'message' => 'Please add code part'
        ];
        if (isset($request['parts'])) {
            $data = [];
            $parts = json_decode($request['parts'], true);
            $format = '';
            $total = count($parts);
            $has_increment = false;
            foreach ($parts as $key => $part) {
                if (!$has_increment) {
                    $has_increment = $part['part'] == 'increment' ? true : $has_increment ;
                    $value = empty_string($part['value'], null);
                    if ($key + 1 < $total) {
                        $part['separator'] = $part['separator'] == 'n' ? '-' : $part['separator'] ;
                    } elseif ($key + 1 == $total) {
                        $part['separator'] = $part['separator'] != 'n' ? 'n' : $part['separator'] ;
                    }
                    $data[] = [
                        'code_generator_id' => $request['id'],
                        'order' => $key,
                        'part' => $part['part'],
                        'value' => $value,
                        'separator' => $part['separator'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $value = !empty($value) ? '[' . $value . ']' : $value ;
                    $separator = $part['separator'] === 'n' ? null : $part['separator'] ;
                    $format .= $part['part'] . $value . $separator;
                } else {
                    $response['message'] = 'Code part already has increment value';
                    return $response;
                    break;
                }
            }
            // Delete previous parts
            $this->db->delete('code_generator_parts', ['code_generator_id' => $request['id']]);
            $response['status'] = true;
            $response['data'] = $data;
            $response['format'] = $format;
        }

        return $response;
    }

    private function render_code_part(String $part, String $value)
    {
        $this->load->helper(['number']);

        if ($part == 'yyyy') {
            $code = date('Y');
        } elseif ($part == 'yy') {
            $code = date('y');
        } elseif ($part == 'mm') {
            $code = date('m');
        } elseif ($part == 'dd') {
            $code = date('d');
        } elseif ($part == 'yyyy_roman') {
            $code = number_to_roman(date('Y'));
        } elseif ($part == 'yy_roman') {
            $code = number_to_roman(date('y'));
        } elseif ($part == 'mm_roman') {
            $code = number_to_roman(date('m'));
        } elseif ($part == 'dd_roman') {
            $code = number_to_roman(date('d'));
        } elseif ($part == 'increment') {
            $code = $value;
        } elseif ($part == 'alpha_numeric') {
            $code = $value;
        }
        return $code;
    }

    public function generate_code(string $at_table)
    {
        $this->load->model(['base_model']);

        $code_format = '';
        $code_generator = $this->base_model->get_row('code_generators', ['at_table' => $at_table]);
        if (!empty($code_generator->id)) {
            $code_generator_parts = $this->base_model->get_all('code_generator_parts', ['code_generator_id' => $code_generator->id], ['order' => 'ASC']);

            $params = [];
            if ($code_generator->on_reset == 'day') {
                $params = ['DATE(created_at)' => date('Y-m-d')];
            } elseif ($code_generator->on_reset == 'month') {
                $params = ['MONTH(created_at)' => date('m'), 'YEAR(created_at)' => date('Y')];
            } elseif ($code_generator->on_reset == 'year') {
                $params = ['YEAR(created_at)' => date('Y')];
            }
            $data_row = $this->base_model->get_row($at_table, $params, ['created_at' => 'DESC', 'id' => 'DESC']);
            $last_data_code = $data_row->{$code_generator->at_column};

            $explode_glues = [];
            $increment = $this->base_model->get_row('code_generator_parts', ['code_generator_id' => $code_generator->id, 'part' => 'increment']);
            $increment_order = $increment->order;
            if (!empty($last_data_code)) {
                $query = $this->db->select('DISTINCT(`separator`)')
                    ->from('code_generator_parts')
                    ->where(['code_generator_id' => $code_generator->id])
                    ->get();
                $result = $query->result();
                foreach ($result as $row) {
                    $glue_code = str_replace($row->separator, '-', $last_data_code);
                    $last_data_code = $glue_code;
                }
                $explode_glues = explode('-', $last_data_code);
                if (!empty($increment_order)) {
                    $increment_length = strlen($explode_glues[$increment_order]);
                    $value = $explode_glues[$increment_order] + 1;
                    $value = str_pad($value, $increment_length, '000', STR_PAD_LEFT);
                    $explode_glues[$increment_order] = $value;
                }
            } else {
                if (!empty($increment_order)) {
                    $increment_length = strlen($increment->value);
                    $value = $increment->value;
                    $value = str_pad($value, $increment_length, '000', STR_PAD_LEFT);
                    $explode_glues[$increment_order] = $value;
                }
            }
            $no = 0;
            foreach ($code_generator_parts as $part) {
                $separator = $part->separator == 'n' ? '' : $part->separator;
                $value = $increment_order == $no && $part->part == 'increment' ? $explode_glues[$increment_order] : $part->value ;
                $code_format .= $this->render_code_part($part->part, empty_string($value, '')) . $separator;
                $no++;
            }
        }

        return $code_format;
    }
}
