<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 9/9/2018
 * Time: 2:08 AM
 */
require_once APPPATH . "models/Base/BaseModel.php";
class Post_model extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true, true);
        $this->table_name = 'post';
        $this->id = 'id';
        $this->slugs = 'slugs';
        $this->desc = 'description';
        $this->author = 'author';
        $this->status = 'status';
        $this->title = 'title';
        $this->content = 'content';
        $this->type = 'type';
        $this->order = 'order';
        $this->date_created = 'date_created';
        $this->date_modify = 'date_modify';
    }
}