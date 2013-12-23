<?php

namespace FspDiscuss\Model\Tag;

use ZfcBase\Mapper\AbstractDbMapper;
use FspDiscuss\Module as FspDiscuss;
use FspDiscuss\Service\DbAdapterAwareInterface;

class TagMapper extends AbstractDbMapper implements TagMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'discuss_tag';

    /**
     * getTagById
     *
     * @param int $tagId
     * @return TagInterface
     */
    public function getTagById($tagId)
    {
        $select = $this->getSelect()
                       ->where(array('tag_id' => $tagId));

        return $this->select($select)->current();
    }
}
