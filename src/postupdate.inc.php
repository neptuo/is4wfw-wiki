<?php

    require_once(APP_SCRIPTS_PHP_PATH . "classes/Module.class.php");
    require_once(APP_SCRIPTS_PHP_PATH . "classes/utils/FileUtils.class.php");
    require_once(APP_SCRIPTS_PHP_PATH . "classes/dataaccess/DbMigrator.class.php");

    $module = Module::getById("9cce2ed5-3632-4e34-b1eb-a41e1200608a");
    DbMigrator::run(FileUtils::combinePath($module->getRootPath(), "data/autoupdate.xml"), "wiki-db_version");

?>