<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable;

/**
 * Some.
 *
 * @template-covariant T
 * @extends \Immutable\Option<T>
 */
final class Some extends Option
{
    /**
     * {@see \Immutable\Some} constructor.
     *
     * @param T $value the value
     */
    private function __construct(private readonly mixed $value)
    {
    }

    /**
     * Creates a new instance.
     *
     * @template U
     * @param U $value
     * @return self<U>
     */
    public static function of(mixed $value): self
    {
        return new self($value);
    }

    #[\Override]
    public function count(): int
    {
        return 1;
    }

    #[\Override]
    public function countBy(\Closure $p): int
    {
        return $p($this->value, 0) ? 1 : 0;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator([$this->value]);
    }

    #[\Override]
    public function get(): mixed
    {
        return $this->value;
    }

    /**
     * @template U
     * @param \Closure(T, int): U $f
     * @return self<U>
     */
    #[\Override]
    public function map(\Closure $f): self
    {
        return self::of($f($this->value, 0));
    }

    #[\Override]
    public function offsetExists(mixed $offset): bool
    {
        return $offset === 0;
    }

    #[\Override]
    public function offsetGet(mixed $offset): mixed
    {
        if ($offset === 0) {
            return $this->value;
        } else {
            throw new \OutOfBoundsException("Undefined offset: $offset");
        }
    }

    #[\Override]
    public function toArray(): array
    {
        return [$this->value];
    }

    #[\Override]
    public function toSeq(): Seq
    {
        return Seq::of($this->value);
    }
}
