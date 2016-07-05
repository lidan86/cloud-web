<?php
class Other_app extends MX_Controller {

	public function __construct() {
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
                
                $this->load->model('modulereza');
        }
    function index(){
        $data = $this->modulereza->getTest();
            
            $this->template->build('v_report');
    }
    
    public function add_data(){
        $this->template->build('add_data');
        
        
    }
    
    public function do_insert(){
       $nama = $_POST['service'];
       $data_insert = array(
           'service' => $nama
       );
       $res = $this->modulereza->inserData('service', $data_insert);
        if($res>=1){
            $this->session->set_flashdata('pesan','insert data success');
            redirect('service');
        }else{

           }
    }
    
    public function editData($id) {
        $mhs = $this->modulereza->getTest(" where id = '$id'");
        $data = array(
            'id' => $mhs[0]['id'],
            'service' => $mhs[0]['service']
        );
        $this->template->build('edit_data',$data);
    }
    
    public function do_update() {
        $id = $_POST['id'];
        $nama = $_POST['service'];
       $data_update = array(
           'service' => $nama
       );
       $where = array('id' => $id);
       $res = $this->modulereza->updateData('service', $data_update,$where);
        if($res>=1){
            $this->session->set_flashdata('pesan','edit data success');
            redirect('service');
        }else{
            echo '<h2> insert data gagal </h2>';
        }

    }
    
    public function do_delete($nim) {
        $where = array('id' => $nim);
        $res = $this->modulereza->deleteData('service',$where);
        if($res>=1){
           $this->session->set_flashdata('pesan','delete data success');
             redirect('service');
        }
    }
}
