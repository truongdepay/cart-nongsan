<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 9/9/2018
 * Time: 9:27 PM
 */

use Cocur\Slugify\Slugify;

class Slugs
{
    public $SLUGS;
    public function __construct()
    {
        $this->SLUGS = new Slugify();
    }

    public function create($str = '')
    {
        return $this->SLUGS->slugify($str);
    }
}