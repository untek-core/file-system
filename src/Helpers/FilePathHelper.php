<?php

namespace Untek\Core\FileSystem\Helpers;

class FilePathHelper
{

    /*public static function normalize($path)
    {
        $path = FilePathHelper::pathToAbsolute($path);
        return FileHelper::normalizePath($path);
    }*/

    public static function path(string $path = ''): string
    {
        $root = self::rootPath();
        $path = trim($path, '/');
        if ($path) {
            $root .= DIRECTORY_SEPARATOR . $path;
        }
        return $root;
    }

    public static function prepareRootPath($path)
    {
        $rootDir = __DIR__ . '/../../../../..';
        $path = str_replace('\\', '/', $path);
        if ($path[0] == '/') {
            return $rootDir . $path;
        }
        return $path;
    }

    public static function mb_basename($name, $ds = DIRECTORY_SEPARATOR)
    {
        $name = FileHelper::normalizePath($name);
        $nameArray = explode($ds, $name);
        $name = end($nameArray);
        return $name;
    }

    public static function fileExt($name)
    {
        return pathinfo($name, \PATHINFO_EXTENSION);
        /*$name = trim($name);
        $baseName = self::mb_basename($name);
        $start = strrpos($baseName, '.');
        if ($start) {
            $ext = substr($baseName, $start + 1);
            $ext = strtolower($ext);
            return $ext;
        }
        return null;*/
    }

    public static function fileNameOnly($name)
    {
        //return pathinfo($name, \PATHINFO_FILENAME); // проблема с кириличесикми символами
        $file_name = self::mb_basename($name);
        return FilePathHelper::fileRemoveExt($file_name);
    }

    public static function fileRemoveExt($name)
    {
        $ext = self::fileExt($name);
        $extLen = strlen($ext);
        if ($extLen) {
            return substr($name, 0, 0 - $extLen - 1);
        }
        return $name;
    }

    public static function pathToAbsolute($path)
    {
        $path = FileHelper::normalizePath($path);
        if (self::isAbsolute($path)) {
            return $path;
        }
        return self::rootPath() . DIRECTORY_SEPARATOR . $path;
    }

    public static function isAbsolute($path)
    {
        $pattern = '[/\\\\]|[a-zA-Z]:[/\\\\]|[a-z][a-z0-9+.-]*://';
        return (bool)preg_match("#$pattern#Ai", $path);
    }

    public static function rootPath()
    {
        return self::up(__DIR__, 7);
    }

    public static function trimRootPath($path)
    {
        if (!self::isAbsolute($path)) {
            return $path;
        }
        $rootLen = strlen(self::rootPath());
        return substr($path, $rootLen + 1);
    }

    public static function up($dir, $level = 1)
    {
        $dir = FileHelper::normalizePath($dir);
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);
        for ($i = 0; $i < $level; $i++) {
            $dir = dirname($dir);
        }
        return $dir;
    }

}
