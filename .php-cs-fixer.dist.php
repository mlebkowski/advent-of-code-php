<?php
/** @noinspection PhpUndefinedMethodInspection */

/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUndefinedNamespaceInspection */
declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()->in(__DIR__ . '/src');

$config = new PhpCsFixer\Config();
return $config
    ->setCacheFile(__DIR__ . '/tools/php-cs-fixer/.cs-fix.cache')
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PhpCsFixer' => true,
            'align_multiline_comment' => false,
            'array_indentation' => false,
            'array_syntax' => ['syntax' => 'short'],
            'binary_operator_spaces' => false,
            'blank_line_after_opening_tag' => false,
            'blank_line_before_statement' => false,
            'cast_spaces' => false,
            'class_attributes_separation' => false,
            'class_definition' => [
                'multi_line_extends_each_single_line' => true,
            ],
            'concat_space' => false,
            'declare_strict_types' => true,
            'explicit_string_variable' => false,
            'final_internal_class' => [
                'annotation_exclude' => ['@final', '@ignore-final'],
                'annotation_include' => [],
                'consider_absent_docblock_as_internal_class' => true,
            ],
            'function_typehint_space' => false,
            'global_namespace_import' => [
                'import_classes' => true,
            ],
            'heredoc_to_nowdoc' => false,
            'increment_style' => false,
            'linebreak_after_opening_tag' => false,
            'method_chaining_indentation' => true,
            'multiline_whitespace_before_semicolons' => [],
            'new_with_braces' => false,
            'no_blank_lines_after_class_opening' => true,
            'no_extra_blank_lines' => true,
            'no_multiline_whitespace_around_double_arrow' => false,
            'no_singleline_whitespace_before_semicolons' => false,
            'no_superfluous_phpdoc_tags' => true,
            'no_trailing_comma_in_singleline' => true,
            'no_whitespace_before_comma_in_array' => true,
            'no_whitespace_in_blank_line' => false,
            'operator_linebreak' => false,
            'ordered_class_elements' => [
                'order' => [
                    'use_trait',
                    'case',
                    'constant_public',
                    'constant_protected',
                    'constant_private',
                    'property_public',
                    'property_protected',
                    'property_private',
                    'method_public_static',
                    'construct',
                    'destruct',
                    'magic',
                    'phpunit',
                    'method_public',
                    'method_protected',
                    'method_private',
                    'magic',
                ],
                'sort_algorithm' => 'none',
            ],
            'ordered_imports' => true,
            'php_unit_internal_class' => false,
            'php_unit_test_class_requires_covers' => false,
            'phpdoc_align' => false,
            'phpdoc_no_useless_inheritdoc' => true,
            'phpdoc_order' => false,
            'phpdoc_separation' => false,
            'phpdoc_single_line_var_spacing' => false,
            'phpdoc_summary' => false,
            'phpdoc_tag_type' => false,
            'phpdoc_to_comment' => false,
            'phpdoc_types_order' => false,
            'phpdoc_var_without_name' => false,
            'protected_to_private' => true,
            'return_assignment' => false,
            'single_blank_line_before_namespace' => false,
            'single_line_comment_style' => false,
            'single_quote' => false,
            'single_space_around_construct' => false,
            'static_lambda' => true,
            'strict_comparison' => true,
            'strict_param' => true,
            'ternary_operator_spaces' => false,
            'trailing_comma_in_multiline' => ['elements' => ['arrays', 'arguments', 'parameters', 'match']],
            'unary_operator_spaces' => false,
            'visibility_required' => true,
            'whitespace_after_comma_in_array' => true,
            'yoda_style' => false,
        ],
    )->setFinder($finder);
