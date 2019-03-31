<?php

/**
 * @Author: Zenn
 * @Date:   2018-05-26 09:21:11
 * @Last Modified by:   Ngoc Truong
 * @Last Modified time: 2018-05-30 08:43:21
 */
/**
 * 
 */
class Categories_models extends CI_Model
{
	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE,TRUE);
		$this->table_name = 'categories';
	}
	/**
	 * [add description]
	 * @param array $data [description]
	 */
	public function add($data = array())
	{
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	public function update($id = '', $data = array())
	{
		$this->db->where($this->table_name . '.id', $id);
		$this->db->update($this->table_name , $data);
		return $this->db->affected_rows();
	}
	/**
	 * [get_result description]
	 * @param  integer $limit [description]
	 * @param  integer $start [description]
	 * @return [type]         [description]
	 */
	public function get_result($categories = '',$limit = 5, $start = 0)
	{
		$this->db->from($this->table_name);
		$this->db->join('post',$this->table_name.'.categories = post.id');
		if($categories !== '')
		{
			$this->db->where($this->table_name.'.categories',$categories);
		}
		$this->db->order_by($this->table_name . '.oder', 'DESC');
		$this->db->limit($limit,$start);
		return $this->db->get()->result();
	}
	/**
	 * [check_exist description]
	 * @param  string $field [description]
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function check_exist($field = '', $value = '')
	{
		$this->db->from($this->table_name);
		if($field === '')
		{
			$this->db->where($this->table_name . '.id' ,$value);
		}
		else
		{
			$this->db->where($this->table_name . '.' . $field ,$value);
		}
		return $this->db->count_all_results();
	}
	/**
	 * [get_info description]
	 * @param  string $field [description]
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function get_info($field = '', $value = '')
	{
		$this->db->from($this->table_name);
		if($field == '')
		{
			$this->db->where($this->table_name . '.id', $value);
		}
		else
		{
			$this->db->where($this->table_name . '.' . $field, $value);
		}

		return $this->db->get()->row();
	}

	/**
	 * [get_nav_list description]
	 * @return [type] [description]
	 */
	public function get_nav_list()
	{
		$this->db->from($this->table_name);
		$this->db->where($this->table_name. '.nav_menu', 1);
		$this->db->order_by($this->table_name. '.order', 'ASC');
		return $this->db->get()->result();
	}
}