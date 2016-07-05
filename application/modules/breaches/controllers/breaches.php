<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breaches extends AdminController {

    public function __construct() {
        parent::__construct();
		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
    }
	
	public function index(){
		$crud = new grocery_CRUD();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_add();
		$crud->unset_read();
		$crud->unset_edit();
		$crud->unset_delete();


		$crud->set_subject('History Breaches');
		$crud->set_table('history_breach');
		$crud->set_theme('datatables');

		$crud->columns('carf_id','group_id','send_time','subject','note');
		$crud->display_as('carf_id','CARF ID')
			->display_as('group_id','Group ID')
			->display_as('send_time','Send Time');

		$crud->set_relation('group_id','ion_groups','name');

		$crud->callback_column('carf_id',array($this,'_callback_action'));
		$crud->set_lang_string('insert_success_message',
			'Your data has been successfully stored into the database.<br/>.
         <script type="text/javascript">
                  window.location = "'.base_url().'sendemail/";
                 </script>
                 <div style="display:none">
         ');
		$url_link = "href='".base_url()."breaches/chart'";
		$data['newbutton']='<button type="button" class="btn btn-success" onclick="location.'.$url_link.'">Chart</button>';
		$data['gcrud'] = $crud->render();
		$this->template->build('v_index', $data);
	}
	public function _callback_action($value, $row){


		$status2 = '
            <div class="btn-group">
           <a class="btn btn-info" href="'.base_url().'breaches/prg_info/index/read/'.$row->carf_id.'">View Carf</a>
            </div>
            ';

		$isirow='  <div class="row">'
			. '     <div class="col-md-8">'
			. '         <i class="icon-tag"></i> '.$value.''
			. '     <div>'
			. '<div>'
			. '<div class="row">'
			. '     <div class="col-md-12">'
			. '         | '.$status2.''
			. '     <div>'
			. '<div>';
		return $isirow;
	}
	public function chart(){
		$this->template->build('v_chart');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */