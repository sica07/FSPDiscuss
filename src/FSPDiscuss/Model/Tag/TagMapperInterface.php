<?php

namespace FspDiscuss\Model\Tag;

interface TagMapperInterface
{
    /**
     * getTagById
     *
     * @param int $tagId
     * @return TagInterface
     */
    public function getTagById($tagId);
}
