<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sla extends AdminController
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
                $crud->set_table('m_escalation_address');
                $crud->set_subject('Escalation SLA');
                $crud->set_theme('datatables');
                $crud->required_fields('escalation_group','escalation_type','name','email','phone');
                $crud->columns('escalation_group','name','email','phone');

                $crud->fields('escalation_group','escalation_type','name','email','phone');
                $crud->display_as('escalation_group','Group ID')
                    ->display_as('name','Name')
                    ->display_as('email','Email')
                    ->display_as('phone','Phone');
        $crud->set_relation('escalation_group','ion_groups','name');
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
            'action'        => "Create Escalation SLA",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function update_callback($post_array) {
        $req = array(
            'action'        => "Edit Escalation SLA",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }
    function delete_callback($post_array) {
        $req = array(
            'action'        => "Delete Escalation SLA",
            'user_name'   => $this->session->userdata('username'),
            'date'    => date('Y-m-d  H:i:s')

        );
        $post_array = $this->db->insert('history_user', $req);
        return $post_array;
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/topic.php */
