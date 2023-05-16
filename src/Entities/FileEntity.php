<?php

namespace Untek\Core\FileSystem\Entities;

class FileEntity extends BaseEntity
{

    protected $size = null;

    public function getType()
    {
        return self::TYPE_FILE;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size): void
    {
        $this->size = $size;
    }
}
