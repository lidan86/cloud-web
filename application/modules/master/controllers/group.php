<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends AdminController
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
                $crud->set_table('ion_groups');

                $crud->set_subject('Group User');
                $crud->set_theme('datatables');
                $crud->required_fields('name','description','file');
                $crud->columns('id','name','description','file');
                $crud->where('id > 1');
                $crud->fields('name','description','file');
                $crud->display_as('name','Group User')
                    ->display_as('description','Description');
        $crud->set_field_upload('file','_uploads/profile');
        $crud->callback_column('group_icon_id',array($this,'_cb_thumb'));
        $crud->callback_before_insert(array($this,'insert_callback'));
        $crud->callback_before_update(array($this,'update_callback'));
        $crud->callback_before_delete(array($this,'delete_callback'));
        $crud->unset_export();
        $crud->unset_print();

//                $crud->unset_print();
//                if(!Modules::run('role/has_role', 'create_mbe')){$crud->unset_add();}
//                if(!Modules::run('role/has_role', 'update_mbe')){$crud->unset_edit();}
//                if(!Modules::run('role/has_role', 'delete_mbe')){$crud->unset_delete();}
                $data['gcrud'] = $crud->render();
		$this->template->build('v_index', $data);
    }
    public function _cb_thumb($value,$row)
    {
        if ($value > 0 )
        {

            return "<center><img width='40' height='40' src='".base_url()."_uploads/profile/$value'></center>";
        }
        else
        {
            return FALSE;
        }
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
