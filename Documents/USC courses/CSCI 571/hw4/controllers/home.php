<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Home extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$data['title']='Home';
			if(isset($_SESSION['u_id'])){
				$data['fullname']=$_SESSION['fullname'];
				if(time()-$_SESSION['lastActive']>300){
					session_destroy();
					echo "<script>alert('Time out, please log in again.');</script>";
					$this->load->view('header0',$data);
				}
				else{
					$_SESSION['lastActive']=time();
					$this->load->view('header1', $data);
				}
			}
			else{
				$this->load->view('header0',$data);
			}
			$this->load->view('menu');
		}

		public function index(){
			
			$this->load->view('home_view');
			$this->load->view('footer');
		}
	}
?>