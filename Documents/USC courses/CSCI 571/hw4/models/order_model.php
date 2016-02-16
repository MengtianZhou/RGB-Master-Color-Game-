<?php
	class Order_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function insert($u_id,$shipping_add,$billing_add,$order_date){
			$data=array('u_id'=>$u_id,'shipping_add'=>$shipping_add,'billing_add'=>$billing_add,'order_date'=>$order_date);
			$query=$this->db->insert('orders',$data);
			return $this->db->affected_rows();
		}
		public function get_order_id($u_id,$order_date){
			$sql='SELECT * FROM orders WHERE u_id=? AND order_date=?';
			$query=$this->db->query($sql,array($u_id,$order_date));
			if($query->num_rows()==1){
				return $query->result();
			}else{
				return 0;
			}
		}
		public function get_orders($u_id){
			$sql='SELECT * FROM orders WHERE u_id=? ORDER BY o_id DESC';
			$query=$this->db->query($sql,$u_id);
			if($query->num_rows()>0){
				return $query->result();
			}
			else{
				return 0;
			}
		}
	}
?>