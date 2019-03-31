<?php
/*
Github: https://github.com/Lukeas14/codeigniter_crawler
Author: Justin Lucas (Lukeas14@gmail.com)
Copyright (c) 2012 Justin Lucas
Licensed under MIT License (https://github.com/jquery/jquery/blob/master/MIT-LICENSE.txt)
*/

use Cocur\Slugify\Slugify;

require_once(APPPATH . '/libraries/Simple_html_dom.php');
class crawler
{

    protected $_CI;
    /**
     *
     * Block comment
     *
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->html = new Simple_html_dom;
        $this->slugify = new Slugify();
    }

    public function getDataMb($date)
    {
        $url = "https://ketqua.vn/kqxstt-ket-qua-xo-so-truyen-thong-ngay";
        $url = $url . "-" . $date;
        $this->html->load_file($url);
        foreach ($this->html->find('div[class=result-box] table tbody tr td') as $firstValue) {
            $response[] = $firstValue->innertext;
        }
        //$response = $this->slugify->slugify($response, ' ');
        //$response = preg_replace('/[a-zA-Z]+/','',$response);
        return $response;

    }

    public function getResult($url = '')
    {
        $this->html->load_file($url);
        $response = [];
        for ($i = 1; $i <= 40; $i = $i + 2) {
            $row = $this->html->find('tbody.tableBodyContainer tr', $i);
            foreach ($row->find('td') as $value) {
                $response[$i][] = $value->innertext;
            }
        }

        return $response;
    }
}