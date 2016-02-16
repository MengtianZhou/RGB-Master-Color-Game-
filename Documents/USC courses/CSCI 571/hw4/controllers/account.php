<?php session_start();if(!defined('BASEPATH')) exit ('No direct script access allowed');
	class Account extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$data['title']='Account';
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
			$this->load->model('users_model','users');
			$this->load->model('address_model','address');
			$u_id=$_SESSION['u_id'];
			//get fullname and email
			$user_info=$this->users->get_profile($u_id);
			foreach($user_info as $row){
				$data['fullname']=$row->fullname;
				$data['email']=$row->email;
			}
			$this->load->view('profile_view',$data);
			//check address
			$check=$this->address->number($u_id);
			//let user insert address
			if($check==0){
				$this->load->view('empty_address_view');
			}
			//let user select address
			else{
				$data['result']=$this->address->select($u_id);
				$this->load->view('address_view',$data);
			}
		}
		public function edit_profile($msg=NULL){
			$data['msg']=$msg;
			$this->load->model('users_model','users');
			$u_id=$_SESSION['u_id'];
			//get fullname and email
			$user_info=$this->users->get_profile($u_id);
			foreach($user_info as $row){
				$data['fullname']=$row->fullname;
				$data['email']=$row->email;
				$data['password']=$row->password;
			}
			$this->load->view('edit_profile_view',$data);
		}
		public function validate_profile(){
			$fullname=$this->security->xss_clean($this->input->post('fullname'));
			$email=$this->security->xss_clean($this->input->post('email'));
			$password=$this->security->xss_clean($this->input->post('password'));
			if($fullname==''||$email==''||$password==''){
				$msg='Please input all of fields.';
				$this->edit_profile($msg);
			}
			elseif(is_numeric($fullname)){
				echo "<script>alert('Please input a valid fullname.');</script>";
				$msg='Please input a valid fullname';
				$this->edit_profile($msg);
			}//check email format
        	elseif ( !preg_match("/.+\@.+\..+/", $email) ) {
		        $msg='Please input a valid email address.';
		        $this->edit_profile($msg);
		    }
			
			else{
				$this->update_profile($fullname,$email,$password);
			}
		}
		public function update_profile($fullname,$email,$password){
			$u_id=$_SESSION['u_id'];
			$this->load->model('users_model','users');
			$result=$this->users->update($u_id,$fullname,$email,$password);
			if($result==1){
				//update succeed
				// echo "<script>alert('Update succeed.');</script>";
				$this->show();
			}
			else{
				echo "failed";
			}
		}
		public function add_address($msg=NULL){
			$data['msg']=$msg;
			$this->load->view('add_address_view2',$data);
		}
		public function validate_add(){
			$fullname = $this->security->xss_clean($this->input->post('fullname'));
			$address = $this->security->xss_clean($this->input->post('address'));
			$city = $this->security->xss_clean($this->input->post('city'));
			$state = $this->security->xss_clean($this->input->post('state'));
			$zipcode = $this->security->xss_clean($this->input->post('zipcode'));
			$phone = $this->security->xss_clean($this->input->post('phone'));
			if($fullname==''||$address==''||$city==''||$state==''||$zipcode==''||$phone==''){
				$msg="Please input all of fields.";
				$this->add_address($msg);
			}
			//validate fullname
			elseif(is_numeric($fullname)){
				echo "<script>alert('Please input a valid fullname.');</script>";
				$msg='Please input a valid fullname.';
				$this->add_address($msg);
			}
			//validate city
			elseif(is_numeric($city)){
				echo "<script>alert('Please input a valid city name.');</script>";
				$msg='Please input a valid city name.';
				$this->add_address($msg);
			}
			//validate state
			elseif(is_numeric($state)){
				echo "<script>alert('Please input a valid state name.');</script>";
				$msg='Please input a valid state name.';
				$this->add_address($msg);
			}
			//validate zipcode
			elseif(!is_numeric($zipcode)||strlen($zipcode)!=5){
				echo "<script>alert('Zipcode should be only 5 digits, please check it again.');</script>";
				$msg='Please input a valid zipcode.';
				$this->add_address($msg);
			}
			// //validate phone
			elseif(!is_numeric($phone)||strlen($phone)!=10){
				echo "<script>alert('Phone number should be only 10 digits, please check it again.');</script>";
				$msg='Please input a valid phone number.';
				$this->add_address($msg);
			}
			//pass all validation
			else{
				$u_id=$_SESSION['u_id'];
				$this->load->model('address_model','address');
				$result=$this->address->insert($fullname,$address,$city,$state,$zipcode,$phone,$u_id);
				if($result==1){
					//succeed
					$this->show();
				}
				else{
					//failed
					$this->add_address();
				}
			}
		}
		public function edit_address(){
			$this->load->model('address_model','address');
			$u_id=$_SESSION['u_id'];
			$check=$this->address->number($u_id);
			if($check==0){
				//no address
				$this->load->view('empty_address_view');
			}
			else{
				$this->load->view('edit_address_header');
				$result=$this->address->select($u_id);
				$data['num']=1;
				foreach($result as $row){
					$data['add_id']=$row->add_id;
					$data['fullname']=$row->fullname;
					$data['address']=$row->address;
					$data['city']=$row->city;
					$data['state']=$row->state;
					$data['zipcode']=$row->zipcode;
					$data['phone']=$row->phone;
					$this->load->view('edit_address_item',$data);
					$data['num']=$data['num']+1;
				}
				$this->load->view('edit_address_footer');
			}
		}
		public function edit_selected_add(){
			$add_id=$this->input->post('add_id');
			$edit=$this->input->post('edit');
			$delete=$this->input->post('delete');
			$this->load->model('address_model','address');
			if($add_id==''){
				echo "<script>alert('Please select an address.');</script>";
				$this->edit_address();
			}
			elseif($edit!=''){
				$data['result']=$this->address->select_by_id($add_id);
				$this->load->view('update_add_view',$data);
			}
			elseif($delete!=''){
				$result=$this->address->delete_add($add_id);
				if($result==1){
					$u_id=$_SESSION['u_id'];
					$check=$this->address->number($u_id);
					if($check==0){
						//delete all address
						$this->load->view('empty_address_view');
					}
					else{
						$this->edit_address();
					}
				}
				else{
					echo "failed";
				}
			}
		}

		

		public function validate_add2(){
			$add_id=$this->input->post('add_id');
			$fullname = $this->security->xss_clean($this->input->post('fullname'));
			$address = $this->security->xss_clean($this->input->post('address'));
			$city = $this->security->xss_clean($this->input->post('city'));
			$state = $this->security->xss_clean($this->input->post('state'));
			$zipcode = $this->security->xss_clean($this->input->post('zipcode'));
			$phone = $this->security->xss_clean($this->input->post('phone'));
			$this->load->model('address_model','address');
			//validate fullname
			if(is_numeric($fullname)||$fullname==''){
				echo "<script>alert('Please input a valid fullname.');</script>";
				$data['result']=$this->address->select_by_id($add_id);
				$this->load->view('update_add_view',$data);
			}
			//validate city
			elseif(is_numeric($city)||$city==''){
				echo "<script>alert('Please input a valid city name.');</script>";
				$data['result']=$this->address->select_by_id($add_id);
				$this->load->view('update_add_view',$data);
			}
			//validate state
			elseif(is_numeric($state)||$state==''){
				echo "<script>alert('Please input a valid state name.');</script>";
				$data['result']=$this->address->select_by_id($add_id);
				$this->load->view('update_add_view',$data);
			}
			//validate zipcode
			elseif(!is_numeric($zipcode)||strlen($zipcode)!=5){
				echo "<script>alert('Zipcode should be only 5 digits, please check it again.');</script>";
				$data['result']=$this->address->select_by_id($add_id);
				$this->load->view('update_add_view',$data);
			}
			// //validate phone
			elseif(!is_numeric($phone)||strlen($phone)!=10){
				echo "<script>alert('Phone number should be only 10 digits, please check it again.');</script>";
				$data['result']=$this->address->select_by_id($add_id);
				$this->load->view('update_add_view',$data);
			}
			//pass all validation
			else{
				$result=$this->address->update($add_id,$fullname,$address,$city,$state,$zipcode,$phone);
				if($result==1){
					//succeed
					$this->show();
				}
				else{
					//failed
					$data['result']=$this->address->select_by_id($add_id);
					$this->load->view('update_add_view',$data);
				}
			}
		}
	}
?>