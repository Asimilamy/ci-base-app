<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Code_generator_model extends CI_Model
{
    protected $table = 'code_generators';
    protected $primaryKey = 'id';

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
            0 => (object) ['key' => 'yyyy', 'value' => 'Year (yyyy)'],
            1 => (object) ['key' => 'yy', 'value' => 'Year (yy)'],
            2 => (object) ['key' => 'mm', 'value' => 'Month (mm)'],
            4 => (object) ['key' => 'dd', 'value' => 'Day (dd)'],
            6 => (object) ['key' => 'yyyy_roman', 'value' => 'Year Roman (yyyy)'],
            7 => (object) ['key' => 'yy_roman', 'value' => 'Year Roman (yy)'],
            8 => (object) ['key' => 'mm_roman', 'value' => 'Month Roman (mm)'],
            10 => (object) ['key' => 'dd_roman', 'value' => 'Day Roman (dd)'],
            12 => (object) ['key' => 'increment', 'value' => 'Increment'],
            13 => (object) ['key' => 'alpha_numeric', 'value' => 'Alpha Numeric'],
        ];
        return $opts;
    }

    public function code_separators()
    {
        $opts = [
            0 => (object) ['key' => 'n', 'value' => 'None'],
            1 => (object) ['key' => '.', 'value' => 'Dot (.)'],
            2 => (object) ['key' => ',', 'value' => 'Comma (,)'],
            3 => (object) ['key' => '/', 'value' => 'Slash (/)'],
            4 => (object) ['key' => '\\', 'value' => 'Backslash (\)'],
            5 => (object) ['key' => '|', 'value' => 'Vertical Line (|)'],
            6 => (object) ['key' => '-', 'value' => 'Stripe (-)'],
            7 => (object) ['key' => '_', 'value' => 'Underscore (_)'],
            7 => (object) ['key' => '&nbsp;', 'value' => 'Space ( )'],
        ];
        return $opts;
    }

    public function form_rules()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('column', 'Column', 'required');
        $this->form_validation->set_rules('on_reset', 'On Reset', 'required');
    }

    public function create_request($request)
    {
        $this->load->model(['base_model']);
        $delete_child = $this->db->delete('code_generator_parts', ['code_generator_id' => $request['id']]);
        if ($delete_child) {
            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete_child));
            exit();
        }
        $code_column = $this->code_column($request['page']);

        $data = [
            'id' => $request['id'],
            'name' => $request['name'],
            'table' => $request['page'],
            'column' => $code_column,
            'code_reset' => $request['code_reset'],
        ];

        return $data;
    }

    public function post_child_data(array $post_data, string $master_key)
    {
        $code_format = '';
        $total = count($post_data['code_part']);

        for ($i = 0; $i < $total; $i++) {
            $code_unique = $post_data['code_part'][$i] == 'urutan_angka' || $post_data['code_part'][$i] == 'kode_huruf' ? $post_data['code_unique'][$i] : null;
            $format_unique = empty($code_unique) ? '' : '[' . $code_unique . ']';
            $code_separator = empty_string($post_data['code_separator'][$i], 'n');
            $format_separator = $code_separator == 'n' ? '' : $code_separator;
            $data[] = [
                'code_generator_id' => $master_key,
                'code_part_order' => $i,
                'code_part' => $post_data['code_part'][$i],
                'code_unique' => $code_unique,
                'code_separator' => $code_separator,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $code_format .= $post_data['code_part'][$i] . $format_unique . $format_separator;
        }

        return ['submit' => $data, 'code_format' => $code_format];
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

    public function generate_code(string $table)
    {
        $this->load->model(['base_model']);

        $code_format = '';
        $code_generator = $this->base_model->get_row('code_generators', ['table' => $table]);
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
            $data_row = $this->base_model->get_row($table, $params, ['created_at' => 'DESC', 'id' => 'DESC']);
            $last_data_code = $data_row->{$code_generator->column};

            $explode_glues = [];
            $increment = $this->base_model->get_row('code_generator_parts', ['code_generator_id' => $code_generator->id, 'part' => 'increment']);
            $increment_order = $increment->order;
            if (!empty($last_data_code)) {
                $query = $this->db->select('DISTINCT(separator)')
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
