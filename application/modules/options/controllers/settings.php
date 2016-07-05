<?php
class Settings extends AdminController {

	public function __construct() {
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');

//		$this->load->model('settings');
	}

    public function index(){
        $crud = new grocery_CRUD();
        $crud->set_table('ion_users');
        $crud->set_subject('Profile Picture');
        $crud->where('id',$this->session->userdata('user_id'));
        $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
        $crud->edit_fields('file');
        $crud->set_field_upload('file','_uploads/profile');
        $crud->unset_back_to_list();
        $crud->set_lang_string('update_success_message',
                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
                 <script type="text/javascript">
                  window.location = "'.base_url().'";
                 </script>
                 <div style="display:none">
                 ');
        $data['gcrud'] = $crud->render();
	$this->template->build('v_file', $data);
    }
    
    public function whois_user($id,$field){
        $this->load->model('settings');
        $hasil = $this->settings->get_info_user($id);
        $get_info ='';
        foreach ($hasil as $row_hasil) {
        $get_info = $row_hasil->$field;}
        if ($get_info == NULL){
            $get_info = '';
        }else{
            return $get_info;
        }
    }
    
    public function get_pic($id=''){
        if ($id==''){
            $id=$this->session->userdata('user_id');
        }
        $sql = $this->db->query("SELECT * FROM ion_users WHERE id = ".$id);
        $hasil = $sql->result();
        $get_info ='';
        foreach ($hasil as $row_hasil) {
        $get_info = $row_hasil->file;}
        if ($get_info == NULL){
            $file_gambar = base_url().'_uploads/profile/profile.png';
        }else{
            $file_gambar = base_url().'_uploads/profile/'.$get_info;
        }
        return $file_gambar;
    }


}