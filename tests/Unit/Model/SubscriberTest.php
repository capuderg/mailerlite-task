<?php

namespace Tests\Unit\Model;

use App\Subscriber;
use PHPUnit\Framework\TestCase;

class SubscriberTest extends TestCase
{
    /** @var Subscriber */
    private $subscriber;

    public function setUp(): void
    {
        parent::setUp();

        $this->subscriber = new Subscriber();
    }

    /**
     * @param int    $dbValue
     * @param string $expected
     *
     * @dataProvider getStateAttributeDataProvider
     */
    public function testGetStateAttribute($dbValue, $expected)
    {
        $this->assertEquals($expected, $this->subscriber->getStateAttribute($dbValue));
    }

    public function getStateAttributeDataProvider()
    {
        return [
            [
                'db value' => 1,
                'expected' => 'active',
            ],
            [
                'db value' => 2,
                'expected' => 'unsubscribed',
            ],
            [
                'db value' => 3,
                'expected' => 'junk',
            ],
            [
                'db value' => 4,
                'expected' => 'bounced',
            ],
            [
                'db value' => 5,
                'expected' => 'unconfirmed',
            ],
        ];
    }
}
