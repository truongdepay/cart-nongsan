<?php

/**
 * @Author: Zenn
 * @Date:   2018-05-26 15:20:06
 * @Last Modified by:   Zenn
 * @Last Modified time: 2018-05-26 20:58:38
 */
if(!function_exists('limit_title'))
{
	/**
	 * [limit_title description]
	 * @param  string $title         [description]
	 * @param  [type] $num_character [description]
	 * @return [type]                [description]
	 */
	function limit_title($title = '', $num_character)
	{
		$str       = '...';
		$title_len = strlen($title);
		if($title_len > $num_character)
		{
			$result = substr($title, 0, $num_character) . $str;
		}
		else
		{
			$result = $title;
		}
		return $result;
	}
}

if(!function_exists('post_link'))
{
	/**
	 * [post_link description]
	 * @param  string $cat_slugs [description]
	 * @param  string $slugs     [description]
	 * @param  string $id        [description]
	 * @return [type]            [description]
	 */
	function post_link($cat_slugs = '', $slugs = '',  $id ='')
	{
		$link = $cat_slugs . '/' . $slugs . '-' . $id;
		return site_url($link);
	}
}