<?php

namespace DavidBadura\MarkdownBuilder;

/**
 * @author David Badura <d.a.badura@gmail.com>
 */
class MarkdownBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testP()
    {
        $markdown = <<<MARKDOWN
foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->p('foo bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testH1()
    {
        $markdown = <<<MARKDOWN
foo bar
=======
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h1('foo bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testH1Multiline()
    {
        $markdown = <<<MARKDOWN
foo bar
=======
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h1('foo
        bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testH2()
    {
        $markdown = <<<MARKDOWN
foo bar
-------
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h2('foo bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testH2Multiline()
    {
        $markdown = <<<MARKDOWN
foo bar
-------
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h2('foo
        bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testH3()
    {
        $markdown = <<<MARKDOWN
### foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h3('foo bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testH3Multiline()
    {
        $markdown = <<<MARKDOWN
### foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->h3('foo
        bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testBlockquote()
    {
        $markdown = <<<MARKDOWN
>  foo bar
>     hey ho
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->blockquote("foo bar\n   hey ho");
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testBlockquoteComplex()
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
            $builder
                ->block()
                ->h1('test')
                ->bulletedList(['A', 'B', 'C'])
                ->blockquote('test123')
                ->p('foo bar')
        );
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testBulletedList()
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
            'bar'
        ]);
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testBulletedListMultiline()
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
            'bar'
        ]);
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testNumberedList()
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
            'bar'
        ]);
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testNumberedListMultiline()
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
            'bar'
        ]);
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testMutlitlists()
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
            $builder->block()->bulletedList([
                'A',
                'B',
                'C'
            ]),
            'bar'
        ]);
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testHr()
    {
        $markdown = <<<MARKDOWN
---------------------------------------
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->hr();
        $this->assertEquals($markdown, $builder->getMarkdown());
    }


    /**
     *
     */
    public function testCode()
    {
        $markdown = <<<MARKDOWN
```bash
apt-get install php5
```
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->code('apt-get install php5', 'bash');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testInlineImg()
    {
        $markdown = <<<MARKDOWN
![Cats](cat.jpg)
MARKDOWN;

        $builder = new MarkdownBuilder();
        $this->assertEquals($markdown, $builder->inlineImg('cat.jpg', 'Cats'));
    }

    /**
     *
     */
    public function testInlineLink()
    {
        $markdown = <<<MARKDOWN
[Google](http://google.com)
MARKDOWN;

        $builder = new MarkdownBuilder();
        $this->assertEquals($markdown, $builder->inlineLink('http://google.com', 'Google'));
    }

    /**
     *
     */
    public function testInlineBold()
    {
        $markdown = <<<MARKDOWN
**Yeah!**
MARKDOWN;

        $builder = new MarkdownBuilder();
        $this->assertEquals($markdown, $builder->inlineBold('Yeah!'));
    }

    /**
     *
     */
    public function testInlineItalic()
    {
        $markdown = <<<MARKDOWN
*Yeah!*
MARKDOWN;

        $builder = new MarkdownBuilder();
        $this->assertEquals($markdown, $builder->inlineItalic('Yeah!'));
    }

    /**
     *
     */
    public function testInlineCode()
    {
        $markdown = <<<MARKDOWN
`\$var = "foo";`
MARKDOWN;

        $builder = new MarkdownBuilder();;
        $this->assertEquals($markdown, $builder->inlineCode('$var = "foo";'));
    }

    /**
     *
     */
    public function testReadme()
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
            ->h2('Install ' . $builder->inlineBold('foo'))
            ->code("composer require 'davidbadura/markdown-builder@dev'", 'bash')
            ->h2('Usage')
            ->code($code, 'php')
            ->h2('Todos')
            ->bulletedList([
                $builder
                    ->block()
                    ->numberedList(['A', 'B', 'C']),
                'hallo ' . $builder->inlineLink('google.com', 'Google') . ' foo bar',
                'add more markdown features'
            ]);

        $this->assertEquals($markdown, $builder->getMarkdown());
    }


    /**
     *
     */
    public function testListAndHeadline()
    {
        $markdown = <<<MARKDOWN
* foo
* bar

test
====
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->bulletedList([
            "foo",
            'bar'
        ]);
        $builder->h1("test");

        $this->assertEquals($markdown, $builder->getMarkdown());
    }
}
