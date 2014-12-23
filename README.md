Markdown Builder
================

[![Build Status](https://travis-ci.org/DavidBadura/markdown-builder.svg)](https://travis-ci.org/DavidBadura/markdown-builder)

A simple helper class to create markdown.

Installation
------------

```bash
composer require 'davidbadura/markdown-builder@dev'
```

Usage
-----

```php
$builder = new MarkdownBuilder();

$builder
    ->h1('Markdown Builder')
    ->p('A simple helper class to create markdown.')
    ->h2($builder->markdown()->write('Install ')->bold('foo'))
    ->code("composer require 'davidbadura/markdown-builder@dev'", 'bash')
    ->h2('Usage')
    ->code($code, 'php')
    ->h2('Todos')
    ->bulletedList([
        'write tests',
        $builder
            ->markdown()
            ->write('hallo ')
            ->link('google.com', 'Google')
            ->write('foo bar')
        ,
        'add more markdown features'
    ]);
    
echo $builder->getMarkdown();
```

Todos
-----

* write documentation
* add more markdown features
