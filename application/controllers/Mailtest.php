<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailtest extends MY_Controller
{

    public function index()
    {
        $this->load->library('email');
	$this->email->from('alex@cubicroot.xyz', 'Your Name');
$this->email->to('mail@alexander-ebhart.de');
 
$this->email->subject('Email Test');
$this->email->message('Testing the email class.');
$this->email->send();

echo $this->email->print_debugger(array('headers'));
    }
}
