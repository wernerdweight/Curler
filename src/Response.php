<?php
declare(strict_types=1);

namespace WernerDweight\Curler;

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
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @return RA
     */
    public function getMetaData(): RA
    {
        return $this->metadata;
    }
}
