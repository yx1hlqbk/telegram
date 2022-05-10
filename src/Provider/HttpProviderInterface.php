<?php

namespace Ian\TelegramApi\Provider;

interface HttpProviderInterface
{
    /**
     * request
     *
     * @param string $method
     * @param string $suffix
     * @param array $params
     * @return array
     */
    public function request($method = 'get', $suffix, $params): array;
}
