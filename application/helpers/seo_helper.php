<?php

/**
 * @Author: Zenn
 * @Date:   2018-04-25 00:58:56
 * @Last Modified by:   Ngoc Truong
 * @Last Modified time: 2018-05-31 08:29:07
 */

if ( ! function_exists('meta_tag'))
{
	/**
	 * [meta_tag description]
	 * @param  array  $data    [description]
	 * @param  string $name    [description]
	 * @param  string $content [description]
	 * @return [type]          [description]
	 */
	function meta_tag($data = array() , $name = 'name' , $content = 'content')
	{
		if(empty($data))
		{
			$result = array();
		}
		else
		{
			$result = array();
			for ($i=0; $i < count($data) ; $i++) { 
				$result[] = '<meta '.$name.'="'.array_keys($data)[$i].'" '.$content.'="'. array_values($data)[$i] .'"/>';
			}
		}
		return $result;
	}

}

if(!function_exists('cat_url'))
{
	/**
	 * [cat_url description]
	 * @param  string $cat_slugs [description]
	 * @return [type]            [description]
	 */
	function cat_url($cat_slugs = '')
	{

		$url = site_url('danh-muc/'.$cat_slugs);
		return $url;
	}
}