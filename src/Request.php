<?php
declare(strict_types=1);

namespace WernerDweight\Curler;

use Safe\Exceptions\StringsException;

class Request
{
    /** @var string */
    private const DEFAULT_METHOD = 'GET';

    /** @var string|null */
    private $endpoint;

    /** @var string */
    private $method = self::DEFAULT_METHOD;

    /** @var array|null */
    private $payload;

    /** @var string[]|null */
    private $headers;

    /** @var string[]|null */
    private $authentication;

    /**
     * @param string $endpoint
     *
     * @return Request
     */
    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    /**
     * @param string $method
     *
     * @return Request
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param array $payload
     *
     * @return Request
     */
    public function setPayload(array $payload): self
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @param array $headers
     *
     * @return Request
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param string $header
     *
     * @return Request
     */
    public function addHeader(string $header): self
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * @param string $header
     *
     * @return bool
     */
    public function removeHeader(string $header): bool
    {
        if (null !== $this->headers) {
            foreach ($this->headers as $key => $currentHeader) {
                if ($currentHeader === $header) {
                    unset($this->headers[$key]);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return array|null
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    /**
     * @param string $user
     * @param string $password
     *
     * @return Request
     */
    public function setAuthentication(string $user, string $password): self
    {
        $this->authentication = [
            'user' => $user,
            'password' => $password,
        ];
        return $this;
    }

    /**
     * @return array|null
     */
    public function getAuthentication(): ?array
    {
        return $this->authentication;
    }

    /**
     * @param string $token
     *
     * @return Request
     *
     * @throws StringsException
     */
    public function setBearerAuthorization(string $token): self
    {
        return $this->addHeader(\Safe\sprintf('Authorization: Bearer %s', $token));
    }
}
