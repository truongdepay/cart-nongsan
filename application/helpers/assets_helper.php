<?php

/**
 * @Author: Zenn
 * @Date:   2018-05-20 09:30:32
 * @Last Modified by:   Ngoc Truong
 * @Last Modified time: 2018-05-31 08:28:56
 */
if(!function_exists('image_url'))
{
	/**
	 * [image_url description]
	 * @param  [type] $path [description]
	 * @return [type]       [description]
	 */
	function image_url($path)
	{
		if(ENVIRONMENT === 'production')
		{
			$host = base_url();
		}
		else
		{
			$host = 'http://taydo24h.com';
		}
		return $host.$path;
	}
}