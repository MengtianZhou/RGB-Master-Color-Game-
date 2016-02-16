<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	
	class Products extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$data['title']='Products';
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
		
		public function show_products_by_category($pc_id){
			
			$this->load->model('product_category_model','categories');
			$this->load->model('products_model','products');
			$this->load->model('specialsales_model','specialsales');
			$data['categories']=$this->categories->get_categories();
			$data['products']=$this->products->get_products_by_category($pc_id);
			$data['specialsales']=$this->specialsales->get_specialsales_by_category($pc_id);
			$this->load->view('categories_list',$data);
			$this->load->view('specialsales_show');
			$this->load->view('products_view');
			$this->load->view('footer');
		}

	}
?>