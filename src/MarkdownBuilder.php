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
     * @return MarkdownBuilder
     */
    public function markdown()
    {
        return new self();
    }

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
        $header = trim($header);

        return $this
            ->writeln($header)
            ->writeln(str_repeat("=", mb_strlen($header)))
            ->br();
    }

    /**
     * @param string $header
     * @return $this
     */
    public function h2($header)
    {
        $header = trim($header);

        return $this
            ->writeln($header)
            ->writeln(str_repeat("-", mb_strlen($header)))
            ->br();
    }

    /**
     * @param string $header
     * @return $this
     */
    public function h3($header)
    {
        $header = trim($header);

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

            $lines = explode("\n", $element);

            foreach ($lines as $i => $line) {
                if ($i == 0) {
                    $this->writeln('* ' . $line);
                } else {
                    $this->writeln('  ' . $line);
                }
            }
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

            $lines = explode("\n", $element);

            foreach ($lines as $i => $line) {
                if ($i == 0) {
                    $this->writeln(($key + 1) . '. ' . $line);
                } else {
                    $this->writeln('   ' . $line);
                }
            }
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
     * @return $this
     */
    public function br()
    {
        return $this->write("\n");
    }

    /**
     * @param string $code
     * @return string
     */
    public function inlineCode($code)
    {
        return sprintf('`%s`', $code);
    }

    /**
     * @param string $string
     * @return string
     */
    public function inlineItalic($string)
    {
        return sprintf('*%s* ', $string);
    }

    /**
     * @param string $string
     * @return $this
     */
    public function italic($string)
    {
        return $this
            ->write($this->inlineItalic($string));
    }


    /**
     * @param string $string
     * @return string
     */
    public function inlineBold($string)
    {
        return sprintf('**%s** ', $string);
    }

    /**
     * @param string $string
     * @return $this
     */
    public function bold($string)
    {
        return $this
            ->write($this->inlineBold($string));
    }

    /**
     * @param string $url
     * @param string $title
     * @return string
     */
    public function inlineLink($url, $title)
    {
        return sprintf('[%s](%s) ', $title, $url);
    }

    /**
     * @param string $url
     * @param string $title
     * @return $this
     */
    public function link($url, $title)
    {
        return $this
            ->write($this->inlineLink($url, $title));
    }

    /**
     * @param string $url
     * @param string $title
     * @return string
     */
    public function inlineImg($url, $title)
    {
        return sprintf('![%s](%s) ', $title, $url);
    }

    /**
     * @param string $url
     * @param string $title
     * @return $this
     */
    public function img($url, $title)
    {
        return $this
            ->write($this->inlineImg($url, $title));
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
        return trim($this->markdown);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMarkdown();
    }
}