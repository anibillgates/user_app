<?php namespace App\Models;
use CodeIgniter\Model;

class Homemodel  extends Model
{
    //protected $table = 'employee_personal';
    //protected $allowedFields = ['employee_id','emp_pass','emp_name','emp_dept'];

    function fetchData($table_name,$where_condition)
    {
        return $this->db->table($table_name)->select('*')->where($where_condition)->get()->getrow();
    }

    function fetchData_all($table_name,$where_condition)
    {
        return $this->db->table($table_name)->select('*')->where($where_condition)->get()->getResult();
        // $this->db->last_query();
    }


    function InsertData($table_name,$table_fields)
    {
        $this->db->table($table_name)->insert($table_fields);
        return $this->db->insertID();
    }
    

    function UpdateData($fields, $table_name, $where_condition)
    {
        return $this->db->table($table_name)->where($where_condition)->set($fields)->update();
    }
    function getAllData($table_name,$where_condition)
    {
        return $this->db->table($table_name)->select('*')->where($where_condition)->get()->getrow();
    }

    function fetch_all_data($table_name, $where_condition)
    {
        return $this->db->table($table_name)->select('*')->where($where_condition)->get()->getResult();
    }

    function fetch_all_data_interest($table_name, $where_condition, $orderby)
    {
       return $this->db->table($table_name)->select('*')->where($where_condition)->orderBy($orderby[0],"DESC")->get()->getrow(); 
    }
    
    
    public function table_list_of_users()
    {
        $this->table_list_of_users_query();
        if ($_POST['length'] != -1) {
            $this->builder->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->builder->get();
        return $query->getResult();
    }
    public function table_list_of_users_countAll()
    {      
        $this->table_list_of_users_query();
        $query = $this->builder->get();
        // return $this->builder->countAllResults();
        return $query->getNumRows();
    }
    public function table_list_of_users_countFiltered()
    {
        $this->table_list_of_users_query();
        $query = $this->builder->get();
        // return $this->builder->countAll();
        return count($query->getResult());
    }
    private function table_list_of_users_query()
    {
        // print_r($user_id);exit;
        $column_order = array();
        $column_search = array('name','username');
        $order     = array('');
        
        $this->builder = $this->db->table("users as T1")
        ->select('*')
        ->where('T1.user_delete', 'Active');
        
        
        $i = 0;
        // $postData       = $this->request->getPost();
        // loop searchable columns 
        foreach ($column_search as $item) {
            // if datatable send POST for search
            if ($_POST['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->builder->groupStart();
                    $this->builder->like($item, $_POST['search']['value']);
                } else {
                    $this->builder->orLike($item, $_POST['search']['value']);
                }

                // last loop
                if (count($column_search) - 1 == $i) {
                    // close bracket
                    $this->builder->groupEnd();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->builder->orderBy($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->builder->orderBy(key($order), $order[key($order)]);
        }
    }



}
