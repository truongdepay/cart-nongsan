<?php

/**
 * @Author: Zenn
 * @Date:   2018-05-26 09:45:18
 * @Last Modified by:   Ngoc Truong
 * @Last Modified time: 2018-05-28 15:13:08
 */
/**
 * 
 */
class Merge_Cat_models extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE,TRUE);
		$this->table_1 = 'categories';
		$this->table_2 = 'post';
	}

	public function get_list_id()
	{
		$this->db->select(
			'categories.C_ID as id'
		);
		$this->db->from($this->table_1);
		return $this->db->get()->result();
	}
	/**
	 * [get_info description]
	 * @param  string $field [description]
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function get_info($field = '', $value = '')
	{
		$this->db->from($this->table_1);
		if($field == '')
		{
			$this->db->where($this->table_1 . '.id', $value);
		}
		else
		{
			$this->db->where($this->table_1 . '.' . $field, $value);
		}

		return $this->db->get()->row();
	}

	/**
	 * [add description]
	 * @param array $data [description]
	 */
	public function add($data = array())
	{
		$this->db->insert($this->table_2,$data);
		return $this->db->insert_id();
	}

}