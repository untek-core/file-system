<?php

namespace Untek\Core\FileSystem\Helpers;

use PATHINFO_EXTENSION;
use Symfony\Component\Mime\MimeTypes;
use Untek\Core\Arr\Helpers\ArrayHelper;

class MimeTypeHelper
{

    public static function getMimeTypeByFileName(string $fileName): ?string
    {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        return self::getMimeTypeByExt($ext);
    }

    public static function getMimeTypeByExt(string $ext): ?string
    {
        $types = self::getMimeTypesByExt($ext);
        return ArrayHelper::first($types);
    }

    public static function getMimeTypesByExt(string $ext): ?array
    {
        return MimeTypes::getDefault()->getMimeTypes($ext);
    }

    public static function getExtensionByMime(string $mimeType): ?string
    {
        $extensions = self::getExtensionsByMime($mimeType);
        return ArrayHelper::first($extensions);
    }

    public static function getExtensionsByMime(string $mimeType): ?array
    {
        return MimeTypes::getDefault()->getExtensions($mimeType);
    }
}
