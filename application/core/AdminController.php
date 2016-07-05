<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class AdminController extends GlobalController {

    public function __construct()
    {
        parent::__construct();
//        Modules::run('auth/make_sure_is_logged_in');
//        if (!$this->ion_auth->is_admin())
//			{
//				//redirect('auth');
//			}else{
//                            $this->output->enable_profiler(TRUE);
//                        }
    }
    public function new_crud(){
        $this->load->database();
$this->load->helper('url');
        $db_driver = $this->db->platform();
        $model_name = 'grocery_crud_model_'.$db_driver;
        $model_alias = 'm'.substr(md5(rand()), 0, rand(4,15) );
        unset($this->{$model_name});
        $this->load->library('grocery_CRUD');
        $crud = new Grocery_CRUD();
        if (file_exists(APPPATH.'/models/'.$model_name.'.php')){
        $this->load->model('grocery_crud_model');
        $this->load->model('grocery_crud_generic_model');
        $this->load->model($model_name,$model_alias);
        $crud->basic_model = $this->{$model_alias};
        }
    return $crud;
    }
    
    
    
    
    
    
}
