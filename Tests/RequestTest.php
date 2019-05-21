<?php
declare(strict_types=1);

namespace WernerDweight\Curler\Tests;

use PHPUnit\Framework\TestCase;
use WernerDweight\Curler\Request;

/**
 * Request tests.
 */
class RequestTest extends TestCase
{
    /**
     * Tests setEndpoint and getEndpoint.
     */
    public function testSetGetEndpoint(): void
    {
        $request = new Request();
        $request->setEndpoint('endpoint');
        $this->assertSame('endpoint', $request->getEndpoint());
    }

    /**
     * Tests setMethod and getMethod.
     */
    public function testSetGetMethod(): void
    {
        $request = new Request();
        $request->setMethod('POST');
        $this->assertSame('POST', $request->getMethod());
    }

    /**
     * Tests setPayload and getPayload.
     */
    public function testSetGetPayload(): void
    {
        $request = new Request();
        $request->setPayload(['key' => ['value']]);
        $this->assertSame(['key' => ['value']], $request->getPayload());
    }

    /**
     * Tests setHeaders and getHeaders.
     */
    public function testSetGetHeaders(): void
    {
        $request = new Request();
        $request->setHeaders(['Content-Type: text/json', 'Origin: localhost']);
        $this->assertSame(['Content-Type: text/json', 'Origin: localhost'], $request->getHeaders());
    }

    /**
     * Tests addHeader.
     */
    public function testAddHeader(): void
    {
        $request = new Request();
        $request->setHeaders(['Content-Type: text/json', 'Origin: localhost']);
        $request->addHeader('X-Requested-By: Test');
        $this->assertSame(['Content-Type: text/json', 'Origin: localhost', 'X-Requested-By: Test'], $request->getHeaders());
    }

    /**
     * Tests removeHeader.
     */
    public function testRemoveHeader(): void
    {
        $request = new Request();
        $request->setHeaders(['Content-Type: text/json', 'Origin: localhost', 'X-Requested-By: Test']);
        $request->removeHeader('X-Requested-By: Test');
        $this->assertSame(['Content-Type: text/json', 'Origin: localhost'], $request->getHeaders());
    }

    /**
     * Tests setAuthentication and getAuthentication.
     */
    public function testSetGetAuthentication(): void
    {
        $request = new Request();
        $request->setAuthentication('user', 'password');
        $this->assertSame(['user' => 'user', 'password' => 'password'], $request->getAuthentication());
    }
}
