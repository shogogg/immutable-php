<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'function_declaration' => [
            'closure_function_spacing' => 'one',
        ],
    ])
    ->setFinder($finder);
