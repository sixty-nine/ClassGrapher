<?php

namespace LazyGuy\PhpParse\Scanner\TokenFilter;

use LazyGuy\PhpParse\Scanner\Token;

class TokenTypeFilter implements TokenFilterInterface
{
    /**
     * The filtered out token type
     * @var int
     */
    protected $type;

    public function __construct($tokenType)
    {
        $this->type = $tokenType;
    }

    /**
     * @param Token $token
     * @return Token | null
     */
    function filter(Token $token)
    {
        if ($token->getType() === $this->type) {
            return null;
        }

        return $token;
    }
}
