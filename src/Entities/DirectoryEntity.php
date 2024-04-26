<?php

namespace Untek\Core\FileSystem\Entities;

use Untek\Core\Collection\Libs\Collection;

class DirectoryEntity extends BaseEntity
{

    protected $items = null;

    public function getType()
    {
        return self::TYPE_DIRECTORY;
    }

    /**
     * @return null | Collection | FileEntity[]|DirectoryEntity[]
     */
    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): void
    {
        $this->items = $items;
    }
}
