<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 9/16/2018
 * Time: 9:57 PM
 */
class BaseModel extends CI_Model
{
    /**
     * @param array $data
     * @return mixed
     */
    public function add($data = array())
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }

    /**
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function update($id = '', $data = array())
    {
        $this->db->where($this->table_name . '.id', $id);
        $this->db->update($this->table_name , $data);
        return $this->db->affected_rows();
    }

    public function getInfo($field = '', $value = '')
    {
        $this->db->from($this->table_name);
        $this->db->where($field, $value);
        return $this->db->get()->row();
    }

    public function getMaxId()
    {
        $this->db->select('id');
        $this->db->from($this->table_name);
        $this->db->order_by($this->id, 'DESC');
        return $this->db->get()->row();
    }

    public function checkExist($field = '', $value = '')
    {
        $this->db->from($this->table_name);
        $this->db->where($field, $value);
        return $this->db->count_all_results();
    }

}