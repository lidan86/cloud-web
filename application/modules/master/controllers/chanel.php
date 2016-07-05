<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chanel extends AdminController
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
                $crud->set_table('m_channel');
                $crud->set_subject('Channel');
                $crud->set_theme('datatables');
                $crud->required_fields('channel');
                $crud->columns('channel');
                $crud->fields('channel',
                        'created_at','user_add','updated_at','user_update');
                $crud->change_field_type('created_at','invisible')
                        ->change_field_type('user_add','invisible')
                        ->change_field_type('updated_at','invisible')
                        ->change_field_type('user_update','invisible');
                $crud->display_as('channel','Channel');
                $crud->callback_before_insert(array($this,'insert_callback'));
                $crud->callback_before_update(array($this,'update_callback'));
//                $crud->unset_print();

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
