<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: Zenn
 * @Date:   2018-04-26 21:05:58
 * @Last Modified by:   Zenn
 * @Last Modified time: 2018-04-27 09:09:17
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Formatter\LineFormatter;
class Requests
{
    public $date;
    public $logger_path;
    public $logger_file;
    public $DEBUG;
    protected $_CI;
    /**
     * Requests constructor.
     */
    public function __construct()
    {
        $this->_CI =& get_instance();
        $this->DEBUG       = true;
        // Setup Log
        $this->logger_path = APPPATH . 'logs-data/Requests/';
        $this->logger_file = 'Log-' . date('Y-m-d') . '.log';
    }
    /**
     * Send Data Request
     *
     * @param string $url
     * @param array $data
     * @param string $method
     * @param string $magic
     * @return Exception|HttpException|string
     */
    public function sendRequest($url = '', $data = array(), $method = 'GET', $magic = 'cURL')
    {
        $getMethod = strtoupper($method);
        if ($magic == 'HttpRequest')
        {
            $response = self::byHttpRequest($url, $data, $getMethod);
        }
        elseif ($magic == 'HttpClient')
        {
            $response = self::byGuzzleHttpClient($url, $data, $getMethod);
        }
        elseif ($magic == 'file_get_contents')
        {
            $response = self::byGetContents($url, $data, $getMethod);
        }
        elseif ($magic == 'curl')
        {
            $response = self::byCurlRequest($url, $data, $getMethod);
        }
        else
        {
            $response = self::byCurlRequest($url, $data, $getMethod);
        }
        // create a log channel
        if ($this->DEBUG === true)
        {
            // the default date format is "Y-m-d H:i:s"
            $dateFormat = "Y-m-d H:i:s u";
            // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
            $output     = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
            // finally, create a formatter
            $formatter  = new LineFormatter($output, $dateFormat);
            // Create a handler
            $stream     = new StreamHandler($this->logger_path . 'sendRequest/' . $this->logger_file, Logger::INFO, true, 0777);
            $stream->setFormatter($formatter);
            // bind it to a logger object
            $logger = new Logger('sendRequest');
            $logger->pushHandler($stream);
            $logger->pushHandler(new FirePHPHandler());
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
            $logger->info('Response: ' . $response);
        }
        // Response
        return $response;
    }
    /**
     * Request Data by cURL Request
     *
     * @param string $url
     * @param array $data
     * @param string $method
     * @return string
     */
    public function byCurlRequest($url = '', $data = array(), $method = 'GET')
    {
        $getMethod  = strtoupper($method);
        // create a log channel
        // the default date format is "Y-m-d H:i:s"
        $dateFormat = "Y-m-d H:i:s u";
        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $output     = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
        // finally, create a formatter
        $formatter  = new LineFormatter($output, $dateFormat);
        // Create a handler
        $stream     = new StreamHandler($this->logger_path . 'byCurlRequest/' . $this->logger_file, Logger::INFO, true, 0777);
        $stream->setFormatter($formatter);
        // bind it to a logger object
        $logger = new Logger('Requests');
        $logger->pushHandler($stream);
        $logger->pushHandler(new FirePHPHandler());
        if ($this->DEBUG === true)
        {
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
        }
        // Curl
        $curl = new Curl\Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->setOpt(CURLOPT_ENCODING, "utf-8");
        $curl->setOpt(CURLOPT_MAXREDIRS, 10);
        $curl->setOpt(CURLOPT_TIMEOUT, 300);
        // Request
        if ('POST' == $getMethod)
        {
            $curl->post($url, $data);
        }
        else
        {
            $curl->get($url, $data);
        }
        // Response
        $response = $curl->error ? "cURL Error: " . $curl->error_message : $curl->response;
        // Close Request
        $curl->close();
        // Log Response
        if ($this->DEBUG === true)
        {
            $logger->info('Response: ' . $response);
            if (isset($curl->request_headers))
            {
                if (is_array($curl->request_headers))
                {
                    $logger->info('Request Header: ', $curl->request_headers);
                }
                else
                {
                    $logger->info('Request Header: ' . json_encode($curl->request_headers));
                }
            }
            if (isset($curl->response_headers))
            {
                if (is_array($curl->response_headers))
                {
                    $logger->info('Response Header: ', $curl->response_headers);
                }
                else
                {
                    $logger->info('Response Header: ' . json_encode($curl->response_headers));
                }
            }
        }
        // Return Response
        return $response;
    }
    /**
     * Request Data by Guzzle Http Client
     * @param string $url
     * @param array $data
     * @param string $method
     * @return \Psr\Http\Message\StreamInterface
     */
    public function byGuzzleHttpClient($url = '', $data = array(), $method = 'GET')
    {
        $getMethod  = strtoupper($method);
        // create a log channel
        // the default date format is "Y-m-d H:i:s"
        $dateFormat = "Y-m-d H:i:s u";
        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $output     = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
        // finally, create a formatter
        $formatter  = new LineFormatter($output, $dateFormat);
        // Create a handler
        $stream     = new StreamHandler($this->logger_path . 'byGuzzleHttpClient/' . $this->logger_file, Logger::INFO, true, 0777);
        $stream->setFormatter($formatter);
        // bind it to a logger object
        $logger = new Logger('Requests');
        $logger->pushHandler($stream);
        $logger->pushHandler(new FirePHPHandler());
        if ($this->DEBUG === true)
        {
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
        }
        //
        $client   = new \GuzzleHttp\Client();
        // Configs
        $use      = ($getMethod === 'POST') ? 'form_params' : 'query';
        $res      = $client->request($getMethod, $url, array(
            $use => $data
        ));
        $response = $res->getBody();
        if ($this->DEBUG === true)
        {
            $logger->info('Response from Requests: ' . $response);
            if (is_array($res->getHeaders()))
            {
                $logger->info('Response Headers: ', $res->getHeaders());
            }
            else
            {
                $logger->info('Response Headers: ' . json_encode($res->getHeaders()));
            }
        }
        return $response;
    }
    /**
     * Request Data by Http Request
     *
     * @param string $url
     * @param array $data
     * @param string $method
     * @return Exception|HttpException|string
     */
    public function byHttpRequest($url = '', $data = array(), $method = 'GET')
    {
        $getMethod  = strtoupper($method);
        // create a log channel
        // the default date format is "Y-m-d H:i:s"
        $dateFormat = "Y-m-d H:i:s u";
        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $output     = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
        // finally, create a formatter
        $formatter  = new LineFormatter($output, $dateFormat);
        // Create a handler
        $stream     = new StreamHandler($this->logger_path . 'byHttpRequest/' . $this->logger_file, Logger::INFO, true, 0777);
        $stream->setFormatter($formatter);
        // bind it to a logger object
        $logger = new Logger('Requests');
        $logger->pushHandler($stream);
        $logger->pushHandler(new FirePHPHandler());
        if ($this->DEBUG === true)
        {
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
        }
        // Request
        $request = new HttpRequest();
        $request->setUrl($url);
        if ($method === 'POST')
        {
            $request->setMethod(HTTP_METH_POST);
        }
        else
        {
            $request->setMethod(HTTP_METH_GET);
        }
        $request->setQueryData($data);
        $request->setHeaders(array(
            'cache-control' => 'no-cache'
        ));
        try
        {
            $resp     = $request->send();
            $response = $resp->getBody();
        }
        catch (HttpException $ex)
        {
            $response = $ex;
        }
        // Log Response
        if ($this->DEBUG === true)
        {
            $logger->info('Response: ' . $response);
        }
        // Return Response
        return $response;
    }
    /**
     * Request Data by File Get Contents
     *
     * @param string $url
     * @param array $data
     * @param string $method
     * @return Exception|HttpException|string
     */
    public function byGetContents($url = '', $data = array(), $method = 'GET')
    {
        $getMethod  = strtoupper($method);
        // create a log channel
        // the default date format is "Y-m-d H:i:s"
        $dateFormat = "Y-m-d H:i:s u";
        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $output     = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
        // finally, create a formatter
        $formatter  = new LineFormatter($output, $dateFormat);
        // Create a handler
        $stream     = new StreamHandler($this->logger_path . 'byGetContents/' . $this->logger_file, Logger::INFO, true, 0777);
        $stream->setFormatter($formatter);
        // bind it to a logger object
        $logger = new Logger('Requests');
        $logger->pushHandler($stream);
        $logger->pushHandler(new FirePHPHandler());
        // Request
        $request = new HttpRequest();
        $request->setUrl($url);
        if ($method === 'POST')
        {
            $opts     = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $data
                )
            );
            $context  = stream_context_create($opts);
            $response = file_get_contents($url, false, $context);
        }
        else
        {
            $response = file_get_contents($url . '?' . http_build_query($data));
        }
        // Log Response
        if ($this->DEBUG === true)
        {
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
            $logger->info('Response: ' . $response);
        }
        // Return Response
        return $response;
    }
}
/* End of file Requests.php */
/* Location: ./based_core_apps_thudo/libraries/Requests.php */
