<?php

namespace Somnambulist\Tests\Collection\Collection;

use PHPUnit\Framework\TestCase;
use Somnambulist\Collection\Collection;
use Somnambulist\Tests\Collection\Fixtures\TestClass1;
use Somnambulist\Tests\Collection\Fixtures\TestClass2;
use Somnambulist\Tests\Collection\Fixtures\TestClass3;
use Somnambulist\Tests\Collection\Fixtures\TestClass4;

/**
 * Class CollectionConstructorTest
 *
 * @package    Somnambulist\Tests\Collection\Collection
 * @subpackage Somnambulist\Tests\Collection\Collection\CollectionConstructorTest
 */
class CollectionConstructorTest extends TestCase
{

    /**
     * @group constructor
     */
    public function testCollect()
    {
        $col = Collection::collect(['foo' => 'bar']);

        $this->assertCount(1, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructor()
    {
        $col = new Collection();

        $this->assertInstanceOf(Collection::class, $col);
        $this->assertEmpty($col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithArray()
    {
        $col = new Collection(['foo' => 'bar']);

        $this->assertCount(1, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithNull()
    {
        $col = new Collection(null);

        $this->assertCount(0, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithCollection()
    {
        $col = new Collection(['foo' => 'bar']);
        $col2 = new Collection($col);

        $this->assertCount(1, $col2);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithStdClass()
    {
        $col = new \stdClass;
        $col->foo = 'bar';
        $col2 = new Collection($col);

        $this->assertCount(1, $col2);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithIterator()
    {
        $col = new \ArrayIterator(['foo' => 'bar']);
        $col2 = new Collection($col);

        $this->assertCount(1, $col2);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithArrayObject()
    {
        $col = new \ArrayObject(['foo' => 'bar']);
        $col2 = new Collection($col);

        $this->assertCount(1, $col2);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithScalar()
    {
        $col = new Collection('bar');

        $this->assertCount(1, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithObjectToArray()
    {
        $col = new Collection(new TestClass1());

        $this->assertCount(1, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithObjectAsArray()
    {
        $col = new Collection(new TestClass2());

        $this->assertCount(1, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithObjectToJson()
    {
        $col = new Collection(new TestClass3());

        $this->assertCount(1, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithObjectAsJson()
    {
        $col = new Collection(new TestClass4());

        $this->assertCount(1, $col);
    }

    /**
     * @group constructor
     */
    public function testConstructorWithNestedObjects()
    {
        $obj  = new \stdClass();
        $obj2 = new \stdClass();
        $obj3 = new \stdClass();
        $obj2->bar = 'baz';
        $obj2->bar = $obj3;

        $obj->foo = $obj2;

        $col = new Collection($obj);

        $this->assertCount(1, $col);
    }
}
