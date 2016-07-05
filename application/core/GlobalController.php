<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class GlobalController extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        setlocale(LC_MONETARY, 'id_ID');
        $this->load->library('ion_auth');
//        if (!$this->ion_auth->is_admin())
//			{
//				//redirect('auth');
//			}else{
                            $this->output->enable_profiler(TRUE);
//                        }
        
    }

    
    /**
     * pencarian Session $this->cari_session($value, $session_item);
     * By Reko Srowako
     */
    public function cari_session($value, $session_item){
        if($value){
            $this->session->set_userdata($session_item, $value);
            return $value;
        } elseif($this->session->userdata($session_item)){
            $value = $this->session->userdata($session_item);
            return $value;
        } else {
            $value ='';
            return $value;
        }
    }
    
    
    
    
    
}
if(!function_exists('create_breadcrumb'))
{
    function create_breadcrumb()
    {
        $ci = &get_instance();
        $i=1;
        $uri = $ci->uri->segment($i);
        $link = '<ol class="breadcrumb">';
        
        while($uri != '')
        {
            $prep_link = '';
            
            for($j=1; $j<=$i;$j++)
            {
                $prep_link .= $ci->uri->segment($j).'/';
            }

            if($ci->uri->segment($i+1) == '')
            {
                //$link.='<li><a href="'.site_url($prep_link).'"><b>';
                $link.='<li><b>';
                $link.=set_label($ci->uri->segment($i) ).'</b></li> ';
            }
            else
            {
                $link.='<li><a href="'.site_url($prep_link).'"> <i class="fa fa-home"></i> ';
                $link.= set_label($ci->uri->segment($i) ).'</a></li> ';
            }

            $i++;
            $uri = $ci->uri->segment($i);
        }
        
        $link .= '</ol>';
        return $link;
    }
}
if(!function_exists('set_label'))
{
    function set_label($text = NULL)
    {
        if($text)
        {
            $label = preg_replace('/_id$/', '', $text);
            $label = str_replace('_', ' ', $label);
            $label = ucwords($label);
        }
        else
        {
            $label = '';
        }
        
        return $label;
    }

}

if(!function_exists('notify'))
{
    function notify($msg,$type = 'info',$judul = '') 
    {
        $tpl = '';
        switch ($type)
        {
            case 'info' :
                $tpl  = '<div class="alert  alert-info fade">';
                break;
            
            case 'success' :
                $tpl  = '<div class="alert  alert-success fade">';
                break;
            
            case 'warning' :
                $tpl  = '<div class="alert  alert-warning fade">';
                break;
            
            case 'danger' :
                $tpl  = '<div class="alert  alert-danger fade">';
                break;
            default :
                 $tpl  = '<div class="alert  alert-info fade>';
                break;                
        }
        
        
        $tpl .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $tpl .= '<strong> '. (trim($judul) !='' ? ucwords($judul) : ucwords($type)) .' ! </strong> ' . $msg;
        $tpl .= '<script>
                
                $(document).ready(function(){
                     $(".alert").delay(4000).addClass("in").fadeOut("slow");
                });
                
                </script>';
        $tpl .= '</div>';
        
        return $tpl;
    }
}