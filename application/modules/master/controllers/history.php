<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $crud = new grocery_CRUD();
                $crud->set_table('history_user');
                $crud->set_subject('History Master Data');
                $crud->set_theme('datatables');
                $crud->columns('user_name','action','date');

        $crud->unset_add();
        $crud->unset_read();
        $crud->unset_edit();
        $crud->unset_delete();

                $crud->fields('user_name','action','date');
                $crud->display_as('user_name','Username');

//                $crud->unset_print();
//                if(!Modules::run('role/has_role', 'create_mbe')){$crud->unset_add();}
//                if(!Modules::run('role/has_role', 'update_mbe')){$crud->unset_edit();}
//                if(!Modules::run('role/has_role', 'delete_mbe')){$crud->unset_delete();}
                $data['gcrud'] = $crud->render();
		$this->template->build('v_index', $data);
    }
    function insert_callback($post_array) {
        $req = array(
            'action'        => "Create Modul Broadband",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function update_callback($post_array) {
        $req = array(
            'action'        => "Edit Modul Broadband",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function delete_callback($post_array) {
        $req = array(
            'action'        => "Delete Modul Broadband",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/topic.php */
