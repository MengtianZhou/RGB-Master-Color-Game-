<?php session_start();if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Product_detail extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$data['title']='Product detail';
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

		public function show_product_by_id($p_id){

			$this->load->model('products_model','products');
			$this->load->model('product_size_model','size');
			$this->load->model('specialsales_model','special');
			$data['product']=$this->products->get_product_by_id($p_id);
			$data['size']=$this->size->get_sizes();
			$data['special']=$this->special->select($p_id);
			if($data['special']==0){
				//normal item
				$this->load->view('product_detail_view',$data);
			}
			else{
				//special item
				$this->load->view('product_detail_view2',$data);
			}
			$this->load->view('footer');
		}

		public function add($p_id,$ps_id,$quantity){
			//user has logged in
			if(isset($_SESSION['u_id'])){
				$this->load->model('shopping_cart_model','shopping_cart');
				$u_id=$_SESSION['u_id'];
				$result=$this->shopping_cart->insert($u_id,$p_id,$ps_id,$quantity);
				//add faild
				if($result==''){
					echo "<script>alert('Add item failed.');</script>";
					$this->show_product_by_id($p_id);
				}
				else{
					// echo "<script>alert('Add item succeed.');</script>";
					redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/shopping_cart/show');
				}
			}
			//user has not logged in
			else{
				//add first item, create temp shopping_cart
				if(!isset($_SESSION['shopping_cart'])){
					$_SESSION['num']=1;
					$_SESSION['max']=1;
					$_SESSION['shopping_cart']=array();
				}
				else{
					$_SESSION['num']=$_SESSION['num']+1;
					$_SESSION['max']=$_SESSION['max']+1;
				}
				$_SESSION['count']=$_SESSION['max'];
				$_SESSION['shopping_cart'][$_SESSION['num']]['p_id']=$p_id;
				$_SESSION['shopping_cart'][$_SESSION['num']]['ps_id']=$ps_id;
				$_SESSION['shopping_cart'][$_SESSION['num']]['quantity']=$quantity;
				redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/shopping_cart/show');
			}
		}


		public function validate(){
			$p_id=$this->input->post('p_id');
			$ps_id=$this->input->post('ps_id');
			$quantity=$this->input->post('quantity');
			if($ps_id==''){
				echo "<script>alert('Please select a size.');</script>";
				$this->show_product_by_id($p_id);
			}
			elseif(!is_numeric($quantity)){
				echo "<script>alert('Please input valid quantity number.');</script>";
				$this->show_product_by_id($p_id);
			}
			else{
				$this->add($p_id,$ps_id,$quantity);
			}
		}
		// public function get_price($ps_id){
		// 	$this->load->model('product_size_model','ps');
		// 	$data['price']=$this->ps->get_price($ps_id);
		// 	echo $data['price'];
		// 	// $this->load->view('price_view',$data);
		// }
	}
?>