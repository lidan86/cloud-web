<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class be extends AdminController
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
                $crud->set_table('business_entity');
                $crud->set_subject('Business Entity');
                $crud->set_theme('datatables');
                $crud->required_fields('business_name');
                $crud->columns('business_name');
                $crud->fields('business_name',
                        'created_at','user_add','updated_at','user_update');
                $crud->change_field_type('created_at','invisible')
                        ->change_field_type('user_add','invisible')
                        ->change_field_type('updated_at','invisible')
                        ->change_field_type('user_update','invisible');
                $crud->display_as('business_name','Business Entity')
				 ->display_as('client_name','Client Name')
				 ->display_as('contactLastName','Last Name');
                $crud->callback_before_insert(array($this,'insert_callback'));
                $crud->callback_before_update(array($this,'update_callback'));
//                $crud->unset_print();
                if(!Modules::run('role/has_role', 'create_mbe')){$crud->unset_add();}
                if(!Modules::run('role/has_role', 'update_mbe')){$crud->unset_edit();}
                if(!Modules::run('role/has_role', 'delete_mbe')){$crud->unset_delete();}
                $data['gcrud'] = $crud->render();
		$this->template->build('be_index', $data);
    }
        function insert_callback($post_array) { 
            $post_array['created_at'] = date('Y-m-d H:i:s');
            $post_array['user_add'] = $this->session->userdata('user_id'); 
            return $post_array;
        }
        function update_callback($post_array) { 
            $post_array['updated_at'] = date('Y-m-d H:i:s');
            $post_array['user_update'] = $this->session->userdata('user_id'); 
            return $post_array;
        }


}

/* End of file welcome.php */
/* Location: ./application/controllers/topic.php */
