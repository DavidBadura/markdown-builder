<?php

declare(strict_types=1);

namespace DavidBadura\MarkdownBuilder;

use PHPUnit\Framework\TestCase;

class MarkdownBuilderTest extends TestCase
{
    public function testP(): void
    {
        $markdown = <<<MARKDOWN
foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->p('foo bar');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testH1(): void
    {
        $markdown = <<<MARKDOWN
foo bar
=======
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h1('foo bar');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testH1Multiline(): void
    {
        $markdown = <<<MARKDOWN
foo bar
=======
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h1('foo
        bar');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testH2(): void
    {
        $markdown = <<<MARKDOWN
foo bar
-------
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h2('foo bar');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testH2Multiline(): void
    {
        $markdown = <<<MARKDOWN
foo bar
-------
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h2('foo
        bar');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testH3(): void
    {
        $markdown = <<<MARKDOWN
### foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h3('foo bar');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testH3Multiline(): void
    {
        $markdown = <<<MARKDOWN
### foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h3('foo
        bar');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testBlockquote(): void
    {
        $markdown = <<<MARKDOWN
>  foo bar
>     hey ho
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->blockquote("foo bar\n   hey ho");
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testBlockquoteComplex(): void
    {
        $markdown = <<<MARKDOWN
>  test
>  ====
>
>  * A
>  * B
>  * C
>
>  >  test123
>
>  foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->blockquote(
            (string)$builder
                ->block()
                ->h1('test')
                ->bulletedList(['A', 'B', 'C'])
                ->blockquote('test123')
                ->p('foo bar')
        );
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testBulletedList(): void
    {
        $markdown = <<<MARKDOWN
* Hallo
* foo
* bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->bulletedList([
            'Hallo',
            'foo',
            'bar',
        ]);
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testBulletedListMultiline(): void
    {
        $markdown = <<<MARKDOWN
* Hallo
* foo
  bar
* bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->bulletedList([
            'Hallo',
            "foo\nbar",
            'bar',
        ]);
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testNumberedList(): void
    {
        $markdown = <<<MARKDOWN
1. Hallo
2. foo
3. bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->numberedList([
            'Hallo',
            'foo',
            'bar',
        ]);
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testNumberedListMultiline(): void
    {
        $markdown = <<<MARKDOWN
1. Hallo
2. foo
   geheim
3. bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->numberedList([
            'Hallo',
            "foo\ngeheim",
            'bar',
        ]);
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testMutlitlists(): void
    {
        $markdown = <<<MARKDOWN
1. Hallo
2. * A
   * B
   * C
3. bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->numberedList([
            'Hallo',
            (string)$builder->block()->bulletedList([
                'A',
                'B',
                'C',
            ]),
            'bar',
        ]);
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testHr(): void
    {
        $markdown = <<<MARKDOWN
---------------------------------------
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->hr();
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testCode(): void
    {
        $markdown = <<<MARKDOWN
```bash
apt-get install php5
```
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->code('apt-get install php5', 'bash');
        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testInlineImg(): void
    {
        $markdown = <<<MARKDOWN
![Cats](cat.jpg)
MARKDOWN;

        self::assertEquals($markdown, MarkdownBuilder::inlineImg('cat.jpg', 'Cats'));
    }

    public function testInlineLink(): void
    {
        $markdown = <<<MARKDOWN
[Google](http://google.com)
MARKDOWN;

        self::assertEquals($markdown, MarkdownBuilder::inlineLink('http://google.com', 'Google'));
    }

    public function testInlineBold(): void
    {
        $markdown = <<<MARKDOWN
**Yeah!**
MARKDOWN;

        self::assertEquals($markdown, MarkdownBuilder::inlineBold('Yeah!'));
    }

    public function testInlineItalic(): void
    {
        $markdown = <<<MARKDOWN
*Yeah!*
MARKDOWN;

        self::assertEquals($markdown, MarkdownBuilder::inlineItalic('Yeah!'));
    }

    public function testInlineCode(): void
    {
        $markdown = <<<MARKDOWN
`\$var = "foo";`
MARKDOWN;

        self::assertEquals($markdown, MarkdownBuilder::inlineCode('$var = "foo";'));
    }

    public function testReadme(): void
    {
        $markdown = <<<MARKDOWN
Markdown Builder
================

A simple helper class to create markdown.

Install **foo**
---------------

```bash
composer require 'davidbadura/markdown-builder@dev'
```

Usage
-----

```php
\$markdown = \DavidBadura\MarkdownBuilder\MarkdownBuilder::create()
    ->h1('Markdown Builder')
    ->p('foo bar baz')
    ->code('<?php echo 'hello world' ?>', 'php')
    ->bulletedList([
        'eins',
        'zwei',
        'drei'
    ])
    ->blockquote('
        quote....
        lalalalal
    ')
    ->getMarkdown();
```

Todos
-----

* 1. A
  2. B
  3. C
* hallo [Google](google.com) foo bar
* add more markdown features
MARKDOWN;

        $code = <<<CODE
\$markdown = \DavidBadura\MarkdownBuilder\MarkdownBuilder::create()
    ->h1('Markdown Builder')
    ->p('foo bar baz')
    ->code('<?php echo 'hello world' ?>', 'php')
    ->bulletedList([
        'eins',
        'zwei',
        'drei'
    ])
    ->blockquote('
        quote....
        lalalalal
    ')
    ->getMarkdown();
CODE;

        $builder = new MarkdownBuilder();

        $builder
            ->h1('Markdown Builder')
            ->p('A simple helper class to create markdown.')
            ->h2('Install ' . MarkdownBuilder::inlineBold('foo'))
            ->code("composer require 'davidbadura/markdown-builder@dev'", 'bash')
            ->h2('Usage')
            ->code($code, 'php')
            ->h2('Todos')
            ->bulletedList([
                (string)$builder
                    ->block()
                    ->numberedList(['A', 'B', 'C']),
                'hallo ' . MarkdownBuilder::inlineLink('google.com', 'Google') . ' foo bar',
                'add more markdown features',
            ]);

        self::assertEquals($markdown, $builder->getMarkdown());
    }

    public function testListAndHeadline(): void
    {
        $markdown = <<<MARKDOWN
* foo
* bar

test
====
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->bulletedList([
            'foo',
            'bar',
        ]);
        $builder->h1('test');

        self::assertEquals($markdown, $builder->getMarkdown());
    }
}
