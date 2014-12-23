Markdown Builder
================

A simple helper class to create markdown.

Installation
------------

```bash
composer require 'davidbadura/markdown-builder@dev'
```

Usage
-----

```php
$markdown = \DavidBadura\MarkdownBuilder\MarkdownBuilder::create()
    ->h1('Markdown Builder')
    ->p('foo bar baz')
    ->code('<?php echo 'hello world' ?>', 'php')
    ->bulletedList([
        'eins',
        'zwei',
        'drei'
    ])
    ->blockqoute('
        qoute....
        lalalalal
    ')
    ->getMarkdown();
```

Todos
-----

* write documentation
* add more markdown features
