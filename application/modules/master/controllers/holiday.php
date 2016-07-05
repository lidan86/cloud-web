<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday extends AdminController
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
                $crud->set_table('m_holiday');
                $crud->set_subject('Holiday');
                $crud->set_theme('datatables');
                $crud->required_fields('name', 'date','note');
                $crud->columns('name', 'date');

                $crud->fields('name', 'date','note');
                $crud->display_as('name','Name Holiday')
                    ->display_as('date','Date Holiday')
                    ->display_as('note','Description');
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
                'action'        => "Create Holiday",
                'user_name'   => $this->session->userdata('username'),
                'date'    => date('Y-m-d  H:i:s')

            );
            $post_array = $this->db->insert('history_user', $req);
            return $post_array;
        }
        function update_callback($post_array) {
            $req = array(
                'action'        => "Edit Holiday",
                'user_name'   => $this->session->userdata('username'),
                'date'    => date('Y-m-d  H:i:s')

            );
            $post_array = $this->db->insert('history_user', $req);
            return $post_array;
        }
    function delete_callback($post_array) {
        $req = array(
            'action'        => "Delete Holiday",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/topic.php */
