<?php

namespace DavidBadura\MarkdownBuilder;

/**
 * @author David Badura <d.a.badura@gmail.com>
 */
class MarkdownBuilder
{
    /**
     * @var string
     */
    protected $markdown;

    /**
     * @param string $text
     * @return $this
     */
    public function p($text)
    {
        return $this
            ->writeln($text)
            ->br();
    }

    /**
     * @param string $header
     * @return $this
     */
    public function h1($header)
    {
        return $this
            ->writeln($header)
            ->writeln(str_repeat("=", strlen($header)))
            ->br();
    }

    /**
     * @param string $header
     * @return $this
     */
    public function h2($header)
    {
        return $this
            ->writeln($header)
            ->writeln(str_repeat("-", strlen($header)))
            ->br();
    }

    /**
     * @param string $header
     * @return $this
     */
    public function h3($header)
    {
        return $this
            ->writeln('### ' . $header)
            ->br();
    }

    /**
     * @param string $text
     * @return $this
     */
    public function blockqoute($text)
    {
        $lines    = explode("\n", $text);
        $newLines = array_map(function ($line) {
            return '>  ' . trim($line);
        }, $lines);

        $content = implode("\n", $newLines);

        return $this
            ->br()
            ->p($content);
    }

    /**
     * @param array $list
     * @return $this
     */
    public function bulletedList(array $list)
    {
        foreach ($list as $element) {
            $this->writeln('* ' . $element);
        }

        return $this;
    }

    /**
     * @param array $list
     * @return $this
     */
    public function numberedList(array $list)
    {
        foreach (array_values($list) as $key => $element) {
            $this->writeln(($key + 1) . '. ' . $element);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function hr()
    {
        return $this->p('---------------------------------------');
    }

    /**
     * @param string $code
     * @param string $lang
     * @return $this
     */
    public function code($code, $lang = '')
    {
        return $this
            ->writeln('```' . $lang)
            ->writeln($code)
            ->writeln('```')
            ->br();
    }

    /**
     * @param string $string
     * @return $this
     */
    public function writeln($string)
    {
        return $this
            ->write($string)
            ->br();
    }

    /**
     * @return $this
     */
    public function br()
    {
        return $this->write("\n");
    }

    /**
     * @param string $string
     * @return $this
     */
    public function write($string)
    {
        $this->markdown .= $string;

        return $this;
    }

    /**
     * @return string
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }

    /**
     * @return self
     */
    public static function create()
    {
        return new self();
    }
}