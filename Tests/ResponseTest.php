<?php
declare(strict_types=1);

namespace WernerDweight\Curler\Tests;

use PHPUnit\Framework\TestCase;
use WernerDweight\Curler\Response;

/**
 * Response tests.
 */
class ResponseTest extends TestCase
{
    /**
     * Tests getResponse method.
     */
    public function testGetResponse(): void
    {
        $response = new Response('any data', []);
        $this->assertSame('any data', $response->getResponse());

        $response = new Response('{"type":"json","value":[{"id":1},{"id":2}]}', []);
        $this->assertSame('{"type":"json","value":[{"id":1},{"id":2}]}', $response->getResponse());
    }

    /**
     * Tests getMetaData method.
     */
    public function testGetMetaData(): void
    {
        $response = new Response('', [
            'http_code' => 200,
            'http_status' => 'ok',
        ]);
        $this->assertSame([
            'http_code' => 200,
            'http_status' => 'ok',
        ], $response->getMetaData()->toArray());
    }
}
