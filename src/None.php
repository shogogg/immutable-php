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
 * @extends \Immutable\Option<never>
 */
final class None extends Option
{
    private static ?self $instance = null;

    /**
     * Returns the None instance.
     *
     * @return self
     */
    public static function instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    #[\Override]
    public static function of(mixed $value): Option
    {
        return self::instance();
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
    public function map(\Closure $f): self
    {
        return $this;
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
