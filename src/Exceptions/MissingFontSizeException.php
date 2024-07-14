<?php

namespace BondarDe\FilamentLocalAvatar\Exceptions;

use Exception;

class MissingFontSizeException extends Exception
{
    public static function forLength(int $length): self
    {
        return new self('No font size found for text of length [' . $length . '].');
    }
}
