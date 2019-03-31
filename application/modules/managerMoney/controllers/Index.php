<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 2/19/2019
 * Time: 10:02 AM
 */

class Index extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form',
            'validate'
        ]);

        $this->load->library([
            'output',
            'users'
        ]);
        $this->users->redirectLogin();
        $this->load->model('Money_model');
        $this->load->config('config_notification');
        $this->noCommon = config_item('notifyCommon');
    }

    public function index()
    {
        $action = $this->input->get('action');
        switch ($action) {
            case 'index':
                $this->manager();
                break;
            case 'create':
                $this->create();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'getSuggest':
                $this->getSuggest();
                break;
            default:
                $this->manager();
                break;
        }
    }

    private function create()
    {
        $template = 'create';
        $data = [];
        $data['siteTitle'] = 'Manager Money';

        if (strtolower($this->input->server('REQUEST_METHOD')) == 'post') {
            $date = $this->input->post('date');
            $content = $this->input->post('content');
            $money = $this->input->post('money');

            $error = [];

            if (!checkNull($date)) {
                $error['date'] = 'Not null';
            }

            if (!checkNull($content)) {
                $error['content'] = 'Not null';
            }

            if (!priceCheck($money)) {
                $error['money'] = 'Tiền sai';
            }
            if (empty($error)) {
                $dataSave = [
                    'date' => strtotime($date),
                    'content' => $content,
                    'money' => $money
                ];

                $this->Money_model->add($dataSave);
                redirect('managerMoney/index/index?action=create');
            } else {
                redirect('managerMoney/index/index?action=create');
            }

        }

        $this->loadView($template, $data);
    }

    public function spendToday()
    {
        $data = [];

        $listSpend = $this->Money_model->getResult();
        $data['listSpend'] = $listSpend;

        $template = 'spendToday';
        $this->load->view($template, $data);
    }

    public function search()
    {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $error = [];
        $fromDate = strtotime($fromDate);
        $toDate = strtotime($toDate);

        if (!checkNull($fromDate)) {
            $error['fromDate'] = $this->noCommon['notNull'];
        }
        if (!checkNull($toDate)) {
            $error['toDate'] = $this->noCommon['notNull'];
        }

        if ($toDate < $fromDate) {
            $error['fromTo'] = $this->noCommon['fromTo'];
        }

        if (empty($error)) {
            $list = $this->Money_model->getByDate($fromDate, $toDate);
            $response = $list;
            if (!empty($response)) {
                $total = 0;
                for ($i = 0; $i < count($response); $i++) {
                    $total += $response[$i]->money;
                    $response[$i]->date = date('Y-m-d', $response[$i]->date);
                    $response[$i]->money = number_format($response[$i]->money);
                }
                for ($i = 0; $i < count($response); $i++) {
                    $response[$i]->total = number_format($total);
                }

                $response = [
                    'result' => 1,
                    'fromDate' => date('Y-m-d', $fromDate),
                    'toDate' => date('Y-m-d', $toDate),
                    'content' => $response
                ];
            } else {
                $response = [
                    'result' => 2,
                    'content' => null
                ];
            }

        } else {
            $response = [
                'result' => 0,
                'content' => null
            ];
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;

    }

    private function getSuggest()
    {
        $key = $this->input->get('key');

        $suggest = $this->Money_model->searchContent($key);
        if (count($suggest) > 0)
        {
            $response = [
                'result' => 1,
                'content' => $suggest
            ];
        } else {
            $response = [
                'result' => 0,
                'content' => null
            ];
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    private function loadView($template, $data)
    {
        $this->load->config('config_template');
        $this->load->view(config_item('pathHeaderAdmin'), $data);
        $this->load->view($template, $data);
        $this->load->view(config_item('pathFooter'), $data);
    }
}