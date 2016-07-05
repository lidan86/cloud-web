<?php
class prg_mec extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('_m');
    }
    public function index(){
//        $crud = $this->new_crud();
//                $crud->set_table('carf');
//                $crud->set_subject('(CARF) - Traffic Project');
//                $crud->columns('project_name');
//                $crud->unset_add();$crud->unset_delete();$crud->unset_list();
//                $crud->unset_export();$crud->unset_print();
//                $crud->unset_back_to_list();
//                $crud->edit_fields('sp_project_txt');
//                $crud->unset_fields(
//                        'project_name','mpe_number','drf_num','priority','prod_type_id','req_type_id','mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_prepaid_id','mention_reg_prep','mention_seg_prep','target_market_postpaid_id','mention_reg_post','mention_seg_post',
////                        'sp_project_txt',
//                        'first_reg','charging_by','charging_by_notes','recurring_model','recurring_period','registration_chan','tarif_information','tarif_p1','tarif_p1_tax','tarif_p2','tarif_p2_tax','tarif_p3','tarif_p3_tax',
//                        'cs_tools_needed_id','cs_tools_other',
//                        'pd_pic','received_date',
//                        'additional_modul_mobile','additional_modul_mobile_others','roaming_int_mobile','roaming_int_mobile_other','additional_modul_broadband','additional_modul_broadband_other','roaming_int_broadband','roaming_int_broadband_others','srv_param','additional_modul_blackberry','other_modul_blackberry','roaming_int_blackberry','additional_modul_vas_orhers',
//                        'Subscriber_benefit','user_requirement','key_com_tag','media_prog_launch','media_ongoing_basic','general_flow','sms_reg_p1','sms_reg_p2','sms_reg_p3','sms_reg_p4','sms_reg_p5','sms_unreg_p1','sms_unreg_p2','sms_unreg_p3','sms_unreg_p4','sms_unreg_p5','query_info','query_usage','sdc','sdc_int_roaming','if_not_avaliable','wording_notif_reg','when_provided_reg','wording_notif_recur','when_provided_recur','query_info_layanan','query_info_quota','query_info_usage','when_provided_info','wording_notif_unreg','when_provided_unreg','wording_notif_others',
//                        'business_model','business_model_other',
//                        'sog_capman','billing','engineering','vas_eng','netplan','it_ds','bca','reva','regulator','third_party','other_if_any',
//                        'vas_low_conc','vas_low_dev','vas_med_conc','vas_med_dev','vas_high_conc','vas_high_dev','device_low_conc','device_low_dev','device_med_conc','device_med_dev','device_high_conc','device_high_dev',
//                        'recommendation',
//                        'request_num','sp_project_id','email','mobile','additional_modul_vas','prog_mech_note','attachment_id','service_path_desc','system_net_element impact','it_service_path','it_system_desc','it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available','it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available','net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation','cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value',
//                        'approval','created_at','user_add','updated_at','user_update'
//                        );
//
//                $crud->display_as('sp_project_txt','SP projection (Sales/Activation)');
//                $crud->set_lang_string('update_success_message',
//                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
//                 <script type="text/javascript">
//                  window.location = "'.base_url().'carf/pack_detail/index/edit/'.$this->uri->segment(5).'";
//                 </script>
//                 <div style="display:none">
//                 ');
//                try{
//                        $data['gcrud'] = $crud->render();
//                    } catch(Exception $e) {
//                        if($e->getCode() == 14) //The 14 is the code of the "You don't have permissions" error on grocery CRUD.
//                    {
//                        redirect(base_url().'carf');
//                    }else{
//                        show_error($e->getMessage());
//                    }
//                    }
        $data['id'] = $this->uri->segment(5);

            $this->template->build('v_prg', $data);

    }
    public function add_data(){
        $data['id'] =  $this->uri->segment(5);

        $this->template->build('v_carf_project_add',$data);
    }
    public function do_insert(){
        $id = $_POST['carf_id'];
        $months = $_POST['months'];
        $total_voice = $_POST['total_voice'];
        $total_sms = $_POST['total_sms'];
        $total_data_peak_traffic = $_POST['total_data_peak_traffic'];
        $total_data_revenue = $_POST['total_data_revenue'];
        $years = date('Y');
        $burn_rate = 0;
        $churn_rate = 0;
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $url = $api.'CapmanApi/CarfProjection';
        $query = $this->db->query("select project_name, request_num, priority,tld,ttd, username from carf a, ion_users b where a.id = ".$id." and a.pic_prod_owner_id = b.id LIMIT 1");
        $sqlz = $query->result();
        foreach($sqlz as $row){
            $project_name = $row->project_name;
            $request_num = $row->request_num;
            $priority = "P".$row->priority;
            $tld = $row->tld;
            $ttd = $row->ttd;
            $product_owner = $row->username;

        }
        //http://192.168.50.93:8080/CapmanApi/CarfProjection?status=insert&
        //carf_id=bla&
        //project_name=bla&request_number=bla&priority=bla&product_owner=bla&target_launch_date=bla&target_termination_date=bla
        //&months=bla
        //&total_voice=bla&total_sms=bla&total_data_peak_traffic=bla
        //&total_data_revenue=bla&burn_rate=bla&churn_rate=bla&years=bla
        $fields = array(
            'status' => urlencode("insert"),
            'carf_id' => urlencode($id),
            'project_name'=> urlencode($project_name),
            'request_number' => urlencode($request_num),
            'priority'=>urlencode($priority),
            'product_owner' => urlencode($product_owner),
            'target_launch_date'=> urlencode($tld),
            'target_termination_date' => urlencode($ttd),
            'months' => urlencode($months),
            'total_voice' => urlencode($total_voice),
            'total_sms' => urlencode($total_sms),
            'total_data_peak_traffic' => urlencode($total_data_peak_traffic),
            'total_data_revenue' => urlencode($total_data_revenue),
            'burn_rate' => urlencode($burn_rate),
            'churn_rate' => urlencode($churn_rate),
            'years'=> urlencode($years)

        );


//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST ,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($fields));

//execute post
        $result = curl_exec($ch);

//close connection
        curl_close($ch);

        redirect("carf/traffic_proj/index/edit/".$id);
    }
    public function editData($id) {
        $carf =  $this->uri->segment(5);
        $idx = $this->uri->segment(6);
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/CarfProjection?status=getid&id='.urlencode($idx).'&carf_id='.urlencode($carf),false,$context);
        $row = json_decode($json,true);

        $data = array(
            'id'=> $row[0]['id'],
            'carf_id'=> $row[0]['carf_id'],
            'months' => $row[0]['months'],
            'total_voice' =>$row[0]['total_voice'],
            'total_sms' => $row[0]['total_sms'],
            'total_data_peak_traffic' => $row[0]['total_data_peak_traffic'],


        );

        $this->template->build('v_carf_project_edit',$data);
    }
    public function do_update() {
        $id = $_POST['id'];
        $carf_id =$_POST['carf_id'];
        $months = $_POST['months'];
        $total_voice = $_POST['total_voice'];
        $total_sms = $_POST['total_sms'];
        $total_data_peak_traffic = $_POST['total_data_peak_traffic'];
        $total_data_revenue = 0;
        $years = date('Y');
        $burn_rate = 0;
        $churn_rate = 0;
        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $query = $this->db->query("select project_name, request_num, priority,tld,ttd, username from carf a, ion_users b where a.id = ".$carf_id." and a.pic_prod_owner_id = b.id LIMIT 1");
        $sqlz = $query->result();
        foreach($sqlz as $row){
            $project_name = $row->project_name;
            $request_num = $row->request_num;
            $priority = "P".$row->priority;
            $tld = $row->tld;
            $ttd = $row->ttd;
            $product_owner = $row->username;

        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/CarfProjection?status=update&id='.$id.'&carf_id='.urlencode($carf_id).'&project_name='.urlencode($project_name).'&request_number='.urlencode($request_num).'&priority='.urlencode($priority).'&product_owner='.urlencode($product_owner).'&target_launch_date='.urlencode($tld).'&target_termination_date='.urlencode($ttd).'&months='.urlencode($months).'&total_voice='.urlencode($total_voice).'&total_sms='.urlencode($total_sms).'&total_data_peak_traffic='.urlencode($total_data_peak_traffic).'&total_data_revenue='.urlencode($total_data_revenue).'&burn_rate='.urlencode($burn_rate).'&churn_rate='.urlencode($churn_rate).'&years='.urlencode($years),false,$context);
        $result = json_decode($json,true);
        redirect("carf/traffic_proj/index/edit/".$carf_id);
    }
    public function do_delete() {
        $carf =  $this->uri->segment(5);
        $idx = $this->uri->segment(6);

        $queryx = $this->db->query("select api from api LIMIT 1");
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $api = $row->api;
        }
        $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n', 'timeout' => 1200)));
        $json = file_get_contents($api.'CapmanApi/CarfProjection?status=delete&id='.$idx.'&carf_id='.$carf,false,$context);
        $result = json_decode($json,true);

        redirect("carf/traffic_proj/index/edit/".$carf);
    }
}