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
    public function testBlockqoute()
    {
        $markdown = <<<MARKDOWN
>  foo bar
>  hey ho
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->blockqoute("foo bar\n   hey ho");
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
            $builder->markdown()->bulletedList([
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
    public function testImg()
    {
        $markdown = <<<MARKDOWN
![Cats](cat.jpg)
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->img('cat.jpg', 'Cats');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testLink()
    {
        $markdown = <<<MARKDOWN
[Google](http://google.com)
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->link('http://google.com', 'Google');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testBold()
    {
        $markdown = <<<MARKDOWN
**Yeah!**
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->bold('Yeah!');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testItalic()
    {
        $markdown = <<<MARKDOWN
*Yeah!*
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->italic('Yeah!');
        $this->assertEquals($markdown, $builder->getMarkdown());
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
    public function testWrite()
    {
        $markdown = <<<MARKDOWN
foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->write('foo bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
    }

    /**
     *
     */
    public function testWriteln()
    {
        $markdown = <<<MARKDOWN
foo bar
MARKDOWN;

        $builder = new MarkdownBuilder();
        $builder->writeln('foo bar');
        $this->assertEquals($markdown, $builder->getMarkdown());
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
    ->blockqoute('
        qoute....
        lalalalal
    ')
    ->getMarkdown();
```

Todos
-----

* write tests
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
    ->blockqoute('
        qoute....
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
                'write tests',
                $builder
                    ->markdown()
                    ->write('hallo ')
                    ->link('google.com', 'Google')
                    ->write('foo bar')
                ,
                'add more markdown features'
            ]);

        $this->assertEquals($markdown, $builder->getMarkdown());


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
    }
}
