<?php

namespace FspDiscuss\Model\Message;

interface MessageMapperInterface
{
    /**
     * getMessageById
     *
     * @param int $messageId
     * @return MessageInterface
     */
    public function getMessageById($messageId);

    /**
     * getMessagesByThread
     *
     * @param int $threadId
     * @param int $limit
     * @param int $offest
     * @return array of FspDiscuss\Model\Message\MessageInterface's
     */
    public function getMessagesByThread($threadId, $limit = 25, $offset = 0);

    /**
     * persist
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function persist(MessageInterface $message);

    /**
     * getPrivateMessages
     *
     * @param int $userId
     * @return MessageInterface
     */
    public function getPrivateMessages($userId);

}
