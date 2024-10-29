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
final readonly class Some extends Option
{
    /**
     * {@see \Immutable\Some} constructor.
     *
     * @param T $value the value
     */
    private function __construct(private mixed $value)
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
    public function drop(int $n): Seq
    {
        return $n <= 0 ? $this->toSeq() : Seq::empty();
    }

    #[\Override]
    public function dropRight(int $n): Seq
    {
        return $n <= 0 ? $this->toSeq() : Seq::empty();
    }

    #[\Override]
    public function dropWhile(\Closure $p): Seq
    {
        return $p($this->value, 0) ? Seq::empty() : $this->toSeq();
    }

    #[\Override]
    public function each(\Closure $f): void
    {
        $f($this->value, 0);
    }

    #[\Override]
    public function exists(\Closure $p): bool
    {
        return $p($this->value, 0);
    }

    #[\Override]
    public function filter(\Closure $p): Option
    {
        return $p($this->value, 0) ? $this : None::instance();
    }

    #[\Override]
    public function filterNot(\Closure $p): Option
    {
        return $p($this->value, 0) ? None::instance() : $this;
    }

    #[\Override]
    public function find(\Closure $p): Option
    {
        return $p($this->value, 0) ? $this : None::instance();
    }

    #[\Override]
    public function flatMap(\Closure $f): Option
    {
        $x = $f($this->value, 0);
        if ($x instanceof Option) {
            return $x;
        } else {
            throw new \LogicException('Closure should return an iterable');
        }
    }

    #[\Override]
    public function flatten(): Option
    {
        if ($this->value instanceof Option) {
            return $this->value;
        } else {
            throw new \LogicException('Element should be an Option');
        }
    }

    #[\Override]
    public function fold($z, \Closure $op): mixed
    {
        return $op($z, $this->value, 0);
    }

    #[\Override]
    public function foldLeft($z, \Closure $op): mixed
    {
        return $op($z, $this->value, 0);
    }

    #[\Override]
    public function foldRight($z, \Closure $op): mixed
    {
        return $op($this->value, $z, 0);
    }

    #[\Override]
    public function forAll(\Closure $p): bool
    {
        return $p($this->value, 0);
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

    #[\Override]
    public function getOrElse(\Closure $default): mixed
    {
        return $this->value;
    }

    #[\Override]
    public function head(): mixed
    {
        return $this->value;
    }

    #[\Override]
    public function headOption(): Option
    {
        return $this;
    }

    #[\Override]
    public function init(): Seq
    {
        return Seq::empty();
    }

    #[\Override]
    public function isEmpty(): bool
    {
        return false;
    }

    #[\Override]
    public function last(): mixed
    {
        return $this->value;
    }

    #[\Override]
    public function lastOption(): Option
    {
        return $this;
    }

    #[\Override]
    public function map(\Closure $f): Option
    {
        return self::of($f($this->value, 0));
    }

    #[\Override]
    public function max(): mixed
    {
        return $this->value;
    }

    #[\Override]
    public function maxBy(\Closure $f): mixed
    {
        return $this->value;
    }

    #[\Override]
    public function min(): mixed
    {
        return $this->value;
    }

    #[\Override]
    public function minBy(\Closure $f): mixed
    {
        return $this->value;
    }

    #[\Override]
    public function mkString(string $sep = ''): string
    {
        return (string)$this->value;
    }

    #[\Override]
    public function nonEmpty(): bool
    {
        return true;
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
    public function size(): int
    {
        return 1;
    }

    #[\Override]
    public function take(int $n): Seq
    {
        return $n <= 0 ? Seq::empty() : $this->toSeq();
    }

    #[\Override]
    public function tail(): Seq
    {
        return Seq::empty();
    }

    #[\Override]
    public function takeRight(int $n): Seq
    {
        return $n <= 0 ? Seq::empty() : $this->toSeq();
    }

    #[\Override]
    public function takeWhile(\Closure $p): Seq
    {
        return $p($this->value, 0) ? $this->toSeq() : Seq::empty();
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
