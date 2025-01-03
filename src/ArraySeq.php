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
 * A {@see \Immutable\Seq} implementation using an array.
 *
 * @immutable
 * @template-covariant T
 * @extends \Immutable\Seq<T>
 */
final readonly class ArraySeq extends Seq
{
    /**
     * {@see \Immutable\ArraySeq} constructor.
     *
     * @param T[] $elements
     * @phpstan-param array<int, T> $elements
     */
    private function __construct(private array $elements)
    {
    }

    /**
     * Creates a new instance.
     *
     * @template U
     * @param U ...$elements
     * @return \Immutable\Seq<U>
     */
    #[\Override]
    public static function of(mixed ...$elements): Seq
    {
        /** @var U[] $elements */
        return empty($elements) ? self::empty() : new self($elements);
    }

    /**
     * Creates a new instance from an iterable.
     *
     * @template U
     * @param iterable<int, U> $it
     * @return \Immutable\Seq<U>
     */
    #[\Override]
    public static function from(iterable $it): Seq
    {
        return self::of(...$it);
    }

    #[\Override]
    public function contains(mixed $element): bool
    {
        return in_array($element, $this->elements, true);
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
        foreach ($this->elements as $index => $value) {
            if ($p($value, $index)) {
                ++$count;
            }
        }
        return $count;
    }

    #[\Override]
    public function distinct(): Seq
    {
        return new self(array_values(array_unique($this->elements, SORT_REGULAR)));
    }

    #[\Override]
    public function distinctBy(\Closure $f): Seq
    {
        $keys = [];
        $values = [];
        foreach ($this->elements as $index => $value) {
            $key = $f($value, $index);
            if (!in_array($key, $keys, true)) {
                $keys[] = $key;
                $values[] = $value;
            }
        }
        return new self($values);
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
    public function dropRight(int $n): Seq
    {
        return match (true) {
            $n <= 0 => $this,
            $n >= $this->size() => self::empty(),
            default => new self(array_slice($this->elements, 0, -$n)),
        };
    }

    #[\Override]
    public function dropWhile(\Closure $p): Seq
    {
        $q = self::invert($p);
        $offset = $this->indexWhere($q);
        return $offset === -1
            ? self::empty()
            : new self(array_slice($this->elements, $offset));
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
        $q = self::invert($p);
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
        return self::from(SeqCompanion::flatMap($this->elements, $f));
    }

    #[\Override]
    public function flatten(): Seq
    {
        return self::from(SeqCompanion::flatten($this->elements));
    }

    #[\Override]
    public function fold($z, \Closure $op): mixed
    {
        return $this->foldLeft($z, $op);
    }

    #[\Override]
    public function foldLeft($z, \Closure $op): mixed
    {
        $result = $z;
        foreach ($this->elements as $index => $value) {
            $result = $op($result, $value, $index);
        }
        return $result;
    }

    #[\Override]
    public function foldRight($z, \Closure $op): mixed
    {
        $result = $z;
        $it = ReverseArrayIterator::of($this->elements);
        foreach ($it as $index => $value) {
            $result = $op($value, $result, $index);
        }
        return $result;
    }

    #[\Override]
    public function forAll(\Closure $p): bool
    {
        $q = self::invert($p);
        foreach ($this->elements as $index => $value) {
            if ($q($value, $index)) {
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
        return $this->elements[0];
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
    public function indexOf(mixed $element, int $from = 0): int
    {
        $index = array_search($element, array_slice($this->elements, $from), true);
        return $index === false ? -1 : $index + $from;
    }

    #[\Override]
    public function indexWhere(\Closure $p, int $from = 0): int
    {
        $from = max($from, 0);
        foreach (array_slice($this->elements, $from) as $index => $value) {
            if ($p($value, $index)) {
                return $index;
            }
        }
        return -1;
    }

    #[\Override]
    public function init(): Seq
    {
        return count($this->elements) === 1 ? self::empty() : new self(array_slice($this->elements, 0, -1));
    }

    #[\Override]
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    #[\Override]
    public function last(): mixed
    {
        return $this->elements[count($this->elements) - 1];
    }

    #[\Override]
    public function lastIndexOf(mixed $element, ?int $end = null): int
    {
        $length = $end === null ? count($this->elements) : $end + 1;
        $xs = array_reverse(array_slice($this->elements, 0, $length));
        $index = array_search($element, $xs, true);
        return $index === false ? -1 : $length - $index - 1;
    }

    #[\Override]
    public function lastIndexWhere(\Closure $p, ?int $end = null): int
    {
        $length = $end === null ? count($this->elements) : $end + 1;
        $xs = array_reverse(array_slice($this->elements, 0, $length));
        foreach ($xs as $index => $value) {
            if ($p($value, $index)) {
                return $length - $index - 1;
            }
        }
        return -1;
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
    public function map(\Closure $f): Seq
    {
        return self::from(SeqCompanion::map($this->elements, $f));
    }

    #[\Override]
    public function max(): mixed
    {
        return max($this->elements);
    }

    #[\Override]
    public function maxBy(\Closure $f): mixed
    {
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
        return min($this->elements);
    }

    #[\Override]
    public function minBy(\Closure $f): mixed
    {
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
    public function mkString(string $sep = ''): string
    {
        return implode($sep, $this->elements);
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
    public function reverse(): Seq
    {
        return new self(array_reverse($this->elements));
    }

    #[\Override]
    public function size(): int
    {
        return count($this->elements);
    }

    #[\Override]
    public function sorted(): Seq
    {
        // $xs is not a reference to $this->elements, so it's safe to sort it.
        $xs = $this->elements;
        sort($xs);
        return new self($xs);
    }

    #[\Override]
    public function sum(): int|float
    {
        if ($this->exists(fn (mixed $x): bool => !is_int($x) && !is_float($x))) {
            throw new \LogicException("Sum of non-numeric value is not supported");
        }
        return array_sum($this->elements);
    }

    #[\Override]
    public function sumOf(\Closure $f): int|float
    {
        $result = 0;
        foreach ($this->elements as $index => $value) {
            $value = $f($value, $index);
            // @phpstan-ignore booleanAnd.alwaysFalse
            if (!is_int($value) && !is_float($value)) {
                throw new \LogicException("Sum of non-numeric value is not supported");
            }
            $result += $value;
        }
        return $result;
    }

    #[\Override]
    public function tail(): Seq
    {
        return count($this->elements) === 1 ? self::empty() : new self(array_slice($this->elements, 1));
    }

    #[\Override]
    public function take(int $n): Seq
    {
        return match (true) {
            $n <= 0 => self::empty(),
            $n >= $this->size() => $this,
            default => new self(array_slice($this->elements, 0, $n)),
        };
    }

    #[\Override]
    public function takeRight(int $n): Seq
    {
        return match (true) {
            $n <= 0 => self::empty(),
            $n >= $this->size() => $this,
            default => new self(array_slice($this->elements, -$n)),
        };
    }

    #[\Override]
    public function takeWhile(\Closure $p): Seq
    {
        $q = self::invert($p);
        $length = $this->indexWhere($q);
        return $length === -1
            ? $this
            : new self(array_slice($this->elements, 0, $length));
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

    /**
     * Returns a new function that returns the logical negation of the given predicate.
     *
     * @param \Closure(T, int): bool $p
     * @return \Closure(T, int): bool
     */
    private static function invert(\Closure $p): \Closure
    {
        return fn (mixed $value, int $index): bool => !$p($value, $index);
    }
}
