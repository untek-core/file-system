<?php

namespace Untek\Core\FileSystem\Entities;

class DirectoryEntity extends BaseEntity
{

    protected $items = null;

    public function getType()
    {
        return self::TYPE_DIRECTORY;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): void
    {
        $this->items = $items;
    }
}
