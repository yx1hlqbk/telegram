<?php
namespace Ian\TelegramApi;

use Ian\TelegramApi\Provider\HttpProvider;

class TelegramManager
{
    /**
     *
     * @var \Ian\TelegramApi\Provider\HttpProvider
    */
    private $provider;

    /**
     * Bot api url
     *
     * @var array
    */
    protected $url = 'https://api.telegram.org/bot';

    /**
     * 初始化
     * 
     * @param string $token
     * 
     * @return void
     */
    public function __construct($token)
    {
        $this->provider = new HttpProvider($this->url . $token);
    }

    /**
     * 請求
     *
     * @param string $method
     * @param $params
     * 
     * @return array
     */
    public function request($method, $params = [])
    {
        return $this->provider->request('GET', $method, $params);
    }
}
