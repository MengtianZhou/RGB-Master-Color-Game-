<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Logout extends CI_Controller{
		public function __construct(){
			parent::__construct();
		}
		public function index(){
			session_destroy();
			redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/home');
		}
	}
?>