<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendemail extends MX_Controller {

    public function __construct() {
        parent::__construct();
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
    }
	
	public function index(){
		$crud = new grocery_CRUD();
		$crud->unset_export();
		$crud->unset_print();
		$crud->where('user_add',$this->session->userdata('user_id'));
		$crud->add_action('Email', '', 'sendemail/forward', 'ui-icon-mail-closed');
		$crud->set_subject('Forward Dashboard');
		$crud->set_table('email');
		$crud->set_theme('datatables');
		$crud->required_fields('file','note');
		$crud->columns('subject','file','note');
		$crud->fields('mail_to','subject','file','note',
			'created_at','user_add','updated_at','user_update');
		$crud->change_field_type('created_at','invisible')
			->change_field_type('user_add','invisible')
			->change_field_type('updated_at','invisible')
			->change_field_type('user_update','invisible');
		$crud->set_field_upload('file','_uploads/CD');
		$crud->set_relation('mail_to','ion_groups','name');
		$crud->callback_before_insert(array($this,'insert_callback'));
		$crud->callback_before_update(array($this,'update_callback'));
		$crud->unset_back_to_list();
		$crud->set_lang_string('insert_success_message',
			'Your data has been successfully stored into the database.<br/>.
         <script type="text/javascript">
                  window.location = "'.base_url().'sendemail/";
                 </script>
                 <div style="display:none">
         ');
		$data['gcrud'] = $crud->render();
		$this->template->build('v_index', $data);
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
	public function forward($id){
		$queryx = $this->db->query("select api from api LIMIT 1");
		$sqlx = $queryx->result();
		foreach($sqlx as  $row){
			$api = $row->api;
		}

		$queryz =$this->db->query("SELECT subject,mail_to,file,note FROM email WHERE id = ".$id);
		$resu = $queryz->result();
		foreach($resu as  $row){
			$subject = $row->subject;
			$mail_to = $row->mail_to;
			$file = $row->file;
			$note = $row->note;
		}
		$isi = $note."<br> <img src='".base_url()."_uploads/CD/".$file."'>";

		$query = $this->db->query("select email,mobile  from ion_users WHERE group_id=".$mail_to);
		$res = $query->result();
		//http://192.168.50.93:8080/ServerMail/Mail?status=now&mailfrom=capman@belinux.com&mailto=irsyadul.reza@gmail.com&subject=wwef&content=wwefwe

		$mailTo = '';
		foreach($res as  $row){
			$mailTo .= 'mailto='.$row->email.'&';


		}

		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n','timeout' => 1300)));
		$json = file_get_contents($api.'ServerMail/Mail?status=now&mailfrom='.urlencode('capman@belinux.com').'&'.$mailTo.'subject='.urlencode($subject).'&content='.urlencode($isi).'',false,$context);
		$result = json_decode($json,true);
		redirect("sendemail");

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */