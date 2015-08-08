<?php

namespace PhpDDD\Domain\Exception;

use InvalidArgumentException as Base;

/**
 * Exception thrown if an argument is not of the expected type.
 */
class InvalidArgumentException extends Base implements DomainExceptionInterface
{
}
