<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/10/2019
 * Time: 11:34 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'models/Base_models.php';
class Post_model extends Base_models
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE, TRUE);
        $this->tableName = 'posts';
        $this->id = 'id';
        $this->slugs = 'slugs';
        $this->status = 'status';
        $this->category = 'category';
        $this->title = 'title';
        $this->desc = 'desc';
        $this->content = 'content';
        $this->thumb = 'thumb';
        $this->type = 'type';
        $this->order = 'order';
        $this->keywords = 'keywords';
        $this->tags = 'tags';
        $this->author = 'author';
        $this->dateCreate = 'date_create';
        $this->dateModify = 'date_modify';
        $this->authorModify = 'author_modify';
    }

    public function getResult($where = [], $limit = 10, $start = 0, $orderField = 'id', $order = 'DESC')
    {
        $this->db->select('
            posts.id as id,
            posts.category as category,
            posts.title as title,
            posts.status as status,
            posts.slugs as slugs,
            posts.thumb as thumb,
            posts.date_create as date_create,
            posts.date_modify as date_modify,
            posts.author as author,
            posts.author_modify as author_modify,
            category.id as cat_id,
            category.title as cat_title
        ');
        $this->db->from($this->tableName);
        $this->db->join('category', 'category.id = ' . $this->tableName . '.' . $this->category);

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
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where($this->tableName . '.' . $this->id, $id);
        return $this->db->get()->row();
    }

}