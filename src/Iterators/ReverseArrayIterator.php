<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable\Iterators;

/**
 * Iterator for array in reverse order.
 *
 * @template-covariant T
 * @implements \Iterator<T>
 */
final class ReverseArrayIterator implements \Countable, \Iterator
{
    /**
     * {@see \Immutable\Iterators\ReverseArrayIterator} constructor.
     *
     * @param T[] $array
     */
    public function __construct(private array $array)
    {
        $this->rewind();
    }

    /**
     * Creates a new instance.
     *
     * @template U
     * @param U[] $array
     * @return self<U>
     */
    public static function of(array $array): self
    {
        return new self($array);
    }

    /** {@inheritdoc} */
    public function count(): int
    {
        return count($this->array);
    }

    /** {@inheritdoc} */
    public function current(): mixed
    {
        // @phpstan-ignore return.type
        return current($this->array);
    }

    /** {@inheritdoc} */
    public function key(): string|int|null
    {
        return key($this->array);
    }

    /** {@inheritdoc} */
    public function next(): void
    {
        prev($this->array);
    }

    /** {@inheritdoc} */
    public function rewind(): void
    {
        end($this->array);
    }

    /** {@inheritdoc} */
    public function valid(): bool
    {
        return key($this->array) !== null;
    }
}
