<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');

	class Order extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$data['title']='Order history';
			if(isset($_SESSION['u_id'])){
				$data['fullname']=$_SESSION['fullname'];
				if(time()-$_SESSION['lastActive']>300){
					session_destroy();
					echo "<script>alert('Time out, please log in again.');</script>";
					redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/login/main');
				}
				else{
					$_SESSION['lastActive']=time();
					$this->load->view('header1', $data);
					$this->load->view('menu');
					$this->load->view('user_options_list');
				}
			}
			else{
				redirect('http://cs-server.usc.edu:12123/CodeIgniter/index.php/login/main');
			}
		}
		public function show(){
			$u_id=$_SESSION['u_id'];
			$this->load->model('order_model','order');
			$query=$this->order->get_orders($u_id);
			//has order history
			if($query!=0){
				$this->load->view('order_history_header');
				foreach($query as $row){
					$data['o_id']=$row->o_id;
					$data['order_date']=$row->order_date;
					$data['shipping_add']=$row->shipping_add;
					$data['billing_add']=$row->billing_add;
					$this->load->view('order_history_item',$data);
				}
				$this->load->view('order_history_footer');
			}
			//no order history
			else{
				$this->load->view('empty_order_history');
			}
		}

		public function detail(){
			$o_id=$this->input->post('o_id');
			$this->load->model('order_detail_model','order_detail');
			$this->load->model('products_model','products');
			$this->load->view('order_detail_header');
			$data['amount']=0;
			$query=$this->order_detail->select($o_id);
			foreach($query as $row){
				$p_id=$row->p_id;
				$data['size']=$row->size;
				$data['price']=$row->price;
				$data['quantity']=$row->quantity;
				$data['image']=$this->products->get_image($p_id);
				$data['name']=$this->products->get_name($p_id);
				$data['total']=number_format($data['price']*$data['quantity'],'2') ;
				$data['amount']=number_format($data['amount']+$data['total'],'2');
				$this->load->view('order_detail_item',$data);
			}
			$this->load->view('order_detail_footer',$data);

		}
	}
?>