Markdown Builder
================

[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FDavidBadura%2Fmarkdown-builder%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/DavidBadura/markdown-builder/master)
[![Type Coverage](https://shepherd.dev/github/DavidBadura/markdown-builder/coverage.svg)](https://shepherd.dev/github/DavidBadura/markdown-builder)
[![Latest Stable Version](https://poser.pugx.org/DavidBadura/markdown-builder/v)](//packagist.org/packages/DavidBadura/markdown-builder)
[![License](https://poser.pugx.org/DavidBadura/markdown-builder/license)](//packagist.org/packages/DavidBadura/markdown-builder)

A simple helper class to create markdown.

Installation
------------

```bash
composer require 'davidbadura/markdown-builder'
```

Usage
-----

```php
$builder = new MarkdownBuilder();

$builder
    ->h1('Markdown Builder')
    ->p('A simple helper class to create markdown.')
    ->h2('Install ' . $builder->inlineBold('this') . ' powerfull library')
    ->code("composer require 'davidbadura/markdown-builder@dev'", 'bash')
    ->h2('Todos')
    ->bulletedList([
        'write tests',
        (string)$builder
            ->block()
            ->numberedList(['A', 'B', 'C'])
        ,
        'add more markdown features'
    ]);
    
echo $builder->getMarkdown();
```


    Markdown Builder
    ================
    
    A simple helper class to create markdown.
    
    Install **this** powerfull library
    ----------------------------------
    
    ```bash
    composer require 'davidbadura/markdown-builder@dev'
    ```
    
    Todos
    -----
    * write tests
    * 1. A
      2. B
      3. C
    * add more markdown features


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

#### blockquote

PHP-Code:

```php
echo (new MarkdownBuilder())->blockquote("Foo\nBar\nBaz")->getMarkdown();
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

#### hr

PHP-Code:

```php
echo (new MarkdownBuilder())->hr()->getMarkdown();
```

Markdown:

```markdown
------------------------
```

#### code

PHP-Code:

```php
echo (new MarkdownBuilder())->code('$var = "test";', 'php')->getMarkdown();
```

Markdown:

    ```php
    $var = "test";
    ```

#### table

PHP-Code:

```php
echo (new MarkdownBuilder())->table(
    ['col0', 'col1'],
    [
        ['row01', 'row01'],
        ['row10', 'row11'],
    ],
    [Alignment::CENTER, Alignment::RIGHT]
)->getMarkdown();
```
Markdown:

```markdown
|col0|col1|
|:-:|-:|
|row01|row01|
```

### Inline Blocks

#### bold

PHP-Code:

```php
echo (new MarkdownBuilder())->inlineBold('Hey!');
```

Markdown:

```markdown
**Hey!**
```

#### italic

PHP-Code:

```php
echo (new MarkdownBuilder())->inlineItalic('huhu');
```

Markdown:

```markdown
*huhu*
```

#### code

PHP-Code:

```php
echo (new MarkdownBuilder())->inlineCode('$var = "test";');
```

Markdown:

```markdown
`$var = "test";`
```

#### link

PHP-Code:

```php
echo (new MarkdownBuilder())->inlineLink('http://google.de', 'Google', 'Title');
```

Markdown:

```markdown
[Google](http://google.de "Title")
```

#### img

PHP-Code:

```php
echo (new MarkdownBuilder())->inlineImg('cat.jpg', 'Cat', 'Title');
```

Markdown:

```markdown
![Cat](cat.jpg "Title")
```

### Advance features

if you need collapse blocks, you can create a new builder instance with his own clean buffer.
this can you do by call `block()`.

PHP-Code:

```php
$builder = new MarkdownBuilder();
$builder->blockqoute(
    (string)$builder
      ->block()
      ->h1('Lists')
      ->bulletedList([
        'Foo',
        $builder->block()->numberedList(['A', 'B', 'C']),
        'Bar'
      ])
);
```

Markdown:

```markdown
>  Lists
>  =====
>
>  * Foo
>  * 1. A
>    2. B
>    3. C
>  * Bar
```
