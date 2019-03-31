<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/21/2019
 * Time: 10:08 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'models/Base_models.php';

class Game_model extends Base_models
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true, true);
        $this->tableName = 'game';
        $this->id = 'id';
        $this->turn = 'turn';
        $this->status = 'status';
        $this->score = 'score';
        $this->dateLast = 'date_last';
    }

    public function getInfo($id)
    {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where($this->tableName . '.' . $this->id, $id);
        return $this->db->get()->row();
    }
}