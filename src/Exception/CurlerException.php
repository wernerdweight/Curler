<?php
declare(strict_types=1);

namespace WernerDweight\Curler\Exception;

final class CurlerException extends \Exception implements \Throwable
{
    /** @var int */
    public const INVALID_JSON = 1;

    /** @var string[] */
    private const MESSAGES = [
        self::INVALID_JSON => 'Response is not a valid JSON expression!',
    ];

    /**
     * @param int    $code
     * @param string ...$payload
     */
    public function __construct(int $code, string ...$payload)
    {
        parent::__construct(sprintf(self::MESSAGES[$code], ...$payload), $code);
    }
}
