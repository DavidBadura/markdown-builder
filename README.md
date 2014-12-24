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
    ->h2('Install ' . $builder->inlineBold('this') . 'powerfull library')
    ->code("composer require 'davidbadura/markdown-builder@dev'", 'bash')
    ->h2('Usage')
    ->code($code, 'php')
    ->h2('Todos')
    ->bulletedList([
        'write tests',
        $builder
            ->markdown()
            ->numberedList(['A', 'B', 'C'])
        ,
        'add more markdown features'
    ]);
    
echo $builder->getMarkdown();
```

API
---

The markdown builder have two kinds of elements, block and inline elements.
Block elements will be buffered and you can get the markdown if you call the method `getMarkdown()`.
All inline Elements are prefixed with `inline*` and you get instantly the markdown output.

### Block Elements

#### h1

PHP-Code:

```php
echo (new MarkdownBuilder)->h1('Hello World')->getMarkdown();
```

Markdown:

```markdown
Hello World
===========
```

#### h2

PHP-Code:

```php
echo (new MarkdownBuilder)->h2('Hello second world')->getMarkdown();
```

Markdown:

```markdown
Hello second world
------------------
```