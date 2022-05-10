# Telegram Bot Api

簡易Telegram bot api 功能

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Issues](https://img.shields.io/github/issues/iexbase/tron-api.svg)](https://github.com/yx1hlqbk/telegram/issues)
[![Pull Requests](https://img.shields.io/github/issues-pr/iexbase/tron-api.svg)](https://github.com/yx1hlqbk/telegram/pulls)
[![Contributors](https://img.shields.io/github/contributors/iexbase/tron-api.svg)](https://github.com/yx1hlqbk/telegram/graphs/contributors)

## 安裝

```bash
> composer require yx1hlqbk/telegram
```

## 環境要求

* \>= PHP 7.0

## 範例

```php
use Ian\TelegramApi\Telegram;

$botKey = '';

try {
    $telegram = new Telegram($botKey);
    $result = $telegram->sendMessage('1835191163', '');
    var_dump($result);
} catch (\Throwable $th) {
    exit($th->getMessage());
}
```
