<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jr extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $url_link = "href='".base_url()."master/jr/user'";
        $data['newbutton']='<button type="button" class="btn btn-success" onclick="location.'.$url_link.'">Job Role</button>';
        $crud = new grocery_CRUD();
        $crud->set_table('ion_users');
        $crud->set_subject('User');
        $crud->set_theme('datatables');
        $crud->unset_add();
        
        $crud->unset_delete(); $crud->unset_export();$crud->unset_print();
        $crud->required_fields('name');
        $crud->columns('username','m_job_role_id','notes');

        $crud->fields('m_job_role_id','notes');
        $crud->display_as('m_job_role_id','Job Role');
        $crud->set_relation('m_job_role_id','m_job_role','name');
//                $crud->unset_print();
//                if(!Modules::run('role/has_role', 'create_mbe')){$crud->unset_add();}
//                if(!Modules::run('role/has_role', 'update_mbe')){$crud->unset_edit();}
//                if(!Modules::run('role/has_role', 'delete_mbe')){$crud->unset_delete();}
        $data['gcrud'] = $crud->render();

		$this->template->build('v_jr', $data);
    }

    public function user()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('m_job_role');
        $crud->set_subject('Job Role');
        $crud->set_theme('datatables');
        $crud->required_fields('name');
        $crud->columns('name');

        $crud->fields('name');
        $crud->display_as('name','Job Role');
        $crud->callback_before_insert(array($this,'insert_callback'));
        $crud->callback_before_update(array($this,'update_callback'));
        $crud->callback_before_delete(array($this,'delete_callback'));

//                $crud->unset_print();
//                if(!Modules::run('role/has_role', 'create_mbe')){$crud->unset_add();}
//                if(!Modules::run('role/has_role', 'update_mbe')){$crud->unset_edit();}
//                if(!Modules::run('role/has_role', 'delete_mbe')){$crud->unset_delete();}
        $data['gcrud'] = $crud->render();


        $this->template->build('v_index', $data);
    }
    function insert_callback($post_array) {
        $req = array(
            'action'        => "Create Job Role",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function update_callback($post_array) {
        $req = array(
            'action'        => "Edit Job Role",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function delete_callback($post_array) {
        $req = array(
            'action'        => "Delete Job Role",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/topic.php */
