<?php
	class Order_detail_model extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function insert($o_id,$p_id,$size,$price,$quantity){
			$data=array('o_id'=>$o_id,'p_id'=>$p_id,'size'=>$size,'price'=>$price,'quantity'=>$quantity);
			$query=$this->db->insert('order_detail',$data);
			return $this->db->affected_rows();
		}
		public function select($o_id){
			$sql='SELECT * FROM order_detail WHERE o_id=?';
			$query=$this->db->query($sql,$o_id);
			return $query->result();
		}
	}
?>