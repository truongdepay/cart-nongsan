<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 12/24/2018
 * Time: 11:01 PM
 */

class Index extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form',
            'validate',
            'elements'
        ]);

        $this->load->library([
            'session',
            'users'
        ]);
        $this->users->redirectLogin();
        $this->load->config('config_notification');
        $this->noError = config_item('notifyError');
        $this->load->model('Product_model');
        $this->load->model('Cat_model');
        $this->load->config('config_upload');
        $this->configImg = config_item('img');
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

        $result = $this->Product_model->getResult();
        $data['result'] = $result;
        $data['siteTitle'] = 'Quản lý sản phẩm';
        $template = 'manager';
        $this->loadView($template, $data);
    }

    private function create()
    {
        $data = [];
        $data['siteTitle'] = 'Thêm mới sản phẩm';
        $catWhere = [
            'status' => 1,
            'type' => 1
        ];
        $data['listCat'] = $this->Cat_model->getResult($catWhere);
        $error = [];
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $title = $this->input->post('title');
            $slugs = $this->input->post('slugs');
            $desc = $this->input->post('desc');
            $content = $this->input->post('content');
            $keywords = $this->input->post('keywords');
            $tags = $this->input->post('tags');
            $price = $this->input->post('price');
            $category = $this->input->post('category');
            $status = $this->input->post('status');

            $flashData = [
                'slugs' => $slugs,
                'status' => $status,
                'category' => $category,
                'title' => $title,
                'desc' => $desc,
                'content' => $content,
//                'thumb' => $thumb,
//                    'type' => $type,
//                    'order' => $order,
                'keywords' => $keywords,
                'tags' => $tags,
                'price' => $price
            ];

            $this->session->set_flashdata('dataProduct', $flashData);

            if (!titleCheck($title)) {
                $error['title'] = $this->noError['title'];
            }

            if (!descCheck($desc)) {
                $error['desc'] = $this->noError['desc'];
            }

            if (!slugsCheck($slugs)) {
                $error['slugs'] = $this->noError['slugs'];
            }

            $checkExistSlugs = $this->Product_model->checkExist('slugs', $slugs);
            if ($checkExistSlugs != 0) {
                $error['dupSlugs'] = $this->noError['dupSlugs'];
            }

            if (empty($error)) {
                if ($_FILES['thumb']['error'] != 4) {
                    $checkUpload = $this->do_upload($slugs);
                }

                if (isset($checkUpload['error'])) {
                    $error['uploadImages'] = $this->noError['uploadImages'];
                }
                if (empty($error)) {
                    if ($_FILES['thumb']['error'] == 4) {
                        $thumb = null;
                    } else {
                        $thumb = $this->configImg['upload_path'] . $slugs . '/' . $checkUpload['upload_data']['raw_name'] . $checkUpload['upload_data']['file_ext'];
                    }

                    $postData = [
                        'slugs' => $slugs,
                        'status' => $status,
                        'category' => $category,
                        'title' => $title,
                        'desc' => $desc,
                        'content' => $content,
                        'thumb' => $thumb,
//                    'type' => $type,
//                    'order' => $order,
                        'keywords' => $keywords,
                        'tags' => $tags,
                        'date_create' => time(),
                        'price' => $price
                    ];
                    $this->Product_model->add($postData);
                    $this->session->set_flashdata('success', true);
                    redirect('managerProduct/index/index?action=manager');
                } else {
                    $this->session->set_flashdata('error', $error);
                }
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
        $data['siteTitle'] = 'Sửa bài viết';

        $id = $this->input->get('id');
        $item = $this->Product_model->getInfo($id);
        $data['item'] = $item;
        $data['id'] = $id;
        $catWhere = [
            'status' => 1,
            'type' => 1
        ];
        $data['listCat'] = $this->Cat_model->getResult($catWhere);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $error = [];
            $title = $this->input->post('title');
            $slugs = $this->input->post('slugs');
            $desc = $this->input->post('desc');
            $content = $this->input->post('content');
            $keywords = $this->input->post('keywords');
            $tags = $this->input->post('tags');
            $category = $this->input->post('category');
            $status = $this->input->post('status');

            $flashData = [
                'slugs' => $slugs,
                'status' => $status,
                'category' => $category,
                'title' => $title,
                'desc' => $desc,
                'content' => $content,
//                'thumb' => $thumb,
//                    'type' => $type,
//                    'order' => $order,
                'keywords' => $keywords,
                'tags' => $tags,
            ];
            $this->session->set_flashdata('dataPost', $flashData);

            if (!titleCheck($title)) {
                $error['title'] = $this->noError['title'];
            }

            if (!descCheck($desc)) {
                $error['desc'] = $this->noError['desc'];
            }

            if (!slugsCheck($slugs)) {
                $error['slugs'] = $this->noError['slugs'];
            }

            $checkExistSlugs = $this->Product_model->checkExist('slugs', $slugs, $id);
            if ($checkExistSlugs != 0) {
                $error['dupSlugs'] = $this->noError['dupSlugs'];
            }

            if (empty($error)) {
                if ($_FILES['thumb']['error'] != 4) {
                    $checkUpload = $this->do_upload($slugs);
                }

                if (isset($checkUpload['error'])) {
                    $error['uploadImages'] = $this->noError['uploadImages'];
                }
                if (empty($error)) {
                    if ($_FILES['thumb']['error'] == 4) {
                        $thumb = $item->thumb;
                    } else {
                        $thumb = $this->configImg['upload_path'] . $slugs . '/' . $checkUpload['upload_data']['raw_name'] . $checkUpload['upload_data']['file_ext'];
                    }

                    $postData = [
                        'slugs' => $slugs,
                        'status' => $status,
                        'category' => $category,
                        'title' => $title,
                        'desc' => $desc,
                        'content' => $content,
                        'thumb' => $thumb,
//                    'type' => $type,
//                    'order' => $order,
                        'keywords' => $keywords,
                        'tags' => $tags,
                        'date_create' => time()
                    ];
                    $this->Product_model->update($id, $postData);
                    redirect('managerProduct/index/index?action=index');
                } else {
                    $this->session->set_flashdata('error', $error);
                }
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $template = 'edit';
        $this->loadView($template, $data);
    }

    private function delete()
    {

    }

    private function category()
    {

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
                $check = $this->Product_model->checkExist('slugs', $slugs, $id);
            } else {
                $check = $this->Product_model->checkExist('slugs', $slugs);
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

    private function do_upload($slugs)
    {
        if (!file_exists($this->configImg['upload_path'] . $slugs)) {
            mkdir($this->configImg['upload_path'] . $slugs, 0777, true);
        }

        $config['upload_path'] = './' . $this->configImg['upload_path'] . $slugs . '/';
        $config['allowed_types'] = $this->configImg['allowed_types'];
        $config['max_size'] = $this->configImg['max_size'];
        $config['max_width'] = $this->configImg['max_width'];
        $config['max_height'] = $this->configImg['max_height'];

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('thumb'))
        {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }
}