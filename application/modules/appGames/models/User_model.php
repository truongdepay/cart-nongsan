<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/10/2019
 * Time: 11:34 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'models/Base_models.php';
class User_model extends Base_models
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE, TRUE);
        $this->tableName = 'user';
        $this->id = 'id';
        $this->status = 'status';
        $this->fullname = 'fullname';
        $this->username = 'username';
        $this->password = 'password';
        $this->salt = 'salt';
        $this->birthday = 'birthday';
        $this->description = 'description';
        $this->dateCreate = 'date_create';
        $this->dateModify = 'date_modify';
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

    public function getInfo($field, $value)
    {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where($this->tableName . '.' . $field, $value);
        return $this->db->get()->row();
    }

}