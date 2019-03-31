<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/22/2019
 * Time: 9:12 AM
 */
class Index extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form',
            'elements',
            'validate'
        ]);

        $this->load->library([
            'session',
            'users'
        ]);
        $this->users->redirectLogin();
        $this->load->config('config_notification');
        $this->noError = config_item('notifyError');
        $this->load->model('Cat_model');
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
            case 'category':
                $this->category();
                break;
            default:
                $this->manager();
                break;
        }
    }

    private function manager()
    {
        $data = [];
        $data['siteTitle'] = 'Quản lý danh mục';

        $result = $this->Cat_model->getResult();
        $data['result'] = $result;

        $template = 'manager';
        $this->loadView($template, $data);
    }

    private function create()
    {
        $data = [];
        $data['siteTitle'] = 'Thêm mới danh mục';
        $listCat = $this->Cat_model->getResult(['status' => 1], 10, 0);
        $data['listCat'] = $listCat;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $error = [];
            $title = $this->input->post('title');
            $slugs = $this->input->post('slugs');
            $parent = $this->input->post('parent');
            $status = $this->input->post('status');
            $type = $this->input->post('type');

            $flashData = [
                'slugs' => $slugs,
                'status' => $status,
                'parent' => $parent,
                'title' => $title,
                'type' => $type
            ];
            $this->session->set_flashdata('dataCat', $flashData);

            if (!titleCheck($title)) {
                $error['title'] = $this->noError['title'];
            }

            if (!slugsCheck($slugs)) {
                $error['slugs'] = $this->noError['slugs'];
            }

            $checkExistSlugs = $this->Cat_model->checkExist('slugs', $slugs);
            if ($checkExistSlugs != 0) {
                $error['dupSlugs'] = $this->noError['dupSlugs'];
            }

            if (empty($error)) {
                $catData = [
                    'title' => $title,
                    'slugs' => $slugs,
                    'status' => $status,
                    'parent' => $parent,
                    'type' => $type,
                    'date_create' => time()
                ];
                $this->Cat_model->add($catData);
                $this->session->set_flashdata('success', true);
                redirect('managerCat/index/index?action=manager');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $template = 'create';
        $this->loadView($template, $data);
    }

    private function edit()
    {
        $data = [];
        $data['siteTitle'] = 'Sửa danh mục';
        $id = $this->input->get('id');
        $item = $this->Cat_model->getInfo($id);
        $data['item'] = $item;
        $data['id'] = $id;
        $where = [
            'type' => $item->type,
            'id !=' => $item->id
        ];
        $data['listCat'] = $this->Cat_model->getResult($where);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $error = [];
            $title = $this->input->post('title');
            $slugs = $this->input->post('slugs');
            $parent = $this->input->post('parent');
            $status = $this->input->post('status');
            $type = $this->input->post('type');

            $flashData = [
                'slugs' => $slugs,
                'status' => $status,
                'parent' => $parent,
                'title' => $title,
                'type' => $type
            ];
            $this->session->set_flashdata('dataCat', $flashData);

            if (!titleCheck($title)) {
                $error['title'] = $this->noError['title'];
            }

            if (!slugsCheck($slugs)) {
                $error['slugs'] = $this->noError['slugs'];
            }

            $checkExistSlugs = $this->Cat_model->checkExist('slugs', $slugs, $id);
            if ($checkExistSlugs != 0) {
                $error['dupSlugs'] = $this->noError['dupSlugs'];
            }

            if (empty($error)) {
                $catData = [
                    'title' => $title,
                    'slugs' => $slugs,
                    'status' => $status,
                    'parent' => $parent,
                    'type' => $type,
                    'date_create' => time()
                ];
                $this->Cat_model->update($id, $catData);
                $this->session->set_flashdata('success', true);
                redirect('managerCat/index/index?action=manager');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $template = 'edit';
        $this->loadView($template, $data);
    }

    private function loadView($template, $data)
    {
        $this->load->config('config_template');
        $this->load->view(config_item('pathHeader'), $data);
        $this->load->view($template, $data);
        $this->load->view(config_item('pathFooter'), $data);
    }

    public function createSlug()
    {
        $this->load->library([
            'slugs',
            'output'
        ]);
        $action = $this->input->get('action');
        $id = $this->input->get('id');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $title = $this->input->post('title');
            $slugs = $this->slugs->create($title);

            if ($action == 'edit') {
                $check = $this->Cat_model->checkExist('slugs', $slugs, $id);
            } else {
                $check = $this->Cat_model->checkExist('slugs', $slugs);
            }

            if ($check != 0) {
                $notify = $this->noError['dupSlugs'];
            } else {
                $notify = '';
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'slugs' => $slugs,
                    'notify' => $notify
                ]));
        }
    }

    public function changeTypeCat()
    {
        $type = $this->input->post('type');
        $id = $this->input->get('id');
        if ($type != '') {
            $where = [
                'type' => $type,
                'id !=' => $id
            ];
            $list = $this->Cat_model->getResult($where);

            $response = [
                'result' => 1,
                'list' => $list
            ];
        } else {
            $response = [
                'result' => 0,
                'list' => null
            ];
        }


        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

}