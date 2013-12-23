<?php

namespace FSPDiscuss;

use Zend\ModuleManager\ModuleManager;

class Module
{
    protected static $options;

    public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->attach('loadModules.post', array($this, 'modulesLoaded'));
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'fspdiscuss_post_form_hydrator' => 'Zend\Stdlib\Hydrator\ClassMethods'
            ),
            'factories' => array(
                'fspdiscuss_discuss_service' => function($sm) {
                    $service = new \fspDiscuss\Service\Discuss;
                    $service->setThreadMapper($sm->get('fspdiscuss_thread_mapper'))
                            ->setMessageMapper($sm->get('fspdiscuss_message_mapper'))
                            ->setTagMapper($sm->get('fspdiscuss_tag_mapper'));
                    return $service;
                },
                'fspdiscuss_thread_mapper' => function($sm) {
                    $mapper = new \fspDiscuss\Model\Thread\ThreadMapper;
                    //$threadModelClass = static::getOption('thread_model_class');
                    $threadModelClass = Module::getOption('thread_model_class');
                    $mapper->setEntityPrototype(new $threadModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;

                },
                'fspdiscuss_tag_mapper' => function($sm) {
                    $mapper = new \fspDiscuss\Model\Tag\TagMapper;
                    //$tagModelClass = static::getOption('tag_model_class');
                    $tagModelClass = Module::getOption('tag_model_class');
                    $mapper->setEntityPrototype(new $tagModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'fspdiscuss_message_mapper' => function($sm) {
                    $mapper = new \fspDiscuss\Model\Message\MessageMapper;
                    //$messageModelClass = static::getOption('message_model_class');
                    $messageModelClass = Module::getOption('message_model_class');
                    $mapper->setEntityPrototype(new $messageModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'fspdiscuss_message' => function ($sm) {
                    $message = new \fspDiscuss\Model\Message\Message;
                    return $message;
                },
                'fspdiscuss_form' => function ($sm) {
                    $form = new \fspDiscuss\Form\PostForm;
                    return $form;
                },
                'fspdiscuss_thread_form' => function ($sm) {
                    $form = new \fspDiscuss\Form\PostThread;
                    return $form;
                },
            ),
            'initializers' => array(
                function($instance, $sm){
                    if($instance instanceof Service\DbAdapterAwareInterface){
                        $dbAdapter = $sm->get('fspdiscuss_zend_db_adapter');
                        return $instance->setDbAdapter($dbAdapter);
                    }
                },
            ),


            //'fspDiscuss\Service\Discuss' => array(
            //    'parameters' => array(
            //        'threadMapper'  => 'fspdiscuss_thread_mapper',
            //        'messageMapper' => 'fspdiscuss_message_mapper',
            //        'tagMapper'     => 'fspdiscuss_tag_mapper',
            //    )
            //),
        );

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function modulesLoaded($e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        static::$options = $config['fspdiscuss'];
    }

    /**
     * @TODO: Come up with a better way of handling module settings/options
     */
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        return static::$options[$option];
    }
}
