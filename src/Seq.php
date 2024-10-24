<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable;

use Immutable\Companions\SeqCompanion;

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
     * Returns an empty sequence.
     *
     * @return self<never>
     */
    public static function empty(): self
    {
        return SeqCompanion::empty();
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
    public function countBy(\Closure $p): int
    {
        $count = 0;
        foreach ($this->elements as $key => $value) {
            if ($p($value, $key)) {
                ++$count;
            }
        }
        return $count;
    }

    /**
     * {@inheritdoc}
     * @return self<T>
     */
    #[\Override]
    public function drop(int $n): Seq
    {
        return match (true) {
            $n <= 0 => $this,
            $n >= $this->size() => self::empty(),
            default => new self(array_slice($this->elements, $n)),
        };
    }

    #[\Override]
    public function each(\Closure $f): void
    {
        foreach ($this->elements as $index => $value) {
            $f($value, $index);
        }
    }

    #[\Override]
    public function exists(\Closure $p): bool
    {
        foreach ($this->elements as $index => $value) {
            if ($p($value, $index)) {
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     * @return self<T>
     */
    #[\Override]
    public function filter(\Closure $p): Seq
    {
        return new self(array_values(array_filter($this->elements, $p, ARRAY_FILTER_USE_BOTH)));
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * {@inheritdoc}
     * @template U
     * @param \Closure(T, int): U $f
     * @return self<U>
     */
    #[\Override]
    public function map(\Closure $f): self
    {
        return new self(iterator_to_array(SeqCompanion::map($this->elements, $f)));
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
    public function size(): int
    {
        return count($this->elements);
    }

    #[\Override]
    public function toArray(): array
    {
        return [...$this->elements];
    }

    #[\Override]
    public function toSeq(): Seq
    {
        return $this;
    }
}
