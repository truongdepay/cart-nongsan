<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/20/2019
 * Time: 2:47 PM
 */

class Index extends MX_Controller
{
    public function __construct()
    {
        $this->load->helper([
            'url',
            'form'
        ]);
        $this->load->library([
            'output',
            'session',
            'security'
        ]);
        $this->load->model('game_model');
        $this->id = 0;
        $this->row = $this->game_model->getInfo($this->id);
        $this->request = $this->input->server('REQUEST_METHOD');
    }

    public function index()
    {
        if (strtolower($this->request) == 'post') {
            $turn = $this->row->turn;
            if ($turn > 0) {
                $data = [];
                $this->checkTurn();
                $dataUpdate = [
                    'turn' => $turn - 1,
                    'date_last' => time()
                ];
                $this->game_model->update($this->id, $dataUpdate);
                $data['siteTitle'] = 'Game đoán số';
                $data['keyboard'] = 10;
                $data['csrf_value'] = $this->security->get_csrf_hash();
                $data['csrf_name'] = $this->security->get_csrf_token_name();
                $template = 'index';
                $this->loadViewGame($template, $data);
            } else {
                redirect('appGames/index/start');
            }
        } else {
            redirect('appGames/index/start');
        }
    }

    public function logic()
    {
        if (strtolower($this->request) == 'post') {
            $response = [];
            $numberIn = $this->input->post('number');
            if ($this->session->has_userdata('game_data')) {
                $gameData = $this->session->userdata('game_data');
                $preTurn = $gameData['predicted_turn'];
                $number = $gameData['result'];
                if ($preTurn > 1) {
                    $ssData = [
                        'predicted_turn' => $preTurn - 1,
                        'result' => $number
                    ];
                    $this->session->set_userdata('game_data', $ssData);

                    if ($numberIn != $number) {
                        if ($numberIn < $number) {
                            $response = [
                                'result' => 1,
                                'data' => [
                                    'turn' => $preTurn -1,
                                    'notify' => $numberIn . ': Số <span class="text-info">' . $numberIn .'</span> đang nhỏ hơn số cần tìm!'
                                ],
                                'csrf' => [
                                    'csrf_value' => $this->security->get_csrf_hash()
                                ]
                            ];
                        } else {
                            $response = [
                                'result' => 1,
                                'data' => [
                                    'turn' => $preTurn -1,
                                    'notify' => $numberIn . ': Số <span class="text-info">' . $numberIn .'</span> đang lớn hơn số cần tìm!'
                                ],
                                'csrf' => [
                                    'csrf_value' => $this->security->get_csrf_hash()
                                ]
                            ];
                        }
                    } else {
                        $ssData = [
                            'predicted_turn' => 0,
                            'result' => $number
                        ];
                        $this->session->set_userdata('game_data', $ssData);
                        $response = [
                            'result' => 1,
                            'data' => [
                                'turn' => 0,
                                'notify' => $numberIn . ': Xin chúc mừng! Số <span class="text-danger">' . $number .'</span> là số cần tìm!'
                            ],
                            'csrf' => [
                                'csrf_value' => $this->security->get_csrf_hash()
                            ]
                        ];
                    }

                } elseif ($preTurn == 1) {
                    if ($numberIn != $number) {
                        $response = [
                            'result' => 1,
                            'data' => [
                                'turn' => $preTurn -1,
                                'notify' => $numberIn . ': Bạn đã hết 5 lượt đoán! Số <span class="text-info">' . $number .'</span> là số cần tìm! <span class="text-danger"></span>'
                            ],
                            'csrf' => [
                                'csrf_value' => $this->security->get_csrf_hash()
                            ]
                        ];
                    } else {
                        $response = [
                            'result' => 1,
                            'data' => [
                                'turn' => 0,
                                'notify' => $numberIn . ': Xin chúc mừng! Số <span class="text-danger">' . $number .'</span> là số cần tìm!'
                            ],
                            'csrf' => [
                                'csrf_value' => $this->security->get_csrf_hash()
                            ]
                        ];
                    }

                } else {
                    $response = [
                        'result' => 0,
                        'data' => [
                            'turn' => 0,
                            'notify' => $numberIn . ': Bạn đã hết 5 lượt đoán! Số <span class="text-info">' . $number .'</span> là số cần tìm! <span class="text-danger">Tiếp tục để săn thẻ cào nào!</span>'
                        ],
                        'csrf' => [
                            'csrf_value' => $this->security->get_csrf_hash()
                        ]
                    ];
                }
            } else {
                redirect('appGames/index/start');
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            redirect('appGames/index/start');
        }
    }

    public function start()
    {
        $data = [];
        $data['siteTitle'] = 'Welcome';

        /**/

        $data['turn'] = $this->row->turn;

        /**/

        $template = 'start';
        $this->loadViewGame($template, $data);
    }

    private function checkTurn()
    {

        $turn = $this->row->turn;
        if ($turn > 0) {
            $session = [
                'predicted_turn' => 5,
                'result' => rand(0, 99)
            ];
        } else {
            $session = [
                'predicted_turn' => 0,
                'result' => null
            ];
        }
        $this->session->set_userdata('game_data', $session);
    }

    private function loadViewGame($template, $data)
    {
        $this->load->config('config_template');
        $this->load->view(config_item('pathHeaderGame'), $data);
        $this->load->view($template, $data);
        $this->load->view(config_item('pathFooterGame'), $data);
    }
}