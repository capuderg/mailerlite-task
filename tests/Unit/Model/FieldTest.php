<?php

namespace Tests\Unit\Model;

use App\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    /** @var Field */
    private $field;

    public function setUp(): void
    {
        parent::setUp();

        $this->field = new Field();
    }

    /**
     * @param int    $dbValue
     * @param string $expected
     *
     * @dataProvider getTypeAttributeDataProvider
     */
    public function testGetTypeAttribute($dbValue, $expected)
    {
        $this->assertEquals($expected, $this->field->getTypeAttribute($dbValue));
    }

    public function getTypeAttributeDataProvider()
    {
        return [
            [
                'db value' => 1,
                'expected' => 'date',
            ],
            [
                'db value' => 2,
                'expected' => 'number',
            ],
            [
                'db value' => 3,
                'expected' => 'string',
            ],
            [
                'db value' => 4,
                'expected' => 'boolean',
            ],
        ];
    }
}
