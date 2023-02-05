<?php

namespace Untek\Core\Base\Tests\Unit;

use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Core\FileSystem\Helpers\FindFileHelper;
use Untek\Core\FileSystem\Helpers\MimeTypeHelper;
use Untek\Tool\Test\Asserts\DataAssert;
use Untek\Tool\Test\Asserts\DataTestCase;

final class FileHelperTest extends DataTestCase
{

    public function testScanDirTree()
    {
        $tree = FindFileHelper::scanDirTree(__DIR__ . '/../data/scanDirTree/i18next');
        $array = CollectionHelper::toArray($tree);
        $expected = $this->loadFromJsonFile(__DIR__ . '/../data/FileHelper/testScanDirTree.json');
        $this->assertArraySubset($expected, $array);
    }

    public function testGetMimeTypes()
    {
        $types = MimeTypeHelper::getMimeTypesByExt('json');

        $this->assertEquals([
            "application/json",
            "application/schema+json",
        ], $types);
    }

    public function testGetMimeType()
    {
        $types = MimeTypeHelper::getMimeTypeByExt('json');

        $this->assertEquals("application/json", $types);
    }

    public function testGetExtensions()
    {
        $extensions = MimeTypeHelper::getExtensionsByMime('application/json');

        $this->assertEquals([
            'json',
            'map',
        ], $extensions);
    }

    public function testGetExtension()
    {
        $extensions = MimeTypeHelper::getExtensionByMime('application/json');

        $this->assertEquals('json', $extensions);
    }
}
