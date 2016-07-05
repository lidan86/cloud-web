<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class client_docs extends AdminController
{
    private $master_id = 0;
    public function __construct()
    {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
        $this->load->library('grocery_CRUD');
    }

    public function index($id='')
    {
        $this->load->model('clients');
        $data['info_client'] = $this->clients->get_client($id);
        $this->master_id = $id;
        $crud = new grocery_CRUD();
        $crud->where('code','Document Client');
        $crud->where('master_id',$this->master_id);
        $crud->set_subject('Business Entity');
//        foreach($row_clients as $row): 
//            $crud->set_subject('Documents for '.$row->client_name);
//            echo 'Documents for '.$row->client_name;
//        endforeach;
                $crud->set_table('files');
                $crud->set_subject('Document Client');
                $crud->set_theme('datatables');
                $crud->required_fields('file','note');
                $crud->columns('file','note');
                $crud->fields('file','note','master_id','code',
                        'created_at','user_add','updated_at','user_update');
                $crud->change_field_type('master_id','invisible')
                        ->change_field_type('code','invisible')
                        ->change_field_type('created_at','invisible')
                        ->change_field_type('user_add','invisible')
                        ->change_field_type('updated_at','invisible')
                        ->change_field_type('user_update','invisible');
                $crud->set_field_upload('file','_uploads/doc_client');
                $crud->callback_before_insert(array($this,'insert_callback'));
                $crud->callback_before_update(array($this,'update_callback'));
                $data['gcrud'] = $crud->render();
		$this->template->build('client_index', $data);
    }
        function insert_callback($post_array) { 
            $post_array['code'] = 'Document Client';
            $post_array['master_id'] = $this->master_id;
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
