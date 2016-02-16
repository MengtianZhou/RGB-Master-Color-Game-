<?php
	class Users_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function login($email,$password){
			$sql='SELECT * FROM users WHERE email=? AND password=?';
			$query=$this->db->query($sql,array($email,$password));
			if($query->num_rows()==1){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function check_email($email){
			$sql='SELECT * FROM users WHERE email=?';
			$query=$this->db->query($sql,$email);
			return $query->num_rows();
		}

		public function get_profile($u_id){
			$sql='SELECT * FROM users WHERE u_id=?';
			$query = $this->db->query($sql,$u_id);
			return $query->result();
		}
		public function insert($row){
			$fullname=$row['fullname'];
			$email=$row['email'];
			$password=$row['password'];

			$data=array('fullname'=>$fullname,'email'=>$email, 'password'=>$password);
			$result=$this->db->insert('users',$data);
			return $result;
		}
		public function update($u_id,$fullname,$email,$password){
			$data=array('fullname'=>$fullname,'email'=>$email,'password'=>$password,'u_id'=>$u_id);
			$sql='UPDATE users SET fullname=?, email=?, password=? WHERE u_id=?';
			$query=$this->db->query($sql,$data);
			return $this->db->affected_rows();
		}
		
	}
?>