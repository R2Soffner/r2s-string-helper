<?php

namespace R2SStringHelper;

class Stringer
{
    private string $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function getString(): string
    {
        return $this->string;
    }

    public static function fromString(string $string): Stringer
    {
        return new self($string);
    }

    public function sanitize(): static
    {
        $this->string = filter_var($this->string, FILTER_SANITIZE_STRING);
        return $this;
    }

    public function trim(string $characters = " \t\n\r\0\x0B"): static
    {
        $this->string = trim($this->string, $characters);
        return $this;
    }

    public function upperCase(): static
    {
        $this->string = strtoupper($this->string);
        return $this;
    }

    public function replace(
        string|array $search,
        string|array $replace,
    ): static {
        $this->string = str_replace($search, $replace, $this->string);
        return $this;
    }

    public function replaceWithRegex(
        string|array $pattern,
        string|array $replace,
        int $limit = -1,
    ): static {
        $this->string = preg_replace($pattern, $replace, $this->string, $limit);
        return $this;
    }

    public function contains(string $needle): bool
    {
        return str_contains($this->string, $needle);
    }

    public static function concatenate(array $arrayOfStrings, string $separator = ' '): string
    {
        return implode(' ', $arrayOfStrings);
    }
}