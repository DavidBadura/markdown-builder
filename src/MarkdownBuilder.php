<?php

declare(strict_types=1);

namespace DavidBadura\MarkdownBuilder;

use RuntimeException;

use function array_map;
use function array_values;
use function explode;
use function implode;
use function is_string;
use function mb_strlen;
use function preg_replace;
use function sprintf;
use function str_repeat;
use function str_replace;
use function trim;

class MarkdownBuilder
{
    protected string $markdown;

    final public function __construct()
    {
        $this->markdown = '';
    }

    /**
     * @return static
     */
    public function block(): self
    {
        return new static();
    }

    /**
     * @return $this
     */
    public function p(string $text): self
    {
        return $this
            ->writeln($text)
            ->br();
    }

    /**
     * @return $this
     */
    public function h1(string $header): self
    {
        $header = $this->singleLine($header);

        return $this
            ->writeln($header)
            ->writeln(str_repeat('=', mb_strlen($header)))
            ->br();
    }

    /**
     * @return $this
     */
    public function h2(string $header): self
    {
        $header = $this->singleLine($header);

        return $this
            ->writeln($header)
            ->writeln(str_repeat('-', mb_strlen($header)))
            ->br();
    }

    /**
     * @return $this
     */
    public function h3(string $header): self
    {
        $header = $this->singleLine($header);

        return $this
            ->writeln('### ' . $header)
            ->br();
    }

    /**
     * @return $this
     */
    public function blockquote(string $text): self
    {
        $lines = explode("\n", $text);
        $newLines = array_map(static function ($line) {
            return trim('>  ' . $line);
        }, $lines);

        $content = implode("\n", $newLines);

        return $this->p($content);
    }

    /**
     * @param array<string> $list
     *
     * @return $this
     */
    public function bulletedList(array $list): self
    {
        foreach ($list as $element) {
            $lines = explode("\n", $element);

            foreach ($lines as $i => $line) {
                if ($i === 0) {
                    $this->writeln('* ' . $line);
                } else {
                    $this->writeln('  ' . $line);
                }
            }
        }

        $this->br();

        return $this;
    }

    /**
     * @param array<string> $list
     *
     * @return $this
     */
    public function numberedList(array $list): self
    {
        foreach (array_values($list) as $key => $element) {
            $lines = explode("\n", $element);

            foreach ($lines as $i => $line) {
                if ($i === 0) {
                    $this->writeln(($key + 1) . '. ' . $line);
                } else {
                    $this->writeln('   ' . $line);
                }
            }
        }

        $this->br();

        return $this;
    }

    /**
     * @return $this
     */
    public function hr(): self
    {
        return $this->p('---------------------------------------');
    }

    /**
     * @return $this
     */
    public function code(string $code, string $lang = ''): self
    {
        return $this
            ->writeln('```' . $lang)
            ->writeln($code)
            ->writeln('```')
            ->br();
    }

    /**
     * @return $this
     */
    public function br(): self
    {
        return $this->write("\n");
    }

    public static function inlineCode(string $code): string
    {
        return sprintf('`%s`', $code);
    }

    public static function inlineItalic(string $string): string
    {
        return sprintf('*%s*', $string);
    }

    public static function inlineBold(string $string): string
    {
        return sprintf('**%s**', $string);
    }

    public static function inlineLink(string $url, string $title): string
    {
        return sprintf('[%s](%s)', $title, $url);
    }

    public static function inlineImg(string $url, string $title, ?string $width = null, ?string $height = null): string
    {
        if ($width && $height) {
            $format = '<img src="%s" width="%s" height="%s" title="%s">';

            return sprintf($format, $url, $width, $height, $title);
        }

        return sprintf('![%s](%s)', $title, $url);
    }

    public function getMarkdown(): string
    {
        return trim($this->markdown);
    }

    /**
     * @return $this
     */
    protected function writeln(string $string): self
    {
        return $this
            ->write($string)
            ->br();
    }

    /**
     * @return $this
     */
    protected function write(string $string): self
    {
        $this->markdown .= $string;

        return $this;
    }

    protected function singleLine(string $string): string
    {
        $string = str_replace("\n", '', $string);
        $result = preg_replace('/\s+/', ' ', $string);

        if (!is_string($result)) {
            throw new RuntimeException();
        }

        return trim($result);
    }

    public function __toString(): string
    {
        return $this->getMarkdown();
    }
}
