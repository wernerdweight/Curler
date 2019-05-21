<?php
declare(strict_types=1);

namespace WernerDweight\Curler;

use WernerDweight\Curler\Exception\CurlerException;
use WernerDweight\RA\RA;

class Response
{
    /** @var string */
    private $response;

    /** @var RA */
    private $metadata;

    /**
     * Response constructor.
     *
     * @param string $response
     * @param array  $metadata
     */
    public function __construct(string $response, array $metadata)
    {
        $this->response = $response;
        $this->metadata = new RA($metadata, RA::RECURSIVE);
    }

    /**
     * @return RA
     */
    public function getMetaData(): RA
    {
        return $this->metadata;
    }

    /**
     * @return bool
     *
     * @throws \WernerDweight\RA\Exception\RAException
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    public function ok(): bool
    {
        $status = $this->status();
        return $status >= 200 && $status < 300;
    }

    /**
     * @return bool
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function redirected(): bool
    {
        return $this->getMetaData()->getInt('redirect_count') > 0;
    }

    /**
     * @return int
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function status(): int
    {
        return $this->getMetaData()->getInt('http_code');
    }

    /**
     * @return string
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function contentType(): string
    {
        return $this->getMetaData()->getString('content_type');
    }

    /**
     * @return string
     *
     * @throws \WernerDweight\RA\Exception\RAException
     */
    public function url(): string
    {
        return $this->getMetaData()->getString('url');
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->response;
    }

    /**
     * @return RA
     *
     * @throws CurlerException
     */
    public function json(): RA
    {
        $decoded = json_decode($this->response, true);
        if (null === $decoded) {
            throw new CurlerException(CurlerException::INVALID_JSON);
        }
        return new RA($decoded, RA::RECURSIVE);
    }
}
