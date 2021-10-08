<?php

    use League\CommonMark\GithubFlavoredMarkdownConverter;
    use League\CommonMark\Environment\Environment;

    use League\CommonMark\Extension\ExtensionInterface;
    use League\CommonMark\Environment\ConfigurableEnvironmentInterface;

    use League\CommonMark\Extension\Autolink\AutolinkExtension;
    use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
    use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
    use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
    use League\CommonMark\Extension\Table\TableExtension;
    use League\CommonMark\Extension\TaskList\TaskListExtension;
    use League\CommonMark\MarkdownConverter;

    class Markdown extends BaseTagLib {

        public function render($source) {
            self::ensureCacheDirectory();

            $cachePath = self::CacheDirectory . sha1($source) . ".html";
            if (file_exists($cachePath)) {
                return file_get_contents($cachePath);
            }

            $converter = $this->createConverter();

            $html = $converter->convertToHtml($source);
            file_put_contents($cachePath, $html);

            return $html;
        }

        private const CacheDirectory = CACHE_PATH . "markdown/";

        private static function ensureCacheDirectory() {
            if (!file_exists(self::CacheDirectory)) {
                mkdir(self::CacheDirectory);
            }
        }

        private function createConverter() {
            // Define your configuration, if needed
            $config = [];

            // Configure the Environment with all the CommonMark parsers/renderers
            $environment = new Environment($config);
            $environment->addExtension(new CommonMarkCoreExtension());

            // Remove any of the lines below if you don't want a particular feature
            $environment->addExtension(new AutolinkExtension());
            $environment->addExtension(new DisallowedRawHtmlExtension());
            $environment->addExtension(new StrikethroughExtension());
            $environment->addExtension(new TableExtension());
            $environment->addExtension(new TaskListExtension());

            $converter = new MarkdownConverter($environment);

            return $converter;
        }
    }

?>