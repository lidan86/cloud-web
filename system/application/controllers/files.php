<?php
/**
 * XtraUpload
 *
 * A turn-key open source web 2.0 PHP file uploading package requiring PHP v5
 *
 * @package		XtraUpload
 * @author		Matthew Glinski
 * @copyright	Copyright (c) 2006, XtraFile.com
 * @license		http://xtrafile.com/docs/license
 * @link		http://xtrafile.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * XtraUpload Files Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Files extends Controller 
{
	// Lets the files->downloadFail() function know if the download completed
	private $downloadComplete = false;
	
	public function Files()
	{
		parent::Controller();	
		$this->lang->load('files');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->get()
	 *
	 * The file download geteway page, file info, wait time, and captcha test are served here
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	none
	 */
	 public function index()
	 {
	 	redirect('home');
	 }
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->get()
	 *
	 * The file download geteway page, file info, wait time, and captcha test are served here
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	none
	 */
	public function get($id='', $name='', $error='')
	{
		// check for auth string in URL
		$this->_checkForHTTPAuth();
		
		// Get the file object for the requested file	
		$file = $this->files_db->_getFileObject($id);
		
		// If there is no such file found, redirect to 404 error
		if(!isset($file->server) or !$file)
		{
			$this->_send404();
			return;
		}
		
		// Is file Password Protected?
		if(!empty($file->pass) and ($this->input->post('pass') != $file->pass))
		{
			$this->_passPage($file);
			return;
		}
		
		// Get the captcha image if required
		$data['captcha_bool'] = $this->startup->group_config->download_captcha;
		$data['sec'] = intval($this->startup->group_config->wait_time);
		$data['auto_download'] = intval($this->startup->group_config->auto_download);
		
		// Is captcha required?
		if($data['captcha_bool'] == 2)
		{
			// yes, generate a captcha
			$data['captcha'] = $this->_getCaptcha();
		}
		else if($data['captcha_bool'] == 1)
		{
			if($this->session->userdata('captcha_served') == 'true')
			{
				// no, already served a captcha
				$data['captcha'] = '';
				$data['captcha_bool'] = 0;
			}
			else
			{
				// yes, generate a captcha
				$data['captcha'] = $this->_getCaptcha();
			}
		}
		else
		{
			// no captchas are turned off
			$data['captcha'] = '';
		}
		
		// If conditions are right, just download the file :P
		if((!$data['captcha_bool'] and $data['sec'] <= 1 and $data['auto_download']) or ($file->direct and $file->direct_bw > $file->size))
		{
			$link = $this->_genDlink($id, $name, 120);
			$this->_goToDownloadUrl($file, $link);
		}
		
		// Detect if the requested file is an image
		$data['image'] = false;
		if($file->is_image)
		{
			$data['image'] = $this->files_db->getImageLinks($id, $name);
		}
				
		// Setup some variables
		$data['error'] = $error;
		$data['file'] = $file;
		
		// if the user has already waited and just failed
		// the captcha test dont make them wait again
		if($this->input->post('waited'))
		{
			$data['sec'] = 1;
		}
		
		// Send the information to the user
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('files_controller_1').' '.$this->startup->site_config['title_separator'].' '.$name));
		$this->load->view($this->startup->skin.'/files/get', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->gen()
	 *
	 * The file download validation page, if everything checks out the file is downloaded
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	none
	 */
	public function gen($id='', $name='')
	{
		// check if the user submitted a captcha
		if(!$this->input->post('captcha') and ($this->startup->group_config->download_captcha == 2 or ($this->startup->group_config->download_captcha == 1 and !$this->session->userdata('captcha_served'))))
		{
			$error = '<span class="alert">'.$this->lang->line('files_controller_2').'</span>';
			$this->get($id, $name, $error);
			return false;
		}
		
		// Is file Password Protected?
		if(!empty($file->pass) and ($this->input->post('pass') != $file->pass))
		{
			$this->_passPage($file);
			return;
		}
		
		// Captcha validation check
		if($this->startup->group_config->download_captcha == 2 or ($this->startup->group_config->download_captcha == 1 and !$this->session->userdata('captcha_served')))
		{
			// If user submitted CAPTCHA, delete it.
			if($this->session->flashdata('captcha'))
			{
				if(file_exists('temp/'.$this->session->flashdata('captcha')))
				{
					unlink('temp/'.$this->session->flashdata('captcha'));
				}
			}
				
			// Delete old captchas
			$expiration = time()-7200; // Two hour limit
			$this->db->delete('captcha', array('captcha_time <' => $expiration));
			
			// get captcha information from DB
			$query = $this->db->get_where('captcha', array('word' => $this->input->post('captcha'),'ip_address' => $this->input->ip_address(),'captcha_time >' => $expiration));
			$rows = $query->num_rows();
						
			// check if the captcha exists
			if (!$rows)
			{
				$error = '<span class="alert">'.$this->lang->line('files_controller_2').'</span><br />';
				
				$this->get($id, $name, $error);
				return false;
			}
			else
			{
				if($this->startup->group_config->download_captcha == 1)
				{
					if($this->session->userdata('captcha_served') != 'true')
					{
						$this->session->set_userdata('captcha_served', 'true');
					}
				}
				
				$data = array(
					'word' => $this->input->post('captcha'), 
					'ip_address' => $this->input->ip_address(), 
					'captcha_time >' => $expiration
				);
				
				$this->db->delete('captcha', $data);
			}
		}
		$file = $this->files_db->_getFileObject($id);
		
		$link = $this->_genDlink($id, $file->link_name, 60);
		
		// construct final download link
		$this->_goToDownloadUrl($file, $link);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->download()
	 *
	 * Download file if a download link was generated
	 *
	 * @access	public
	 * @return	none
	 */
	public function download($dlink, $name='')
	{
		// did user submit WWW_basic-auth params?
		$this->_checkForHTTPAuth();
		
		$down_link = $this->db->select('time, ip, fid')->get_where('dlinks', array('id' => $dlink));
		
		// Download link does not exists
		if($down_link->num_rows() != 1)
		{
			$this->_send404();
			exit();
		}
		
		// get dlink object
		$dl = $down_link->row();
		
		// File link expired
		if($dl->time < time())
		{
			$this->db->delete('dlinks', array('id' => $dlink));
			$this->_send404();
			exit();
		}
		
		// Not the same user
		if($dl->ip != $this->input->ip_address())
		{
			$this->db->delete('dlinks', array('id' => $dlink));
			$this->_send404();
			exit();
		}
		
		// Send file data and headers to the browser
		$this->_download($dl->fid);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->stream()
	 *
	 * Stream a file for playback, mp3's are currently only supported
	 *
	 * @access	public
	 * @return	none
	 */
	public function stream($fid='', $enc='')
	{
		$file = $this->files_db->getFileObject($fid);
		if(!$file)
		{
			show_404();	
		}
		
		if($enc != md5($this->config->config['encryption_key'].$fid.$this->input->ip_address()))
		{
			show_404();
		}
		
		// get server manager
		$this->load->model('server/server_db');
		
		// let the embed definition see if we can stream, and describe the file transfer speed limit
		$code = $this->xu_api->embed->getEmbedCode($file->type);
		if(is_array($code))
		{
			$serv = $this->server_db->getServerForDownload($file);
			
			if($serv != base_url())
			{
				header("Location: ".$serv.implode('/', $this->uri->segment_array()));
				exit;
			}
			
			$this->_download($file->file_id, $code['speed']);
		}
		else
		{
			show_404();
		}
	}
		
	// ------------------------------------------------------------------------
	
	/**
	 * Files->embed()
	 *
	 * Embed File HTML
	 *
	 * @access	public
	 * @return	none
	 */
	public function embed($type='mp3', $fid='')
	{		
		$file = $this->files_db->getFileObject($fid);
		
		if(file_exists(APPPATH.'views/_protected/files/embed/'.$type.'.php'))
		{
			$this->load->view('_protected/files/embed/'.$type, array('file' => $file));	
		}
		else
		{
			show_404();
		}
	}
		
	// ------------------------------------------------------------------------
	
	/**
	 * Files->manage()
	 *
	 * File management page, logged in users only
	 *
	 * @access	public
	 * @return	none
	 */
	public function manage()
	{
		// Check for logged in user
		$this->functions->checkLogin();
		
		// Load the pagination library
		$this->load->library('pagination');
		
		// Setup some vars
		$data['flashMessage'] = '';
		$perPage = 100;
		
		// Pagination config values
		$config['base_url'] = site_url('files/manage');
		$config['total_rows'] = $this->files_db->getNumfiles();
		$config['per_page'] = $perPage;	
		
		// setup the pagination library
		$this->pagination->initialize($config);
		
		// Get the files object
		$data['files'] = $this->files_db->getFiles($perPage, $this->uri->segment(3), '', true);
		
		// If there was a message generated previously, load it
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		// Create the pagination HTML
		$data['pagination'] = $this->pagination->create_links();

		// Load the static files
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('files_controller_3')));
		$this->load->view($this->startup->skin.'/files/manage', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->manage()
	 *
	 * File management page, logged in users only
	 *
	 * @access	public
	 * @return	none
	 */
	public function search()
	{
		if($this->startup->group_config->can_search)
		{
			$this->load->helper('string');
			
			$data['flashMessage'] = '';
			// If there was a message generated previously, load it
			if($this->session->flashdata('msg'))
			{
				$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
			}
			
			if(!$this->uri->segment(3))
			{
				// Load the static files
				$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('files_controller_3')));
				$this->load->view($this->startup->skin.'/files/search/new', $data);
				$this->load->view($this->startup->skin.'/footer');
				return;
			}
			
			// Load the pagination library
			$this->load->library('pagination');
			$this->load->helper('date');
			
			// Setup some vars
			$perPage = 100;
			
			// Pagination config values
			$config['base_url'] = site_url('files/search/'.$this->uri->segment(3));
			$config['total_rows'] = $this->files_db->searchNumFiles($this->uri->segment(3));
			$config['per_page'] = $perPage;	
			
			$data['num_results'] = $config['total_rows'];
			$data['query'] = $this->uri->segment(3);
			
			if($data['num_results'] == 0)
			{
				$this->session->set_flashdata('msg', 'Your query returned 0 results, please try again.');
				redirect('files/search');
			}
			
			// setup the pagination library
			$this->pagination->initialize($config);
			
			// Get the files object
			$data['files'] = $this->files_db->searchFiles($this->uri->segment(3), $perPage, $this->uri->segment(3), '', true);
			
			// Create the pagination HTML
			$data['pagination'] = $this->pagination->create_links();
	
			// Load the static files
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('files_controller_3')));
			$this->load->view($this->startup->skin.'/files/search/query', $data);
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			show_404();
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->delete()
	 *
	 * File delete page, logged in users only
	 *
	 * @access	public
	 * @return	none
	 */
	public function delete($id, $secid, $name)
	{
		if($this->files_db->fileExists($id, $secid))
		{
			$this->files_db->deleteFile($id, $secid, $name);
			$this->session->set_flashdata('msg', $this->lang->line('files_controller_4'));
			if($this->session->userdata('id'))
			{
				redirect('files/manage');
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			redirect('home');
		}
	}
	
	// ------------------------------------------------------------------------
	
	public function old_redirect()
	{
		$id = $this->uri->segment(2);
		$name = $this->uri->segment(3);
		
		if($name) 
		{
			redirect('files/get/'.$id.'/'.url_title($name));
		}
		else
		{
			redirect('files/get/'.$id);
		}
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Files->_download()
	 *
	 * File Download private function
	 *
	 * @access	private
	 * @param	string
	 * @return	none
	 */
	private function _download($id, $speed=0)
	{
		// Get the file refrence
		$file = $this->files_db->_getFileObject($id, 'file_id, filename, o_filename, size, direct');
				
		// Increment the file downloa count
		$this->files_db->addToDownloads($file->file_id);
		
		// If file exists, send download
		if($file)
		{
			// Load the custom file download library
			$this->load->library('filedownload');
			
			// Function to call if user aborts connection during download
			register_shutdown_function(array('Files', '_downloadFail'), $file);
			
			// Setup config for file download
			$config = array();
			$config['file'] = $file->filename;
			$config['resume'] = true;
			$config['filename'] = $file->o_filename;
			$config['speed'] = intval($this->startup->group_config->speed_limit);
			
			if($speed)
			{
				$config['speed'] = $speed;
			}
			
			// Send the actual file
			$bandwidth = $this->filedownload->send_download($config);
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->_downloadFail()
	 *
	 * Function called if the user aborts the connection prematurely
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	none
	 */
	public function _downloadFail($file)
	{
		$this1 =& get_instance();
		$data = array(
			'file_id' 	=> $file->file_id,
			'user' 		=> $this1->session->userdata('id'),
			'ip' 		=> $this1->input->ip_address(),
			'size' 		=> $file->size,
			'sent' 		=> $this1->filedownload->bandwidth,
			'time' 		=> time()
		);
		
		if($file->direct and !$this1->startup->group_config->auto_download)
		{
			$this1->files_db->editPremiumBandwith($file->file_id, $dl_obj->bandwidth);
		}
		
		$this1->db->insert('downloads', $data);
	}
	
	// ------------------------------------------------------------------------
	
	public function massDelete()
	{
		if($this->input->post('files') and is_array($this->input->post('files')))
		{
			foreach($this->input->post('files') as $id)
			{
				$this->files_db->deleteFileUser($id, $this->session->userdata('id'));
			}
			
			$this->session->set_flashdata('msg', count($this->input->post('files')).' Files(s) have been deleted');
		}
		
		redirect('files/manage');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->_genDlink()
	 *
	 * Generate timed download link
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	none
	 */
	private function _genDlink($id, $name, $time=60, $strean=false)
	{
		$this->db->insert('dlinks', array('fid' => $id, 'name' => $name, 'time' => time()+($time*60), 'ip' => $this->input->ip_address(), 'stream' => $strean));
		return $this->db->insert_id();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->_passPage()
	 *
	 * Function called file is password protected
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	none
	 */
	private function _passPage($file, $error=false)
	{
		// if password was submitted and is incorrect
		if($this->input->post('pass'))
		{
			$error = true;
		}
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('files_controller_5')));
		$this->load->view($this->startup->skin.'/files/pass_protected', array('error' => $error, 'file' => $file));
		$this->load->view($this->startup->skin.'/footer');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->_getCaptcha()
	 *
	 * Function called to generate a captcha image
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	none
	 */
	private function _getCaptcha()
	{
		$this->load->helper('captcha');
		
		$vals = array(
			'img_path'	=> './temp/',
			'word'		=> $this->users->genPass(3, false),
			'img_width'	=> 70,
			'img_height' => 20,
			'img_url'	=> base_url().'temp/',
			'fonts' => array('MyriadWebPro-Bold.ttf')
		);
		
		$cap = create_captcha($vals);
		 
		$data = array(
			'captcha_time'	=> $cap['time'],
			'ip_address'	=> $this->input->ip_address(),
			'word'			=> $cap['word']
		);

		$this->db->insert('captcha', $data);
		$this->session->set_flashdata('captcha', $cap['time'].'.jpg');
		
		return $cap['image'];
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->_send404()
	 *
	 * Function called to send a 404 error on invalid file link
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	none
	 */
	private function _send404()
	{
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('files_controller_6')));
		$this->load->view($this->startup->skin.'/files/404');
		$this->load->view($this->startup->skin.'/footer');
		return;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->_checkForHTTPAuth()
	 *
	 * Login user if they send login info using basic-auth, mostly for download accelerators
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	none
	 */
	public function _checkForHTTPAuth()
	{
		if (!isset($_SERVER['PHP_AUTH_USER'])) 
		{
			return;
		} 
		else 
		{
			$user = $_SERVER['PHP_AUTH_USER'];
			$pass = $_SERVER['PHP_AUTH_PW'];
			if($this->users->processLogin($user, $pass))
			{
				$this->startup->getGroup();
				return;
			}
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Files->_goToDownloadUrl()
	 *
	 * build the correct url for downloading a file and send the visitor to it
	 *
	 * @access	public
	 * @param	object
	 * @param	string
	 * @return	none
	 */
	
	private function _goToDownloadUrl($file, $link)
	{
		$dlink = $file->server;
		if($this->config->config['index_page'] != '')
		{
			$dlink .= $this->config->config['index_page'].'/';
		}
		
		$dlink .= 'files/download/'.$link.'/'.$file->link_name;
		header("Location: ".$dlink);
		exit;
	}
}