<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 10/20/2018
 * Time: 2:18 PM
 */

require_once APPPATH . "models/Base/BaseModel.php";

class LotteryModel extends BaseModel
{
    public function __construct()
    {
        $this->db = $this->load->database('default', true, true);
        $this->table_name = 'xsmb';
        $this->id = 'id';
        $this->date = 'date';
        $this->content = 'content';
        $this->dateCreated = 'date_created';
        $this->dateModify = 'date_modify';
    }
}