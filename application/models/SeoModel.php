<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 9/16/2018
 * Time: 10:02 PM
 */
require_once APPPATH . "Models/Base/BaseModel.php";
class SeoModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", true, true);
        $this->table_name = 'seo_config';
        $this->id = 'id';
        $this->post_id = 'post_id';
        $this->type = 'type';
        $this->social = 'social';
        $this->name = 'name';
        $this->content = 'content';
        $this->date_created = 'date_created';
        $this->date_modify = 'date_modify';
    }
}