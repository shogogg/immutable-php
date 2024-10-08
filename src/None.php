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
    public function get(): never
    {
        throw new \LogicException('None has no value.');
    }

    #[\Override]
    public function map(\Closure $f): self
    {
        return $this;
    }

    #[\Override]
    public function toArray(): array
    {
        return [];
    }
}
