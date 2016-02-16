<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Login extends CI_Controller{
		public function __construct(){
			parent::__construct();
		}

		public function main($msg=NULL){
			$data['title']='Login';
			$data['msg']=$msg;
			$this->load->view('header0', $data);
			$this->load->view('menu');
			$this->load->view('login_view');
			$this->load->view('footer');
		}
		public function process(){
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));
			$this->load->model('users_model','users');
			$data['user']=$this->users->login($email,$password);
			if($email==''||$password==''){
				$msg='Invalid log in, please try again!';
				$this->main($msg);
			}
			elseif($data['user']==0){
				$msg='Invalid log in, please try again!';
				$this->main($msg);
			}
			else{
				foreach($data['user'] as $row){
					$u_id=$row->u_id;
					$fullname=$row->fullname;
					$time=time();
					$data['fullname']=$fullname;
					$_SESSION['u_id']=$u_id;
					$_SESSION['fullname']=$fullname;
					$_SESSION['lastActive']=$time;
				}
				if(isset($_SESSION['back'])){
					$u_id=$_SESSION['u_id'];
					$num=$_SESSION['max'];
					while($num>0){
						$d=isset($_SESSION['shopping_cart'][$num]['p_id']);
						if($d){
							$p_id=$_SESSION['shopping_cart'][$num]['p_id'];
							$ps_id=$_SESSION['shopping_cart'][$num]['ps_id'];
							$quantity=$_SESSION['shopping_cart'][$num]['quantity'];
							$this->load->model('shopping_cart_model','shopping_cart');
							$result=$this->shopping_cart->insert($u_id,$p_id,$ps_id,$quantity);
						}
						$num=$num-1;
					}//end while
					unset($_SESSION['shopping_cart']);
					redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/checkout/main');
				}
				else{
					redirect("http://cs-server.usc.edu:12123/CodeIgniter/index.php/products/show_products_by_category/1");
				}
				
			}

		}
	}
?>