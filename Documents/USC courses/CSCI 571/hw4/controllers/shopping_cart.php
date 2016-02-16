<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Shopping_cart extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$data['title']='Shopping cart';
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
					$this->load->view('menu');
					$this->load->view('user_options_list');
				}
			}
			else{
				$this->load->view('header0',$data);
				$this->load->view('menu');
			}
			
		}

		public function show(){
			//not log in
			if(!isset($_SESSION['u_id'])){
				if(!isset($_SESSION['shopping_cart'])){
					$this->load->view('empty_cart_view');
				}
				else{
					$this->load->model('products_model','products');
					$this->load->model('product_size_model','product_size');
					$this->load->view('shopping_cart_header');
					$this->load->model('specialsales_model','special');
					$data['amount']=0;
					$num=$_SESSION['max'];
					while($num>0){
						$d=isset($_SESSION['shopping_cart'][$num]['p_id']);
						if($d){
							$p_id=$_SESSION['shopping_cart'][$num]['p_id'];
							$ps_id=$_SESSION['shopping_cart'][$num]['ps_id'];
							$quantity=$_SESSION['shopping_cart'][$num]['quantity'];
							$image=$this->products->get_image($p_id);
							$name=$this->products->get_name($p_id);
							$size=$this->product_size->get_size($ps_id);
							$price=$this->product_size->get_price($ps_id);
							//check special
							$result=$this->special->select($p_id);
							if($result!=0){
								//special
								foreach($result as $row){
									$discount=$row->discount;
								}
								$price=$price-$price*$discount;
								$price=number_format($price,'2');
							}
							$data['p_id']=$p_id;
							$data['ps_id']=$ps_id;
							$data['image']=$image;
							$data['name']=$name;
							$data['size']=$size;
							$data['price']=$price;
							$data['quantity']=$quantity;
							$data['amount']=number_format($data['amount']+$price*$quantity,'2');
							$num=$num-1;
							$this->load->view('shopping_cart_item',$data);
						}
					}
					$this->load->view('shopping_cart_footer');
				}
			}
			// logged in
			else{
				$this->load->model('shopping_cart_model','shopping_cart');
				$data['number']=$this->shopping_cart->number($_SESSION['u_id']);
				if($data['number']==0){
					$this->load->view('empty_cart_view');
				}
				else{
					$this->load->model('products_model','products');
					$this->load->model('product_size_model','product_size');
					$this->load->model('shopping_cart_model','shopping_cart');
					$this->load->model('specialsales_model','special');
					$this->load->view('shopping_cart_header');
					$u_id=$_SESSION['u_id'];
					$data['amount']=0;
					$data['result']=$this->shopping_cart->select($u_id);
					foreach($data['result'] as $row){
						$data['p_id']=$row->p_id;
						$data['ps_id']=$row->ps_id;
						$data['quantity']=$row->quantity;
						$data['image']=$this->products->get_image($data['p_id']);
						$data['name']=$this->products->get_name($data['p_id']);
						$data['size']=$this->product_size->get_size($data['ps_id']);
						$data['price']=$this->product_size->get_price($data['ps_id']);
						//check special
							$result=$this->special->select($data['p_id']);
							if($result!=0){
								//special
								foreach($result as $row){
									$discount=$row->discount;
								}
								$data['price']=$data['price']-$data['price']*$discount;
								$data['price']=number_format($data['price'],'2');
							}
						$data['amount']=number_format($data['amount']+$data['price']*$data['quantity'],'2');
						$this->load->view('shopping_cart_item',$data);
					}
					$this->load->view('shopping_cart_footer');
				}	
			}
		}
		public function edit(){
			//continue shopping
			$option=$this->input->post('submit');
			if($option=='continue shopping'){
				redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/products/show_products_by_category/1');
			}
			//user has logged in
			if(isset($_SESSION['u_id'])){
				$data['u_id']=$_SESSION['u_id'];
				$data['p_id']=$this->input->post('p_id');
				$this->load->model('shopping_cart_model','shopping_cart');
				
				if($option=='empty'){
					$check=$this->shopping_cart->empty_cart($data['u_id']);
					if($check=1){
						$this->show();
					}
					else{
						echo "<script>alert('Operation failed!');</script>";
					}
				}
				if($option=='delete'){
					$u_id=$data['u_id'];
					$p_id=$data['p_id'];

					if($p_id!=''){
						$check=$this->shopping_cart->delete_item($u_id,$p_id);
						if($check=1){
							$this->show();
						}
						else{
							echo "<script>alert('Operation failed!');</script>";
						}
					}
					else{
						echo "<script>alert('Please select one item first!');</script>";
						$this->show();
					}
				}
				if($option=='edit'){
					$u_id=$data['u_id'];
					$p_id=$data['p_id'];
					if($p_id!=''){
						redirect("http://cs-server.usc.edu:12123/CodeIgniter/index.php/edit_product/main/$p_id");
					}
					else{
						echo "<script>alert('Please select one item first!');</script>";
						$this->show();
					}
				}
				if($option=='check out'){
					redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/checkout/main');
				}
			}
			//not log in
			if(!isset($_SESSION['u_id'])){
				if($option=='empty'){
					unset($_SESSION['shopping_cart']);
					// unset($_SESSION['recommend']);
					$this->show();
				}
				if($option=='delete'){
					$p_id=$this->input->post('p_id');
					if($p_id==''){
						echo "<script>alert('Please select one item first!');</script>";
						$this->show();	
					}
					else{
						$num=$_SESSION['max'];
						$_SESSION['count']=$_SESSION['count']-1;
						while($num>0){
							if(($_SESSION['shopping_cart'][$num]['p_id']!='')&&$_SESSION['shopping_cart'][$num]['p_id']==$p_id){
								unset($_SESSION['shopping_cart'][$num]);
							}
							$num=$num-1;
						}
						if($_SESSION['count']==0){
							unset($_SESSION['shopping_cart']);
						}
						$this->show();
					}
				}
				if($option=='edit'){
					$p_id=$this->input->post('p_id');
					if($p_id==''){
						echo "<script>alert('Please select one item first!');</script>";
						$this->show();	
					}
					else{
						redirect("http://cs-server.usc.edu:12123/CodeIgniter/index.php/edit_product/main/$p_id");
					}
				}
				if($option=='check out'){
					$_SESSION['back']=1;
					redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/login/main');
				}
			}//end else
		}//end function edit
	}//end class
?>