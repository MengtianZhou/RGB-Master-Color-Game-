<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Edit_product extends CI_Controller{

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
				}
			}
			else{
				$this->load->view('header0',$data);
			}
			$this->load->view('menu');
		}
		public function main($p_id){
			$this->load->model('products_model','products');
			$this->load->model('product_size_model','size');
			$this->load->model('specialsales_model','special');
			$data['product']=$this->products->get_product_by_id($p_id);
			$data['size']=$this->size->get_sizes();
			$data['special']=$this->special->select($p_id);
			if($data['special']==0){
				//normal item
				$this->load->view('edit_product_view',$data);
			}
			else{
				//special item
				$this->load->view('edit_product_view2',$data);
			}
			$this->load->view('footer');
		}
		public function validate(){
			$p_id=$this->input->post('p_id');
			$ps_id=$this->input->post('ps_id');
			$quantity=$this->input->post('quantity');
			if($ps_id==''){
				echo "<script>alert('Please select a size.');</script>";
				$this->main($p_id);
			}
			elseif(!is_numeric($quantity)){
				echo "<script>alert('Please input valid quantity number.');</script>";
				$this->main($p_id);
			}
			else{
				$this->update_product($p_id,$ps_id,$quantity);
			}
		}
		public function update_product($p_id,$ps_id,$quantity){
			//user has logged in
			if(isset($_SESSION['u_id'])){
				$this->load->model('shopping_cart_model','shopping_cart');
				$u_id=$_SESSION['u_id'];
				$result=$this->shopping_cart->update_item($u_id,$p_id,$ps_id,$quantity);
				//update faild
				if($result==0){
					echo "<script>alert('Update item failed.');</script>";
					$this->main($p_id);
				}
				else{
					// echo "<script>alert('Update item succeed.');</script>";
					redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/shopping_cart/show');
				}
			}
			//user has not logged in
			else{
				$num=$_SESSION['max'];
				while($num>0){
					$d=isset($_SESSION['shopping_cart'][$num]['p_id']);
					if($d){
						if($_SESSION['shopping_cart'][$num]['p_id']==$p_id){
							$_SESSION['shopping_cart'][$num]['ps_id']=$ps_id;
							$_SESSION['shopping_cart'][$num]['quantity']=$quantity;
						}		
					}
					$num=$num-1;
				}//end while
				redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/shopping_cart/show');
			}
		}
	}
?>