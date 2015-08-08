<?php

namespace PhpDDD\Domain\Exception;

use BadMethodCallException as Base;

class BadMethodCallException extends Base implements DomainExceptionInterface
{
}
