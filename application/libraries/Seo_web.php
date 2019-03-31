<?php

/**
 * @Author: Zenn
 * @Date:   2018-05-10 11:36:09
 * @Last Modified by:   Zenn
 * @Last Modified time: 2018-05-10 22:00:40
 */
/**
 * SEO LIBRARY
 * 
 */
class Seo_web
{
	protected $_CI;
	public function __construct()
	{
		$this->_CI =& get_instance();
		$this->_CI->load->config('config_seo');
		$this->seo_meta = config_item('config_seo');
	}

	public function render_meta_post($title = '', $desc = '', $keywords = array())
	{
		/**
		 * Creat meta name
		 */
		$name_keywords = json_encode($keywords);
		$name_description = $desc;
		/**
		 * Creat meta property
		 */
		$property_og_title = $title;
		$property_og_decription = $desc;
	}
}