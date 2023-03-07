# Telegram Bot Api

簡易Telegram bot api 功能

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## 安裝

```bash
composer require yx1hlqbk/telegram
```

## 環境要求

* \>= PHP 7.0

## 範例

```php
use Ian\TelegramApi\Telegram;

$botKey = '';
$chatId = '';

try {
    $telegram = new Telegram($botKey);
    $result = $telegram->sendMessage($chatId, '');
    var_dump($result);
} catch (\Throwable $th) {
    exit($th->getMessage());
}
```
