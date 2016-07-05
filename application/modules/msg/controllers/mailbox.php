<?php
class Mailbox extends AdminController {

    public function __construct() {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
    }

    public function index(){
            $crud = new grocery_CRUD();
            $crud->set_table('m_msg');
            $crud->where('code','bug');
            $crud->where('username',$this->session->userdata('username'));
            $crud->set_subject('MailBox');
            $crud->set_theme('datatables');
            $crud->columns('msg');
            $crud->set_relation('user_add','ion_users','username');
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_export();
            $crud->callback_column('msg',array($this,'_callback_msg'));
            $data['gcrud'] = $crud->render();
            $this->template->set_metadata('', base_url().'_assets/js/plugins.js', 'js');
            $this->template->build('v_mailbox',$data);
    }
    public function _callback_msg($value, $row){
        $from = new DateTime($row->created_at); $to = new DateTime(date('Y-m-d H:i:s'));
        $from1 = new DateTime($row->updated_at); $to = new DateTime(date('Y-m-d H:i:s'));
        $diff = $to->diff($from);$diff1 = $to->diff($from1);
        $diff->w = floor($diff->d / 7);$diff1->w = floor($diff1->d / 7);
        $diff->d -= $diff->w * 7;$diff1->d -= $diff1->w * 7;
        $string = array('y' => 'thn','m' => 'bln','w' => 'mng','d' => 'hr','h' => 'jam','i' => 'mnt','s' => 'dtk',);
        $string1 = array('y' => 'thn','m' => 'bln','w' => 'mng','d' => 'hr','h' => 'jam','i' => 'mnt','s' => 'dtk',);
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }
        foreach ($string1 as $k => &$v) {
            if ($diff1->$k) {
                $v = $diff1->$k . ' ' . $v . ($diff1->$k > 1 ? '' : '');
            } else {
                unset($string1[$k]);
            }
        }
        $waktu = $string ? implode(', ', $string) . ' lalu' : 'baru saja';
        $waktu1 = $string1 ? implode(', ', $string1) . ' lalu' : 'baru saja';
        if ($row->msg1 =='')
        $balas = '?';else $balas = $row->msg1.' | <i class="icon-time"> '.$waktu1.'</i>';
        $isi_html ='
                        <div class="list-text">                                   
                            <div class="list-text-info">
                                <i class="icon-bug"></i> '.$value.' | <i class="icon-time"> '.$waktu.'</i></br>
                                <i class="icon-comments"></i> '.$balas.'
                            </div>
                        </div>
                    ';
        return $isi_html;
    }
}