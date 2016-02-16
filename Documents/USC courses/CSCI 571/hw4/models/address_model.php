<?php
	class Address_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function number($u_id){
			$sql='SELECT * FROM addresses WHERE u_id=?';
			$query = $this->db->query($sql,$u_id);
			if($query->num_rows()==0){
				return 0;
			}else{
				return 1;
			}
		}
		public function select($u_id){
			$sql='SELECT * FROM addresses WHERE u_id=?';
			$query = $this->db->query($sql,$u_id);
			return $query->result();
		}
		public function insert($fullname,$address,$city,$state,$zipcode,$phone,$u_id){
			$data=array('fullname'=>$fullname,'address'=>$address,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'phone'=>$phone,'u_id'=>$u_id);
			$query=$this->db->insert('addresses',$data);
			return $this->db->affected_rows();
		}
		public function select_by_id($add_id){
			$sql='SELECT * FROM addresses WHERE add_id=?';
			$query=$this->db->query($sql,$add_id);
			return $query->result();
		}
		public function delete_add($add_id){
			$sql='DELETE FROM addresses WHERE add_id=?';
			$query=$this->db->query($sql,$add_id);
			return $this->db->affected_rows();
		}
		public function update($add_id,$fullname,$address,$city,$state,$zipcode,$phone){
			$sql='UPDATE addresses SET fullname=?, address=?,city=?,state=?,zipcode=?,phone=? WHERE add_id=?';
			$data=array('fullname'=>$fullname,'address'=>$address,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'phone'=>$phone,'add_id'=>$add_id);
			$query=$this->db->query($sql,$data);
			return $this->db->affected_rows();
		}
	}
?>