<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mine_Controller extends CI_Controller {

	public function load_page($content = "", $data = NULL) {
		$page['header'] = $this->load->view('Templates/header', $data, TRUE) ;
		if ($content != "") {
			$page['content'] = $this->load->view(@$content, $data, TRUE) ;
		}
		$page['footer'] = $this->load->view('Templates/footer', $data, TRUE) ;

		$this->load->view('Templates/master', $page);
	}

	public function send_mail() {
		// $ci = get_instance();
        $this->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "zdiezzystark@gmail.com";
        $config['smtp_pass'] = "stark1998";
		// $config['charset'] = "iso-8859-1";
		// $config['smtp_crypto'] = "SSL";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $this->email->initialize($config);
 
        $this->email->from('ujangbroh99@gmail.com', 'Naufal Akmal');
        $list = array('nur321rohman@gmail.com');
        $this->email->to($list);
        $this->email->subject('TESTING');
        $this->email->message('Ya Ngetest,<br>Santai Aja !!!');
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
	}

}
