<?php

    require_once(APP_SCRIPTS_PHP_PATH . "classes/Module.class.php");
    require_once(APP_SCRIPTS_PHP_PATH . "classes/utils/StringUtils.class.php");

    (function($web, $php) {
        $module = Module::getById("9cce2ed5-3632-4e34-b1eb-a41e1200608a");
        
        $web->addEntrypoint($module->id, "wiki", "Wiki", function($params) use ($web, $php, $module) { 
            require_once($module->getRootPath() . "composer/autoload.php");

            $php->register("pages", "php.libs.TemplateDirectory", ["path" => $module->getViewsPath() . "pages"]);
            $php->register("controls", "php.libs.TemplateDirectory", ["path" => $module->getViewsPath() . "controls"]);
            $php->register("md", $module->alias . ".libs.Markdown");
            $var = $php->autolib("var");
            $var->setValue("relativeUrl", $params["relativeUrl"]);
            $var->setValue("moduleId", $module->id);

            $indexContent = file_get_contents($module->getViewsPath() . "index.view.php");
            $pageContent = $web->executeTemplateContent(["modules", $module->alias, "index." . sha1($indexContent)], $indexContent);
            return $pageContent;
        });
    })($webObject, $phpObject);

?>