<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ct extends AdminController
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
                $crud->set_table('m_cs_tools_needed');
                $crud->set_subject('CS Tools');
                $crud->set_theme('datatables');
                $crud->required_fields('name');
                $crud->columns('name');

                $crud->fields('name');
                $crud->display_as('name','CS Tools');
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
            'action'        => "Create CS Tools",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function update_callback($post_array) {
        $req = array(
            'action'        => "Edit CS Tools",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function delete_callback($post_array) {
        $req = array(
            'action'        => "Delete CS Tools",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/topic.php */
