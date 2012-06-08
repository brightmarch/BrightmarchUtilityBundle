<?php

namespace Brightmarch\UtilityBundle\Tests\Unit\Utility\Parser;

use Brightmarch\UtilityBundle\Utility\Parser\JsonParser;
use Brightmarch\UtilityBundle\Tests\TestCase;

use \StdClass;

/**
 * @group BrightmarchUtilityBundle
 * @group BrightmarchUtilityBundleUnitJsonParser
 */
class JsonParserTest extends TestCase
{

    public function testGetterReturnsJsonValueForValidJson()
    {
        $json = '{"id": 123}';
        $parser = new JsonParser($json);

        $this->assertEquals($parser->id, 123);
        $this->assertNull($parser->abc);
    }

    public function testGetterReturnsNullValueForInvalidJson()
    {
        $json = 'null';
        $parser = new JsonParser($json);

        $this->assertNull($parser->id);
    }

    public function testIsValidReturnsTrueForValidJson()
    {
        $json = '{"id": 10}';
        $parser = new JsonParser($json);
        
        $this->assertTrue($parser->isValid());
    }

    public function testIsValidReturnsFalseForInvalidJson()
    {
        $json = 'null';
        $parser = new JsonParser($json);
        
        $this->assertFalse($parser->isValid());
    }

    public function testIsObjectReturnsTrueForObjects()
    {
        $json = '{"id": 10}';
        $parser = new JsonParser($json);
        
        $this->assertTrue($parser->isObject());
    }

    public function testIsArrayReturnsTrueForArrays()
    {
        $json = '[{"id": 10}]';
        $parser = new JsonParser($json);
        
        $this->assertTrue($parser->isArray());
    }

    public function testHasKeysReturnsTrueForAllMatchingKeys()
    {
        $json = '{"id": 10, "name": "bobby", "age": 15}';
        $parser = new JsonParser($json);

        $this->assertTrue($parser->hasKeys('id', 'age'));
    }

    public function testHasKeysReturnsFalseForAllNoSearchKeys()
    {
        $json = '{"id": 10, "name": "bobby", "age": 15}';
        $parser = new JsonParser($json);

        $this->assertFalse($parser->hasKeys());
    }

    public function testHasKeysReturnsFalseForInvalidKeys()
    {
        $json = '{"id": 10, "name": "bobby", "age": 15}';
        $parser = new JsonParser($json);

        $this->assertFalse($parser->hasKeys('id', 'age', 'height'));
    }

    public function testHasKeysReturnsFalseForInvalidJsonWithSearchKeys()
    {
        $parser = new JsonParser('null');

        $this->assertFalse($parser->isValid());
        $this->assertFalse($parser->hasKeys('id'));
    }

    public function testHasKeysReturnsFalseForInvalidJsonWithOutSearchKeys()
    {
        $parser = new JsonParser('null');

        $this->assertFalse($parser->isValid());
        $this->assertFalse($parser->hasKeys());
    }

}
