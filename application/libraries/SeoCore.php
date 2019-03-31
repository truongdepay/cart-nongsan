<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ngoct
 * Date: 14/9/2018
 * Time: 4:34 PM
 */

class SeoCore
{
    public $CI;
    function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('seomodel');
    }

    /**
     * add Title to database
     * @param string $post_id
     * @param string $title
     * @param string $type
     * @return array
     */
    public function addTitle($post_id = '', $title = '', $type = '')
    {
        $this->CI->load->config('config_seo');
        $seo_config = config_item('seo_config');
        $id = array();
        foreach ($seo_config as $social) {
            $data = array(
                'post_id' => $post_id,
                'type' => $type,
                'social' => $social,
                'name' => 'title',
                'content' => $title,
                'date_created' => time()
            );
            $id[$social] = $this->CI->seomodel->add($data);
        }
        return $id;
    }


    public function addDesc($post_id = '', $desc = '', $type = '')
    {
        $this->CI->load->config('config_seo');
        $seo_config = config_item('seo_config');
        $id = array();
        foreach ($seo_config as $social) {
            $data = array(
                'post_id' => $post_id,
                'type' => $type,
                'social' => $social,
                'name' => 'description',
                'content' => $desc,
                'date_created' => time()
            );
            $id[$social] = $this->CI->seomodel->add($data);
        }
        return $id;
    }


    public function addImage($post_id = '', $image = '', $type = '')
    {
        $this->CI->load->config('config_seo');
        $seo_config = config_item('seo_config');
        $id = array();
        foreach ($seo_config as $social) {
            $data = array(
                'post_id' => $post_id,
                'type' => $type,
                'social' => $social,
                'name' => 'image',
                'content' => $image,
                'date_created' => time()
            );
            $id[$social] = $this->CI->seomodel->add($data);
        }
        return $id;
    }
}