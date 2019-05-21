<?php
declare(strict_types=1);

namespace WernerDweight\Curler\Tests;

use PHPUnit\Framework\TestCase;
use WernerDweight\Curler\Exception\CurlerException;
use WernerDweight\Curler\Response;
use WernerDweight\RA\RA;

/**
 * Response tests.
 */
class ResponseTest extends TestCase
{
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

    /**
     * Tests ok method.
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function testOk(): void
    {
        $response = new Response('', ['http_code' => 200]);
        $this->assertTrue($response->ok());
        $response = new Response('', ['http_code' => 300]);
        $this->assertFalse($response->ok());
    }

    /**
     * Tests redirected method.
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function testRedirected(): void
    {
        $response = new Response('', ['redirect_count' => 1]);
        $this->assertTrue($response->redirected());
        $response = new Response('', ['redirect_count' => 0]);
        $this->assertFalse($response->redirected());
    }

    /**
     * Tests status method.
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function testStatus(): void
    {
        $response = new Response('', ['http_code' => 200]);
        $this->assertSame(200, $response->status());
        $response = new Response('', ['http_code' => 300]);
        $this->assertSame(300, $response->status());
    }

    /**
     * Tests contentType method.
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function testContentType(): void
    {
        $response = new Response('', ['content_type' => 'text/html']);
        $this->assertSame('text/html', $response->contentType());
    }

    /**
     * Tests url method.
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function testUrl(): void
    {
        $response = new Response('', ['url' => 'https://localhost']);
        $this->assertSame('https://localhost', $response->url());
    }

    /**
     * Tests text method.
     */
    public function testText(): void
    {
        $response = new Response('any data', []);
        $this->assertSame('any data', $response->text());

        $response = new Response('{"type":"json","value":[{"id":1},{"id":2}]}', []);
        $this->assertSame('{"type":"json","value":[{"id":1},{"id":2}]}', $response->text());
    }

    /**
     * Tests json method.
     */
    public function testJson(): void
    {
        $response = new Response('{"type":"json","value":[{"id":1},{"id":2}]}', []);
        $this->assertSame(
            [
                'type' => 'json',
                'value' => [['id' => 1], ['id' => 2]],
            ],
            $response->json()->toArray(RA::RECURSIVE)
        );

        $this->expectException(CurlerException::class);
        $response = new Response('any data', []);
        $response->json();
    }
}
