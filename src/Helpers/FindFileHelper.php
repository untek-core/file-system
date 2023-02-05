<?php

namespace Untek\Core\FileSystem\Helpers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Collection\Libs\Collection;
use Untek\Core\FileSystem\Entities\DirectoryEntity;
use Untek\Core\FileSystem\Entities\FileEntity;

class FindFileHelper
{

    public static function filterPathList($pathList, $options, $basePath = null)
    {
        if (empty($pathList)) {
            return $pathList;
        }
        $result = [];
        if (!empty($options)) {
            if (!isset($options['basePath']) && !empty($basePath)) {
                $options['basePath'] = realpath($basePath);
            }
        }
        $options = FileHelper::normalizeOptions($options);
        foreach ($pathList as $path) {
            if (FileHelper::filterPath($path, $options)) {
                $result[] = $path;
            }
        }
        return $result;
    }

    public static function scanDir($dir, $options = null)
    {
        if (!FileStorageHelper::has($dir)) {
            return [];
        }
        $pathList = scandir($dir);
        ArrayHelper::removeByValue('.', $pathList);
        ArrayHelper::removeByValue('..', $pathList);
        if (empty($pathList)) {
            return [];
        }
        if (!empty($options)) {
            $pathList = self::filterPathList($pathList, $options, $dir);
        }
        sort($pathList);
        return $pathList;
    }

    public static function scanDirTree($dir, $options = null)
    {
        $collection = new Collection();
        $list = self::scanDir($dir);
        foreach ($list as $name) {
            $path = $dir . '/' . $name;
            if (is_dir($path)) {
                $entity = new DirectoryEntity();
                $entity->setItems(self::scanDirTree($path, $options));
            } elseif (is_file($path)) {
                $entity = new FileEntity();
                $entity->setSize(filesize($path));
            } else {
                throw new \Exception();
            }
            $entity->setName($name);
            $entity->setPath($path);
            if ($entity instanceof DirectoryEntity || FileHelper::filterPath($path, $options)) {
                $collection->add($entity);
            }
        }
        return $collection;
    }
}