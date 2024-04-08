<?php

namespace App\Controllers;
use App\Models\Homemodel;

class Home extends BaseController
{
    protected $session;
    function __construct()
    {
        $this->session = \Config\Services::session();
        //$this->db      = \Config\Database::connect();
        $this->session->start();
        $this->model = new Homemodel();
    } 
    function index()
    {
        return view('index');
    }
    function user_registration_form()
    {
        //$session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $table_name  = "users";
        $where_condition = array('user_name' => $username);

        $data = $this->model->fetchData($table_name,$where_condition);
        if($data){
            $this->session->setFlashdata('msg', 'username already Exists');
            return redirect()->to(site_url('/user_registration'));
        
        }else{
            // print_r($_FILES);exit;
            $img = $this->request->getFile('file');
            $file_name = date('Ymd_Hms_') . $img->getName();
            $file = "";
    
            if (!is_dir('././assets/emp_image')) {
                mkdir('././assets/emp_image', 0777, TRUE);
            }
            if (isset($img) && $img != '') {
                $file =  $file_name;
                $fileupload = $img->move(ROOTPATH . '/assets/emp_image', $file_name);
            }
           
                $ins = array(
                    
                    'user_name'       => $this->request->getPost('username'),
                    'name'       => $this->request->getPost('username'),
                    'user_password'       => $this->request->getPost('password'),
                    'phone_number'       => $this->request->getPost('phone_number'),
                    'gender'      => $this->request->getPost('gender'),
                    'address'      => $this->request->getPost('address'),
                    'photo' => $file );

                    $data = $this->model->InsertData('users',$ins);
                    $this->session->setFlashdata('msg', 'User Registered Successfully');
                    return redirect()->to(site_url('user_registration'));
                
            }


        
    }


    function login()
    {
        //$session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $table_name  = "users";
        $where_condition = array('user_name' => $username);

        $data = $this->model->fetchData($table_name,$where_condition);
        if($data){
            $pass = $data->user_password;
            if($password == $pass){
                $ses_data = [
                    'user_id'       => $data->users_pid,
                    'user_name'       => $data->user_name,
                    'password'       => $data->user_password,
                    'user_type'      => $data->user_type,
                    'name'      => $data->name,
                    'photo'      => $data->photo,
                    'logged_in'     => TRUE
                ];
               
                $this->session->set($ses_data);
                $this->session->setFlashdata('msg', 'Login Successfully');
                return redirect()->to(site_url('dashboard'));
            }else{
                $this->session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to(site_url('/'));
            }
        }else{
            $this->session->setFlashdata('msg', 'username not Found');
            return redirect()->to(site_url('/'));
        } 
    }

    function add_book()
    {
        // return view('add_book');
        $data['header_name'] = "Add Book";
        $data['menu_active'] = "add_book";
        
        return view('add_book',$data);
    }

    function list_of_users()
    {
        // return view('add_book');
        $data['header_name'] = "List Of users";
        $data['menu_active'] = "Dashboard";
        
        return view('users_list',$data);
    }
    function user_registration()
    {
        
        return view('user_registration');
    }

   

   


    function dashboard()
    {
        $user_name  = $this->session->get('user_name');

        if(!empty($user_name)){

            $data['header_name'] = "Dashboard";
            $data['menu_active'] = "dashbaord";
            $input_val = '';

            $data['result'] = $this->model->fetchData_book_list($input_val);
            // print_r($data['result']);exit;
            
            return view('dashboard',$data);
        } else {
            return redirect()->to(site_url('/'));
        }
    }

    function common_delete()
    {
        $id          = $this->request->getPost('id');
        $table_name  = $this->request->getPost('table_name');
        $column_name = $this->request->getPost('delete_status');
        $column_pid  = $this->request->getPost('column_pid');
        $fields = array(
            $column_name => 'In Active'
        );
        $where_condition = array($column_pid => $id);
        $result = $this->model->UpdateData($fields, $table_name, $where_condition);
        echo $result;
    }

    function table_list_of_users(){

        $arrayList   = [];
        $postData       = $this->request->getPost();
        $no              = $this->request->getPost('start');
        // $type = $this->request->getPost('type_book');
        // $user_id = $this->session->get('user_id');

        $users_list    = $this->model->table_list_of_users();

        foreach ($users_list as $row) {
            $action = '';

                $action = ' <a href = "' . base_url('/user_registration') . $row->users_pid . '"  ><i  class="bx bx-edit" aria-hidden="true"></i></a>  || <i  class="bx bx-trash-alt delete_data" id="' . $row->users_pid . '->users->user_delete->list_of_users->users_pid" aria-hidden="true" style="color:red;cursor:pointer;font-size:18px;"> </i> ';


            // $action .= '&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;<a href = "' . base_url('/uploads/book_file/') . $row->book_file . '" download style="color:blue;cursor:pointer;font-size:18px;" ><i  class="lni lni-cloud-download" aria-hidden="true"</i></a>';
           
            $no++;
            $arrayList[] = [
                $no,
                $row->user_name,
                $row->phone_number,
                $row->gender,
                $row->address,
                $row->photo,
                $action
            ];
        }
        $output = array(
            "draw"     => $this->request->getPost('draw'),
            "recordsTotal"   => $this->model->table_list_of_users_countAll(),
            "recordsFiltered" => $this->model->table_list_of_users_countFiltered(),
            "data"     => $arrayList,
        );
        echo json_encode($output);
    }



    function logout()
    {
        $session = session();
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }



}