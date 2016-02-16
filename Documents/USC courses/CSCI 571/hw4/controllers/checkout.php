<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Checkout extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$data['title']='Check out';
			if(isset($_SESSION['u_id'])){
				$data['fullname']=$_SESSION['fullname'];
				if(time()-$_SESSION['lastActive']>300){
					session_destroy();
					echo "<script>alert('Time out, please log in again.');</script>";
					redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/home');
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

		public function main(){
			// logged in
			if(isset($_SESSION['u_id'])){
				$u_id=$_SESSION['u_id'];
				$this->load->model('order_model','order');
				$this->load->model('address_model','address');
				$this->load->view('user_options_list');
				$check=$this->address->number($u_id);
				//let user insert address
				if($check==0){
					$this->load->view('add_address_view');
				}
				//let user select address
				else{
					$data['result']=$this->address->select($u_id);
					$this->load->view('shipping_add_view',$data);
					$this->load->view('billing_add_view');
					$this->load->view('card_info_view');
				}
			}
			//not log in
			else{
				redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/login/main');
			}
		}
		public function validate_add(){
			$fullname = $this->security->xss_clean($this->input->post('fullname'));
			$address = $this->security->xss_clean($this->input->post('address'));
			$city = $this->security->xss_clean($this->input->post('city'));
			$state = $this->security->xss_clean($this->input->post('state'));
			$zipcode = $this->security->xss_clean($this->input->post('zipcode'));
			$phone = $this->security->xss_clean($this->input->post('phone'));
			//validate fullname
			if(is_numeric($fullname)){
				echo "<script>alert('Please input a valid fullname.');</script>";
				$this->main();
			}
			//validate city
			elseif(is_numeric($city)){
				echo "<script>alert('Please input a valid city name.');</script>";
				$this->main();
			}
			//validate state
			elseif(is_numeric($state)){
				echo "<script>alert('Please input a valid state name.');</script>";
				$this->main();
			}
			//validate zipcode
			elseif(!is_numeric($zipcode)||strlen($zipcode)!=5){
				echo "<script>alert('Zipcode should be only 5 digits, please check it again.');</script>";
				$this->main();
			}
			// //validate phone
			elseif(!is_numeric($phone)||strlen($phone)!=10){
				echo "<script>alert('Phone number should be only 10 digits, please check it again.');</script>";
				$this->main();
			}
			//pass all validation
			else{
				$u_id=$_SESSION['u_id'];
				$this->load->model('address_model','address');
				$result=$this->address->insert($fullname,$address,$city,$state,$zipcode,$phone,$u_id);
				if($result==1){
					//succeed
					$this->main();
				}
				else{
					//failed
					$this->main();
				}
			}
		}
		public function validate_card(){
			$shipping_add=$this->input->post('shipping_add');
			$billing_add=$this->input->post('billing_add');
			$card_number=$this->security->xss_clean($this->input->post('card_number'));
			$cvv_number=$this->security->xss_clean($this->input->post('cvv_number'));
			//validate shipping add
			if($shipping_add==''){
				echo "<script>alert('Please select a shipping address.');</script>";
				$this->main();
			}
			//validate billing add
			elseif($billing_add==''){
				echo "<script>alert('Please select a billing address.');</script>";
				$this->main();
			}
			//validate card_number
			elseif(!is_numeric($card_number)||strlen($card_number)!=16){
				echo "<script>alert('Please input a valid card number (16 digits only).');</script>";
				$this->main();
			}
			//validate cvv_number
			elseif(!is_numeric($cvv_number)||strlen($cvv_number)!=3){
				echo "<script>alert('Please input a valid cvv number (3 digits only).');</script>";
				$this->main();
			}
			//all validation pass
			else{
				$u_id=$_SESSION['u_id'];
				$order_date=date('Y-m-d H:i:s');
				$this->load->model('shopping_cart_model','shopping_cart');
				$this->load->model('order_model','order');
				$this->load->model('order_detail_model','order_detail');
				$this->load->model('product_size_model','product_size');
				$this->load->model('specialsales_model','special');
				$new_order=$this->order->insert($u_id,$shipping_add,$billing_add,$order_date);
				if($new_order==1){
					//insert order succeed
					//get o_id
					$query=$this->order->get_order_id($u_id,$order_date);
					if($query!=0){
						//has o_id
						foreach ($query as $row){
							$o_id=$row->o_id;
						}
						//insert order_detail
						//step1:get items in shopping_cart
						$query=$this->shopping_cart->select($u_id);
						if($query!=0){
							//not empty
							foreach($query as $row){
								$p_id=$row->p_id;
								$ps_id=$row->ps_id;
								$quantity=$row->quantity;
								$size=$this->product_size->get_size($ps_id);
								$price=$this->product_size->get_price($ps_id);
								//check specialsale
								$result=$this->special->select($p_id);
								if($result!=0){
									foreach($result as $s){
										$discount=$s->discount;
									}
									$price=$price-$price*$discount;
									$price=number_format($price,'2');
								}
								//step2:insert items into order_details
								$result=$this->order_detail->insert($o_id,$p_id,$size,$price,$quantity);
							}
							$this->shopping_cart->empty_cart($u_id);
							redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/order/show');
						}
						else{
							//empty cart
							echo 'shopping cart is empty';
						}
					}
					else{
						//not get o_id
						echo 'get_oid failed';
					}
				}
				else{
					//insert failed
					echo 'insert failed';

				}
			}
		}
	}
?>