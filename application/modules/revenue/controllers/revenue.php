<?php
class Revenue extends MX_Controller {

	public function __construct() {
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
                
                $this->load->model('modulereza');
        }
    function index(){
       
            $this->template->build('v_revenue');
    }
    
    public function add_data(){
        $this->template->build('add_data');
        
        
    }
    
    public function do_insert(){
       $nama = $_POST['channel'];
       $data_insert = array(
           'channel' => $nama
       );
       $res = $this->modulereza->inserData('channel', $data_insert);
        if($res>=1){
            $this->session->set_flashdata('pesan','insert data success');
            redirect('channel');
        }else{

           }
    }
    
    public function editData($id) {
        $mhs = $this->modulereza->getTest(" where id = '$id'");
        $data = array(
            'id' => $mhs[0]['id'],
            'channel' => $mhs[0]['channel']
        );
        $this->template->build('edit_data',$data);
    }
    
    public function do_update() {
        $id = $_POST['id'];
        $nama = $_POST['channel'];
       $data_update = array(
           'channel' => $nama
       );
       $where = array('id' => $id);
       $res = $this->modulereza->updateData('channel', $data_update,$where);
        if($res>=1){
            $this->session->set_flashdata('pesan','edit data success');
            redirect('channel');
        }else{
            echo '<h2> insert data gagal </h2>';
        }

    }
    
    public function do_delete($nim) {
        $where = array('id' => $nim);
        $res = $this->modulereza->deleteData('channel',$where);
        if($res>=1){
           $this->session->set_flashdata('pesan','delete data success');
             redirect('channel');
        }
    }
}
