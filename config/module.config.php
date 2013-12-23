<?php
return array(
    'fspdiscuss' => array(
        'thread_model_class'  => 'FspDiscuss\Model\Thread\Thread',
        'message_model_class' => 'FspDiscuss\Model\Message\Message',
        'tag_model_class'     => 'FspDiscuss\Model\Tag\Tag',
    ),
    'service_manager' => array(
        'aliases' => array(
            'fspdiscuss_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),
);
