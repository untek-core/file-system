<?php

namespace Untek\Core\FileSystem\Entities;

abstract class BaseEntity
{

    const TYPE_DIRECTORY = 'directory';
    const TYPE_FILE = 'file';

    protected $type = null;
    protected $name = null;
    protected $path = null;

    abstract public function getType();

    public function setType($type): void
    {
        //$this->type = $type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path): void
    {
        $this->path = $path;
    }
}
