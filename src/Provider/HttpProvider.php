<?php

namespace Ian\TelegramApi\Provider;

use GuzzleHttp\{Psr7\Request, Client, ClientInterface};
use Psr\Http\Message\StreamInterface;
use Ian\TelegramApi\Exception\TelegramException;
use Ian\TelegramApi\Support\Utils;

class HttpProvider implements HttpProviderInterface
{
    /**
     * HTTP Client Handler
     *
     * @var ClientInterface.
     */
    protected $httpClient;

    /**
     * Server Url
     *
     * @var string
    */
    protected $url;

    /**
     * Bot Api Token
     *
     * @var string
    */
    protected $token;

    /**
     * Timeout
     *
     * @var int
     */
    protected $timeout = 30000;

    /**
     * Get custom headers
     *
     * @var array
    */
    protected $headers = [];

    /**
     * Code message
     *
     * @var array
    */
    public $codes = [
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Reserved for WebDAV advanced collections expired proposal',   // RFC2817
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates (Experimental)',                      // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    ];

    /**
     * 初始化
     *
     * @param string $url
     * @param int $timeout
     * @param array $headers
     * 
     * @return void
     * 
     * @throws TelegramException
     */
    public function __construct($url, $timeout = 30000, $headers = [])
    {
        if (!Utils::isValidUrl($url)) {
            throw new TelegramException('Invalid URL provided to HttpProvider');
        }
        
        if (is_nan($timeout) || $timeout < 0) {
            throw new TelegramException('Invalid timeout duration provided');
        }

        if (!Utils::isArray($headers)) {
            throw new TelegramException('Invalid headers array provided');
        }

        $this->url = $url . $token . '/';
        $this->token = $token;
        $this->timeout = $timeout;
        $this->headers = $headers;
        
        $this->httpClient = new Client([
            'timeout'   =>  $timeout
        ]);
    }

    /**
     * 請求
     *
     * @param $url
     * @param array $payload
     * @param string $method
     * @return array|mixed
     */
    public function request($method = 'get', $suffix, $params): array
    {
        $request = new Request(strtoupper($method), $this->url . $suffix . '?' . \http_build_query($params), [
            'query' => $params
        ]);
        $rawResponse = $this->httpClient->send($request);

        return $this->decodeBody(
            $rawResponse->getBody(),
            $rawResponse->getStatusCode()
        );
    }

    /**
     * 解析
     *
     * @param StreamInterface $stream
     * @param int $status
     * @return array|mixed
     */
    protected function decodeBody(StreamInterface $stream, int $status): array
    {
        $decodedBody = json_decode($stream->getContents(),true);

        if((string) $stream == 'OK') {
            $decodedBody = [
                'status' => 1,
                'code' => $status
            ];
        } elseif ($decodedBody == null or !is_array($decodedBody)) {
            $decodedBody = [
                'status' => 0,
                'code' => $status,
                'message' => ''
            ];
        }

        return $decodedBody;
    }
}
