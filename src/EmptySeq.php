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
 * A {@see \Immutable\Seq} implementation that represents an empty sequence.
 *
 * @immutable
 * @extends \Immutable\Seq<never>
 */
final readonly class EmptySeq extends Seq
{
    /**
     * Creates a new instance.
     *
     * @return self
     */
    public static function instance(): self
    {
        return new self();
    }

    #[\Override]
    public static function of(...$elements): never
    {
        throw new \BadMethodCallException('Cannot create an instance of EmptySeq using of() method.');
    }

    #[\Override]
    public static function from(iterable $it): never
    {
        throw new \BadMethodCallException('Cannot create an instance of EmptySeq using fromIterable() method.');
    }

    #[\Override]
    public function contains(mixed $element): bool
    {
        return false;
    }

    #[\Override]
    public function count(): int
    {
        return 0;
    }

    #[\Override]
    public function countBy(\Closure $p): int
    {
        return 0;
    }

    #[\Override]
    public function distinct(): Seq
    {
        return $this;
    }

    #[\Override]
    public function distinctBy(\Closure $f): Seq
    {
        return $this;
    }

    #[\Override]
    public function drop(int $n): Seq
    {
        return $this;
    }

    #[\Override]
    public function dropRight(int $n): Seq
    {
        return $this;
    }

    #[\Override]
    public function dropWhile(\Closure $p): Seq
    {
        return $this;
    }

    #[\Override]
    public function each(\Closure $f): void
    {
        // Nothing to do.
    }

    #[\Override]
    public function exists(\Closure $p): bool
    {
        return false;
    }

    #[\Override]
    public function filter(\Closure $p): Seq
    {
        return $this;
    }

    #[\Override]
    public function filterNot(\Closure $p): Seq
    {
        return $this;
    }

    #[\Override]
    public function find(\Closure $p): Option
    {
        return None::instance();
    }

    #[\Override]
    public function flatMap(\Closure $f): Seq
    {
        return $this;
    }

    #[\Override]
    public function flatten(): Seq
    {
        return $this;
    }

    #[\Override]
    public function fold($z, \Closure $op): mixed
    {
        return $z;
    }

    #[\Override]
    public function foldLeft($z, \Closure $op): mixed
    {
        return $z;
    }

    #[\Override]
    public function foldRight($z, \Closure $op): mixed
    {
        return $z;
    }

    #[\Override]
    public function forAll(\Closure $p): bool
    {
        return true;
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        return new \EmptyIterator();
    }

    #[\Override]
    public function head(): mixed
    {
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function headOption(): Option
    {
        return None::instance();
    }

    #[\Override]
    public function indexOf(mixed $element, int $from = 0): int
    {
        return -1;
    }

    #[\Override]
    public function indexWhere(\Closure $p, int $from = 0): int
    {
        return -1;
    }

    #[\Override]
    public function init(): Seq
    {
        throw new \LogicException('init of empty list');
    }

    #[\Override]
    public function isEmpty(): bool
    {
        return true;
    }

    #[\Override]
    public function last(): mixed
    {
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function lastIndexOf(mixed $element, ?int $end = null): int
    {
        return -1;
    }

    #[\Override]
    public function lastIndexWhere(\Closure $p, ?int $end = null): int
    {
        return -1;
    }

    #[\Override]
    public function lastOption(): Option
    {
        return None::instance();
    }

    #[\Override]
    public function map(\Closure $f): Seq
    {
        return $this;
    }

    #[\Override]
    public function max(): mixed
    {
        throw new \LogicException('empty.max');
    }

    #[\Override]
    public function maxBy(\Closure $f): mixed
    {
        throw new \LogicException('empty.max');
    }

    #[\Override]
    public function min(): mixed
    {
        throw new \LogicException('empty.min');
    }

    #[\Override]
    public function minBy(\Closure $f): mixed
    {
        throw new \LogicException('empty.min');
    }

    #[\Override]
    public function mkString(string $sep = ''): string
    {
        return '';
    }

    #[\Override]
    public function nonEmpty(): bool
    {
        return false;
    }

    #[\Override]
    public function offsetExists(mixed $offset): bool
    {
        return false;
    }

    #[\Override]
    public function offsetGet(mixed $offset): mixed
    {
        throw new \OutOfBoundsException("Undefined offset: $offset");
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
        return $this;
    }

    #[\Override]
    public function size(): int
    {
        return 0;
    }

    #[\Override]
    public function sum(): int|float
    {
        return 0;
    }

    #[\Override]
    public function tail(): Seq
    {
        throw new \LogicException('tail of empty list');
    }

    #[\Override]
    public function take(int $n): Seq
    {
        return $this;
    }

    #[\Override]
    public function takeRight(int $n): Seq
    {
        return $this;
    }

    #[\Override]
    public function takeWhile(\Closure $p): Seq
    {
        return $this;
    }

    #[\Override]
    public function toArray(): array
    {
        return [];
    }

    #[\Override]
    public function toSeq(): Seq
    {
        return $this;
    }
}
