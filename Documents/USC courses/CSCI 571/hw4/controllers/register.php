<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Register extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$data['title']='Register';
			$this->load->view('header0', $data);
			$this->load->view('menu');
		}

		public function main($msg=NULL){
			$data['msg']=$msg;
			$this->load->view('register_view',$data);
			$this->load->view('footer');
		}
		public function process(){
			$fullname = $this->security->xss_clean($this->input->post('fullname'));
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));
			$con_password = $this->security->xss_clean($this->input->post('con_password'));
			//check empty
			if($fullname==''||$email==''||$password==''||$con_password==''){
				$msg='Please fill all of fields.';
				$this->main($msg);
			}
			//check password
			elseif($password!=$con_password){
				$msg='Password do not match, please check again.';
				$this->main($msg);
			}
			//check email format
        	elseif ( !preg_match("/.+\@.+\..+/", $email) ) {
		        $msg='Please input a valid email address.';
		        $this->main($msg);
		    } 
			//check email exist
			else{
				$data['email']=$email;
				$this->load->model('users_model','users');
				$check=$this->users->check_email($data);
				//email has existed
				if($check==1){
					$msg='This email has existed, please change one.';
					$this->main($msg);
				}
				//pass all validation
				else{
					$data['fullname']=$fullname;
					$data['email']=$email;
					$data['password']=$password;
					$result=$this->users->insert($data);
					//insert fail
					if($result==''){
						$msg='Register failed, please try again.';
						$this->main($msg);
					}
					//insert succeed
					else{
						$data['user']=$this->users->login($email,$password);

						if($data['user']==0){
							$msg='Register failed, please try again.';
							$this->main($msg);
						}
						//save user info to session
						else{
							foreach($data['user'] as $row){
								$u_id=$row->u_id;
								$fullname=$row->fullname;
								$data['fullname']=$fullname;
								$_SESSION['fullname']=$fullname;
								$_SESSION['u_id']=$u_id;
								$_SESSION['lastActive']=time();
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
							
							// redirect("http://cs-server.usc.edu:12123/CodeIgniter/index.php/products/show_products_by_category/1");
						}
					}
				}
			}
		}
	}
?>