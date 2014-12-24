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
echo (new MarkdownBuilder())->h1('Hello World')->getMarkdown();
```

Markdown:

```markdown
Hello World
===========
```

#### h2

PHP-Code:

```php
echo (new MarkdownBuilder())->h2('Hello second world')->getMarkdown();
```

Markdown:

```markdown
Hello second world
------------------
```

#### h3

PHP-Code:

```php
echo (new MarkdownBuilder())->h3('My name is...')->getMarkdown();
```

Markdown:

```markdown
### My name is...
```

#### p

PHP-Code:

```php
echo (new MarkdownBuilder())->p('paragraph')->getMarkdown();
```

Markdown:

```markdown
paragraph
```

#### blockqoute

PHP-Code:

```php
echo (new MarkdownBuilder())->blockqoute("Foo\nBar\nBaz")->getMarkdown();
```

Markdown:

```markdown
> Foo
> Bar
> Baz
```

#### bulleted list

PHP-Code:

```php
echo (new MarkdownBuilder())->bulletedList(['Foo', 'Bar', 'Baz'])->getMarkdown();
```

Markdown:

```markdown
* Foo
* Bar
* Baz
```

#### numbered list

PHP-Code:

```php
echo (new MarkdownBuilder())->numberedList(['Foo', 'Bar', 'Baz'])->getMarkdown();
```

Markdown:

```markdown
1. Foo
2. Bar
3. Baz
```

### hr

PHP-Code:

```php
echo (new MarkdownBuilder())->hr()->getMarkdown();
```

Markdown:

```markdown
------------------------
```

### code

PHP-Code:

```php
echo (new MarkdownBuilder())->code('$var = "test";', 'php')->getMarkdown();
```

Markdown:

```markdown
    ```php
    $var = "test";
    ```
```