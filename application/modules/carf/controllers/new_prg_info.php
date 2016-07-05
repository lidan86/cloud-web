<?php
class new_prg_info extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('m_carf');
    }
    public function index(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('New (CARF) - Program Information');
                $crud->columns('project_name');                
                $crud->unset_edit();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
                $crud->required_fields('project_name','mpe_number','drf_num','priority','prod_type_id',
                    'pic_prod_owner_id','tld','ttd','objective_id','target_market_category',
                    'target_market_id');
                $crud->field_type('mpe_number', 'integer');
                $crud->field_type('drf_num', 'integer');
                $crud->field_type('tld', 'date');
                $crud->field_type('ttd', 'date');


        $crud->fields('approval','request_num','created_at','user_add',
            'project_name','mpe_number','drf_num','priority','prod_type_id','req_type_id',
            'pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_category',
            'target_market_id','mention_reg','mention_seg','flag_form','updated_at');
        $crud->display_as('project_name','Project Name')
            ->display_as('mpe_number','MPE Number')
            ->display_as('drf_num','DRF Number')
            ->display_as('priority','Priority')
            ->display_as('prod_type_id','Product Type')
            ->display_as('pic_prod_owner_id','Product Owner')
            ->display_as('tld','Target Launch Date')
            ->display_as('ttd','Target Termination Date')
            ->display_as('program_desc','Program Description')
            ->display_as('objective_id','Objective')
            ->display_as('target_market_category','Target Market Customer Category')
            ->display_as('target_market_id','Target Market Customer')
            ->display_as('mention_reg','If Region pls mention')
            ->display_as('mention_seg','Segment community based');
        $crud->unset_texteditor('program_desc','full_text');
        $crud->unique_fields('project_name');
        $crud->change_field_type('created_at','invisible')
            ->change_field_type('user_add','invisible')
            ->change_field_type('req_type_id','invisible')
            ->change_field_type('flag_form','invisible')
            ->change_field_type('updated_at','invisible')
            ->change_field_type('approval','invisible')
            ->change_field_type('request_num','invisible');
        $crud->set_lang_string('insert_success_message',
            'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
                 <script type="text/javascript">
                  window.location = "'.base_url().'carf";
                 </script>
                 <div style="display:none">
                 ');
        $crud->set_relation_n_n('prod_type_id','r_master_carf','m_prod_type','carf_id','prod_type_id','name');
        $crud->set_relation_n_n('objective_id','r_master_carf','m_pi_obj','carf_id','pi_obj_id','name');
        $crud->set_relation('pic_prod_owner_id','ion_users','username','id > 1 and group_id = 6');
        $crud->set_relation('priority','m_priority','name');
        $crud->set_relation('target_market_id','m_pi_prepaid','name');
        $crud->set_relation_n_n('mention_reg','r_master_carf','m_region_reg','carf_id','pi_reg_poc','region_name');
                $crud->callback_before_insert(array($this,'insert_callback'));
//                $crud->callback_field('tld',array($this,'field_tld'));
//                $crud->callback_field('ttd',array($this,'field_ttd'));
                $data['gcrud'] = $crud->render();
		$this->template->build('v_prog_info', $data);
    }
//    function field_tld($value = '', $primary_key = null){
//        $tampil=  '<input id="field-tld" name="tld" value="" maxlength="10" class="datepicker-input form-control hasDatepicker" type="text">';
//        return $tampil;
//    }
//    function field_ttd($value = '', $primary_key = null){
//        $tampil=  '<input id="field-ttd" class="datepicker-input form-control hasDatepicker" type="text" maxlength="10" value="" name="ttd">';
//        return $tampil;
//    }
        function insert_callback($post_array,$primary_key) {
            $post_array['approval'] = 11;
            $post_array['req_type_id'] = 'New';
            $post_array['request_num'] = date("Ymd");
            $post_array['created_at'] = date('Y-m-d H:i:s');
            $post_array['updated_at'] = date('Y-m-d H:i:s');
            $post_array['user_add'] = $this->session->userdata('user_id');
            $post_array['flag_form'] = 1;
            return $post_array;
        }
}