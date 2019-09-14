<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'models/Base_models.php';
class Supplier_model extends Base_models
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE, TRUE);
        $this->tableName = 'supplier';
    }
    
    public function getResult($where = [], $limit = 10, $start = 0, $orderField = 'id', $like = [], $order = 'DESC')
    {
        $this->db->select('
            *
        ');
        $this->db->from($this->tableName);
        
        if (!empty($where)) {
            foreach ($where as $field => $value) {
                $this->db->where($this->tableName . '.' . $field, $value);
            }
        }
        if (!empty($like)) {
            foreach ($like as $field => $value) {
                $this->db->like($field, $value);
            }
        }
        
        $this->db->limit($limit, $start);
        $this->db->order_by($this->tableName . '.' . $orderField, $order);
        return $this->db->get()->result();
    }
    
    public function getInfo($id)
    {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where($this->tableName . '.' . $this->id, $id);
        return $this->db->get()->row();
    }
}