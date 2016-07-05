<?php
class bug extends AdminController {

    public function __construct() {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
        $this->load->model('_m');
    }

    public function index(){
        if($this->session->userdata['group_name'] == 'administrator'){
            $crud = new grocery_CRUD();
            $crud->set_table('m_msg');
            $crud->where('code','bug');
            $crud->set_subject('Bug Rport');
            $crud->set_theme('datatables');
            $crud->unset_texteditor('msg1');
            $crud->columns('attributes','msg','msg1','created_at','user_add');
            $crud->change_field_type('created_at','invisible')
                    ->change_field_type('user_add','invisible')
                    ->change_field_type('updated_at','invisible')
                    ->change_field_type('user_update','invisible');
            $crud->set_relation('user_add','ion_users','username');
            $crud->unset_read_fields('created_at','user_add','updated_at','user_update');
            $crud->unset_add();
//            $crud->unset_edit();
            $crud->unset_delete();
            $data['gcrud'] = $crud->render();
            $data['status'] ='admin';
        }else $data['status'] ='user';
            
        $this->template->build('v_bug',$data);
            if ($this->input->post()){
                $msg = array(
                    'code'          => 'bug',
                    'attributes'    => $this->input->post('url', TRUE),
                    'msg'           => $this->input->post('comment', TRUE),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'user_add'      => $this->session->userdata('user_id')
                        );
                $urllama = $this->input->post('url', TRUE);
                $this->db->insert('m_msg', $msg);
                redirect($urllama);
            }  
            
    }
}