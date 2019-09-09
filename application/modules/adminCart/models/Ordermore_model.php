<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/10/2019
 * Time: 11:34 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH . 'models/Base_models.php';
class Ordermore_model extends Base_models
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE, TRUE);
        $this->tableName = 'order_more';
        $this->id = 'id';
        $this->status = 'status';
    }
    
    public function getResult($where = [], $limit = 10, $start = 0, $orderField = 'id', $like = [], $order = 'DESC')
    {
        $this->db->select('
            order_more.id as id,
            order_more.status as status,
            order_more.fullname as fullname,
            order_more.phone as phone,
            order_more.email as email,
            order_more.company as company,
            order_more.address as address,
            order_more.amount as amount,
            order_more.desired_price as desired_price,
            order_more.date_want as date_want,
            order_more.date_create as date_create,
            order_more.product as product,
            posts.post_title as post_title,
        ');
        $this->db->from($this->tableName);
        $this->db->join('posts', $this->tableName . '.product = ' . 'posts.ID');
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