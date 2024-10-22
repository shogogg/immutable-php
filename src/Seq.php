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
use Immutable\Iterators\ReverseArrayIterator;

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

    /**
     * Creates a new instance from an iterable.
     *
     * @template U
     * @param iterable<int, U> $it
     * @return self<U>
     */
    private static function fromIterable(iterable $it): self
    {
        return new self(iterator_to_array($it));
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

    #[\Override]
    public function filter(\Closure $p): Seq
    {
        return new self(array_values(array_filter($this->elements, $p, ARRAY_FILTER_USE_BOTH)));
    }

    #[\Override]
    public function filterNot(\Closure $p): Seq
    {
        $q = fn (mixed $value, int $index): bool => !$p($value, $index);
        return new self(array_values(array_filter($this->elements, $q, ARRAY_FILTER_USE_BOTH)));
    }

    #[\Override]
    public function find(\Closure $p): Option
    {
        foreach ($this->elements as $index => $value) {
            if ($p($value, $index)) {
                return Some::of($value);
            }
        }
        return None::instance();
    }

    #[\Override]
    public function flatMap(\Closure $f): Seq
    {
        return self::fromIterable(SeqCompanion::flatMap($this->elements, $f));
    }

    #[\Override]
    public function flatten(): Seq
    {
        return self::fromIterable(SeqCompanion::flatten($this->elements));
    }

    #[\Override]
    public function fold($z, \Closure $op): mixed
    {
        $result = $z;
        foreach ($this->elements as $index => $value) {
            $result = $op($result, $value, $index);
        }
        return $result;
    }

    #[\Override]
    public function forAll(\Closure $p): bool
    {
        foreach ($this->elements as $index => $value) {
            if (!$p($value, $index)) {
                return false;
            }
        }
        return true;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->elements);
    }

    #[\Override]
    public function head(): mixed
    {
        foreach ($this->elements as $value) {
            return $value;
        }
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function headOption(): Option
    {
        foreach ($this->elements as $value) {
            return Some::of($value);
        }
        return None::instance();
    }

    #[\Override]
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    #[\Override]
    public function last(): mixed
    {
        $it = ReverseArrayIterator::of($this->elements);
        foreach ($it as $value) {
            return $value;
        }
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function lastOption(): Option
    {
        $it = ReverseArrayIterator::of($this->elements);
        foreach ($it as $value) {
            return Some::of($value);
        }
        return None::instance();
    }

    #[\Override]
    public function map(\Closure $f): self
    {
        return self::fromIterable(SeqCompanion::map($this->elements, $f));
    }

    #[\Override]
    public function max(): mixed
    {
        if ($this->isEmpty()) {
            throw new \LogicException('empty.max');
        }
        return max($this->elements);
    }

    #[\Override]
    public function maxBy(\Closure $f): mixed
    {
        if ($this->isEmpty()) {
            throw new \LogicException('empty.max');
        }
        $maxValue = null;
        $maxIndex = null;
        foreach ($this->elements as $index => $element) {
            $value = $f($element, $index);
            if ($maxValue === null || $value > $maxValue) {
                $maxValue = $value;
                $maxIndex = $index;
            }
        }
        return $this->elements[$maxIndex];
    }

    #[\Override]
    public function min(): mixed
    {
        if ($this->isEmpty()) {
            throw new \LogicException('empty.min');
        }
        return min($this->elements);
    }

    #[\Override]
    public function minBy(\Closure $f): mixed
    {
        if ($this->isEmpty()) {
            throw new \LogicException('empty.min');
        }
        $minValue = null;
        $minIndex = null;
        foreach ($this->elements as $index => $element) {
            $value = $f($element, $index);
            if ($minValue === null || $value < $minValue) {
                $minValue = $value;
                $minIndex = $index;
            }
        }
        return $this->elements[$minIndex];
    }

    #[\Override]
    public function nonEmpty(): bool
    {
        return !empty($this->elements);
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
