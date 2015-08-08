# Contributions are welcome!

## Quick guide:

* Fork the repo.
* Install dependencies: `composer install`.
* Create branch, e.g. feature-foo or bugfix-bar.
* Make changes.
* If you are adding functionality or fixing a bug - add a test!
* Fix project coding style: `php vendor/bin/php-cs-fixer fix`.
* Check if tests pass: `php vendor/bin/phpunit`.

## Opening a pull request

You can do some things to increase the chance that your pull request is accepted the first time:

* Submit one pull request per fix or feature.
* If your changes are not up to date - rebase your branch on master.
* Follow the conventions used in the project.
* Remember about tests and documentation.
* Don't bump version.

## Project's standards:

* [PSR-0: Autoloading Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* [PSR-1: Basic Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
* [PSR-2: Coding Style Guide](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
* [Symfony Coding Standards](http://symfony.com/doc/current/contributing/code/standards.html)
* Keep the order of class elements: static properties, instance properties, constructor (or setUp for PHPUnit), destructor (or tearDown for PHPUnit), static methods, instance methods, magic static methods, magic instance methods.

## Scrutinizer settings
 
```yml
filter:
    excluded_paths:
        - tests/*
        - vendor/*

tools:
    external_code_coverage: true
    php_analyzer: true
    php_changetracking: true
    php_code_coverage: true
    php_code_sniffer:
        config:
            standard:         "PSR2"
    php_cs_fixer:
        config: { level: psr2 }
    php_loc:
        enabled: true
        excluded_dirs: [vendor, tests]
    php_mess_detector: true
    php_pdepend: true
    php_sim: true
    sensiolabs_security_checker: true

checks:
    php:
        align_assignments: true
        argument_type_checks: true
        assignment_of_null_return: true
        avoid_aliased_php_functions: true
        avoid_conflicting_incrementers: true
        avoid_corrupting_byteorder_marks: true
        avoid_duplicate_types: true
        avoid_entity_manager_injection: true
        avoid_fixme_comments: true
        avoid_length_functions_in_loops: true
        avoid_multiple_statements_on_same_line: true
        avoid_perl_style_comments: true
        avoid_tab_indentation: true
        avoid_todo_comments: true
        avoid_unnecessary_concatenation: true
        avoid_usage_of_logical_operators: true
        avoid_useless_overridden_methods: true
        blank_line_after_namespace_declaration: true
        catch_class_exists: true
        classes_in_camel_caps: true
        closure_use_modifiable: true
        closure_use_not_conflicting: true
        code_rating: true
        deprecated_code_usage: true
        duplication: true
        encourage_postdec_operator: true
        encourage_shallow_comparison: true
        encourage_single_quotes: true
        ensure_lower_case_builtin_functions: true
        fix_doc_comments: true
        fix_identation_4spaces: true
        fix_line_ending: true
        fix_linefeed: true
        fix_php_opening_tag: true
        fix_use_statements:
            remove_unused: true
            preserve_multiple: false
            preserve_blanklines: false
            order_alphabetically: true
        foreach_traversable: true
        foreach_usable_as_reference: true
        function_body_start_on_new_line: true
        function_in_camel_caps: true
        instanceof_class_exists: true
        lowercase_basic_constants: true
        lowercase_php_keywords: true
        method_calls_on_non_object: true
        missing_arguments: true
        more_specific_types_in_doc_comments: true
        naming_conventions:
            local_variable: '^[a-z][a-zA-Z0-9]*$'
            abstract_class_name: ^Abstract|Factory$
            utility_class_name: 'Utils?$'
            constant_name: '^[A-Z][A-Z0-9]*(?:_[A-Z0-9]+)*$'
            property_name: '^[a-z][a-zA-Z0-9]*$'
            method_name: '^(?:[a-z]|__)[a-zA-Z0-9]*$'
            parameter_name: '^[a-z][a-zA-Z0-9]*$'
            interface_name: '^[A-Z][a-zA-Z0-9]*Interface$'
            type_name: '^[A-Z][a-zA-Z0-9]*$'
            exception_name: '^[A-Z][a-zA-Z0-9]*Exception$'
            isser_method_name: '^(?:is|has|should|may|supports)'
        newline_at_end_of_file: true
        no_commented_out_code: true
        no_debug_code: true
        no_duplicate_arguments: true
        no_else_if_statements: true
        no_empty_statements: true
        no_eval: true
        no_exit: true
        no_global_keyword: true
        no_goto: true
        no_non_implemented_abstract_methods: true
        no_property_on_interface: true
        no_short_method_names:
            minimum: '3'
        no_short_variable_names:
            minimum: '3'
        no_short_open_tag: true
        no_space_around_object_operator: true
        no_space_before_semicolon: true
        no_space_inside_cast_operator: true
        no_trailing_whitespace: true
        no_underscore_prefix_in_methods: true
        no_underscore_prefix_in_properties: true
        no_unnecessary_final_modifier: true
        no_unnecessary_function_call_in_for_loop: true
        no_unnecessary_if: true
        non_commented_empty_catch_block: true
        one_class_per_file: true
        optional_parameters_at_the_end: true
        overriding_private_members: true
        param_doc_comment_if_not_inferrable: true
        parameter_doc_comments: true
        parameter_non_unique: true
        parameters_in_camelcaps: true
        php5_style_constructor: true
        precedence_in_conditions: true
        precedence_mistakes: true
        prefer_sapi_constant: true
        prefer_unix_line_ending: true
        prefer_while_loop_over_for_loop: true
        properties_in_camelcaps: true
        psr2_class_declaration: true
        psr2_control_structure_declaration: true
        psr2_switch_declaration: true
        remove_extra_empty_lines: true
        remove_php_closing_tag: true
        remove_trailing_whitespace: true
        require_braces_around_control_structures: true
        require_php_tag_first: true
        require_scope_for_methods: true
        require_scope_for_properties: true
        return_doc_comment_if_not_inferrable: true
        return_doc_comments: true
        scope_indentation:
            spaces_per_level: '4'
        security_vulnerabilities: true
        simplify_boolean_return: true
        single_namespace_per_use: true
        space_after_cast: true
        spacing_around_conditional_operators: true
        spacing_around_non_conditional_operators: true
        spacing_of_function_arguments: true
        sql_injection_vulnerabilities: true
        switch_fallthrough_commented: true
        symfony_request_injection: true
        too_many_arguments: true
        unreachable_code: true
        unused_methods: true
        unused_parameters: true
        unused_properties: true
        unused_variables: true
        uppercase_constants: true
        use_self_instead_of_fqcn: true
        use_statement_alias_conflict: true
        useless_calls: true
        variable_existence: true
        verify_access_scope_valid: true
        verify_argument_usable_as_reference: true
        verify_property_names: true

coding_style:
    php:
        spaces:
            before_left_brace:
                class: false
                function: false
        braces:
            classes_functions:
                class: new-line
                function: new-line
                closure: end-of-line
            if:
                opening: end-of-line
            for:
                opening: end-of-line
            while:
                opening: end-of-line
            do_while:
                opening: end-of-line
            switch:
                opening: end-of-line
            try:
                opening: end-of-line
        upper_lower_casing:
            keywords:
                general: lower
            constants:
                true_false_null: lower
```
