<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable;

use Immutable\Helpers\SeqHelper;

/**
 * Sequence.
 *
 * @template-covariant T
 * @implements \Immutable\SeqLike<T>
 */
final readonly class Seq implements SeqLike
{
    /**
     * {@see \Immutable\Seq} constructor.
     *
     * @param T[] $elements
     */
    private function __construct(private array $elements)
    {
    }

    /**
     * Creates a new instance.
     *
     * @template U
     * @param U ...$elements
     * @return self<U>
     */
    public static function of(mixed ...$elements): self
    {
        /** @var U[] $elements */
        return new self($elements);
    }

    #[\Override]
    public function count(): int
    {
        return count($this->elements);
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * @template U
     * @param \Closure(T, int): U $f
     * @return self<U>
     */
    #[\Override]
    public function map(\Closure $f): self
    {
        return new self(iterator_to_array(SeqHelper::map($this->elements, $f)));
    }

    #[\Override]
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->elements[$offset]);
    }

    #[\Override]
    public function offsetGet(mixed $offset): mixed
    {
        if (isset($this->elements[$offset])) {
            return $this->elements[$offset];
        } else {
            throw new \OutOfBoundsException("Undefined offset: $offset");
        }
    }

    #[\Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \BadMethodCallException();
    }

    #[\Override]
    public function offsetUnset(mixed $offset): void
    {
        throw new \BadMethodCallException();
    }

    #[\Override]
    public function toArray(): array
    {
        return [...$this->elements];
    }
}
