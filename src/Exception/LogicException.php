<?php

namespace PhpDDD\Domain\Exception;

use LogicException as Base;

/**
 * Exception that represents error in the program logic. This kind of exception should lead directly to a fix in your code.
 */
class LogicException extends Base implements DomainExceptionInterface
{
}
