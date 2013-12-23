<?php

namespace FspDiscuss\Service;

use Zend\Db\Adapter\Adapter;

interface DbAdapterAwareInterface
{
    public function setDbAdapter(Adapter $dbAdapter);
}
