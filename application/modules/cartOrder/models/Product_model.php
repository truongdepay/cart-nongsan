<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/10/2019
 * Time: 11:34 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'models/Base_models.php';
class Product_model extends Base_models
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE, TRUE);
        $this->tableName = 'posts';
        $this->id = 'ID';
    }

    public function getResult($where = [], $limit = 10, $start = 0, $orderField = 'id', $order = 'DESC')
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

        $this->db->limit($limit, $start);
        $this->db->order_by($this->tableName . '.' . $orderField, $order);
        return $this->db->get()->result();
    }

    public function getInfo($id)
    {
        $this->db->select('
            post_title,
            guid
        ');
        $this->db->from($this->tableName);
        $this->db->join('postmeta','postmeta.post_id = '.$this->tableName.'.' . $this->id);
        $this->db->where($this->tableName . '.' . $this->id, $id);
        return $this->db->get()->row();
    }

    public function getThumbnail($id)
    {
        $this->db->select('
        meta_value
        ');
        $this->db->from($this->tableName);
        $this->db->join('postmeta','postmeta.post_id = '.$this->tableName.'.'.$this->id);
        $this->db->where($this->tableName . '.' . $this->id,$id);
        $this->db->where('postmeta.meta_key','_thumbnail_id');
        return $this->db->get()->row();
    }

    public function getPrice($id)
    {
        $this->db->select('
				postmeta.meta_value
			');
        $this->db->from($this->tableName);
        $this->db->join('postmeta','postmeta.post_id = '.$this->tableName.'.'.$this->id);
        $this->db->where($this->tableName . '.' . $this->id,$id);
        $this->db->where('postmeta.meta_key','_price');
        return $this->db->get()->row();
    }
}