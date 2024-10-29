<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable;

use Immutable\Companions\OptionCompanion;

/**
 * Some.
 *
 * @extends \Immutable\Option<never>
 */
final readonly class None extends Option
{
    /**
     * Returns the None instance.
     *
     * @return self
     */
    public static function instance(): self
    {
        return OptionCompanion::none();
    }

    #[\Override]
    public static function of(mixed $value): Option
    {
        return OptionCompanion::none();
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
    public function drop(int $n): Seq
    {
        return Seq::empty();
    }

    #[\Override]
    public function dropRight(int $n): Seq
    {
        return Seq::empty();
    }

    #[\Override]
    public function dropWhile(\Closure $p): Seq
    {
        return Seq::empty();
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
    public function filter(\Closure $p): Option
    {
        return $this;
    }

    #[\Override]
    public function filterNot(\Closure $p): Option
    {
        return $this;
    }

    #[\Override]
    public function find(\Closure $p): Option
    {
        return $this;
    }

    #[\Override]
    public function flatMap(\Closure $f): Option
    {
        return $this;
    }

    #[\Override]
    public function flatten(): Option
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
    public function get(): never
    {
        throw new \LogicException('None has no value.');
    }

    #[\Override]
    public function getIterator(): \Traversable
    {
        return new \EmptyIterator();
    }

    #[\Override]
    public function getOrElse(\Closure $default): mixed
    {
        return $default();
    }

    #[\Override]
    public function head(): never
    {
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function headOption(): Option
    {
        return $this;
    }

    #[\Override]
    public function init(): never
    {
        throw new \LogicException('init of empty list');
    }

    #[\Override]
    public function isEmpty(): bool
    {
        return true;
    }

    #[\Override]
    public function last(): never
    {
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function lastOption(): Option
    {
        return $this;
    }

    #[\Override]
    public function map(\Closure $f): self
    {
        return $this;
    }

    #[\Override]
    public function max(): never
    {
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function maxBy(\Closure $f): never
    {
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function min(): never
    {
        throw new \LogicException('There is no value');
    }

    #[\Override]
    public function minBy(\Closure $f): never
    {
        throw new \LogicException('There is no value');
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
    public function offsetGet(mixed $offset): never
    {
        throw new \OutOfBoundsException("Undefined offset: $offset");
    }

    #[\Override]
    public function size(): int
    {
        return 0;
    }

    #[\Override]
    public function tail(): never
    {
        throw new \LogicException('tail of empty list');
    }

    #[\Override]
    public function take(int $n): Seq
    {
        return Seq::empty();
    }

    #[\Override]
    public function takeRight(int $n): Seq
    {
        return Seq::empty();
    }

    #[\Override]
    public function takeWhile(\Closure $p): Seq
    {
        return Seq::empty();
    }

    #[\Override]
    public function toArray(): array
    {
        return [];
    }

    #[\Override]
    public function toSeq(): Seq
    {
        return Seq::empty();
    }
}
