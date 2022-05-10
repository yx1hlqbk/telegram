<?php

namespace Ian\TelegramApi;

use Ian\TelegramApi\Provider\HttpProvider;

class Telegram
{
    /**
     * 
     * @var \Ian\TelegramApi\TelegramManager
     */
    private $manager;

    /**
     * 初始化
     * 
     * @param string $token
     * 
     * @return void
     */
    public function __construct($token)
    {
        $this->manager = new TelegramManager($token);
    }

    /**
     * 傳送文字訊息
     *
     * @param int|string $chatId
     * @param string $text
     * @param string|null $parseMode
     * @param bool $disablePreview
     * @param int|null $replyToMessageId
     * @param bool $disableNotification
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function sendMessage(
        $chatId,
        $text,
        $parseMode = null,
        $disablePreview = false,
        $replyToMessageId = null,
        $disableNotification = false
    ) {
        return $this->manager->request('sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => $disablePreview,
            'reply_to_message_id' => (int) $replyToMessageId,
            'disable_notification' => (bool) $disableNotification,
        ]);
    }

    /**
     * 複製文字
     * 
     * @param int|string $chatId
     * @param int|string $fromChatId
     * @param int $messageId
     * @param string|null $caption
     * @param string|null $parseMode
     * @param bool $disableNotification
     * @param int|null $replyToMessageId
     * @param bool $allowSendingWithoutReply
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function copyMessage(
        $chatId,
        $fromChatId,
        $messageId,
        $caption = null,
        $parseMode = null,
        $disableNotification = false,
        $replyToMessageId = null,
        $allowSendingWithoutReply = false
    ) {
        return $this->manager->request('copyMessage', [
            'chat_id' => $chatId,
            'from_chat_id' => $fromChatId,
            'message_id' => (int) $messageId,
            'caption' => $caption,
            'parse_mode' => $parseMode,
            'disable_notification' => (bool) $disableNotification,
            'reply_to_message_id' => (int) $replyToMessageId,
            'allow_sending_without_reply' => (bool) $allowSendingWithoutReply,
        ]);
    }

    /**
     * 傳送照片
     *
     * @param int|string $chatId
     * @param string $photo
     * @param string|null $caption
     * @param int|null $replyToMessageId
     * @param bool $disableNotification
     * @param string|null $parseMode
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function sendPhoto(
        $chatId,
        $photo,
        $caption = null,
        $replyToMessageId = null,
        $disableNotification = false,
        $parseMode = null
    ) {
        return $this->manager->request('sendPhoto', [
            'chat_id' => $chatId,
            'photo' => $photo,
            'caption' => $caption,
            'reply_to_message_id' => $replyToMessageId,
            'disable_notification' => (bool)$disableNotification,
            'parse_mode' => $parseMode
        ]);
    }

    /**
     * 傳送影音(mp3/mp4)
     *
     * @param int|string $chatId
     * @param string $photo
     * @param string|null $caption
     * @param int|null $replyToMessageId
     * @param bool $disableNotification
     * @param string|null $parseMode
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function sendAudio(
        $chatId,
        $audio,
        $caption = null,
        $replyToMessageId = null,
        $disableNotification = false,
        $parseMode = null
    ) {
        return $this->manager->request('sendAudio', [
            'chat_id' => $chatId,
            'audio' => $audio,
            'caption' => $caption,
            'reply_to_message_id' => $replyToMessageId,
            'disable_notification' => (bool)$disableNotification,
            'parse_mode' => $parseMode
        ]);
    }

    /**
     * 傳送文件
     * 
     * @param int|string $chatId
     * @param string $document
     * @param string|null $caption
     * @param int|null $replyToMessageId
     * @param bool $disableNotification
     * @param string|null $parseMode
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function sendDocument(
        $chatId,
        $document,
        $caption = null,
        $replyToMessageId = null,
        $replyMarkup = null,
        $disableNotification = false,
        $parseMode = null
    ) {
        return $this->manager->request('sendDocument', [
            'chat_id' => $chatId,
            'document' => $document,
            'caption' => $caption,
            'reply_to_message_id' => $replyToMessageId,
            'disable_notification' => (bool)$disableNotification,
            'parse_mode' => $parseMode
        ]);
    }

    /**
     * 取得檔案資訊
     * 
     * @param int|string $fileId
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function getFile($fileId)
    {
        return $this->manager->request('getFile', [
            'file_id' => $fileId
        ]);
    }

    /**
     * 傳送聯絡資訊
     *
     * @param int|string $chatId 
     * @param string $phoneNumber
     * @param string $firstName
     * @param string $lastName
     * @param int|null $replyToMessageId
     * @param bool $disableNotification
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function sendContact(
        $chatId,
        $phoneNumber,
        $firstName,
        $lastName = null,
        $replyToMessageId = null,
        $disableNotification = false
    ) {
        return $this->manager->request('sendContact', [
            'chat_id' => $chatId,
            'phone_number' => $phoneNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'reply_to_message_id' => $replyToMessageId,
            'disable_notification' => (bool) $disableNotification,
        ]);
    }

    /**
     * 取得聊天室/人資訊
     * 
     * @param int|string $chatId
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function getChat($chatId)
    {
        return $this->manager->request('getChat', [
            'chat_id' => $chatId
        ]);
    }

    /**
     * 取得聊天室成員資訊
     * 
     * @param int|string $chatId
     * @param int|string $userId
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function getChatMember($chatId, $userId)
    {
        return $this->manager->request('getChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId
        ]);
    }

    /**
     * 設置聊天室抬頭
     * 
     * @param int|string $chatId
     * @param string $title
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function setChatTitle($chatId, $title)
    {
        return $this->manager->request('setChatTitle', [
            'chat_id' => $chatId,
            'title' => $title
        ]);
    }

    /**
     * 設置聊天室描述
     * 
     * @param int|string $chatId
     * @param string $description
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function setChatDescription($chatId, $description = null)
    {
        return $this->manager->request('setChatDescription', [
            'chat_id' => $chatId,
            'title' => $description
        ]);
    }

    /**
     * 匯出聊天室邀請連結
     * 
     * @param int|string $chatId
     *
     * @return \Ian\TelegramApi\Provider\HttpProvider
     */
    public function exportChatInviteLink($chatId)
    {
        return $this->manager->request('exportChatInviteLink', [
            'chat_id' => $chatId
        ]);
    }
}
