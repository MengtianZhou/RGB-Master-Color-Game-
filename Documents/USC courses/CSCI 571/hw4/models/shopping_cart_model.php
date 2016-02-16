<?php
	class Shopping_cart_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function insert($u_id,$p_id,$ps_id,$quantity){
			$data=array('u_id'=>$u_id,'p_id'=>$p_id,'ps_id'=>$ps_id,'quantity'=>$quantity);
			$result=$this->db->insert('shopping_cart',$data);
			return $result;
		}
		public function select($u_id){
			$sql='SELECT * FROM shopping_cart WHERE u_id=?';
			$query = $this->db->query($sql,$u_id);
			return $query->result();
		}
		public function number($u_id){
			$sql='SELECT * FROM shopping_cart WHERE u_id=?';
			$query = $this->db->query($sql,$u_id);
			if($query->num_rows()==0){
				return 0;
			}else{
				return 1;
			}
		}
		public function empty_cart($u_id){
			$sql='DELETE FROM shopping_cart WHERE u_id=?';
			$query=$this->db->query($sql,$u_id);
			return $this->db->affected_rows()>0;
		}
		public function delete_item($u_id,$p_id){
			$data=array('u_id'=>$u_id,'p_id'=>$p_id);
			$sql="DELETE FROM shopping_cart WHERE u_id=? and p_id=?";
			$query=$this->db->query($sql,$data);
			return $this->db->affected_rows();
		}
		public function update_item($u_id,$p_id,$ps_id,$quantity){
			$data=array('ps_id'=>$ps_id,'quantity'=>$quantity);
			$where="u_id=$u_id AND p_id=$p_id";
			$query=$this->db->update('shopping_cart',$data);
			return $this->db->affected_rows();
		}
	}
?>