<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP83Migration' => true,
        '@PHP80Migration:risky' => true,
        'phpdoc_summary' => false,
        'declare_strict_types' => true,
        'blank_line_after_opening_tag' => false,
        'final_class' => true,
        'global_namespace_import' => true,
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'php_unit_test_class_requires_covers' => false,
    ])
    ->setFinder($finder)
    ;

