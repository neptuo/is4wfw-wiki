<?php

	require_once(APP_SCRIPTS_PHP_PATH . "classes/manager/SystemProperty.class.php");

    global $dbObject;

    $da = $dbObject->getDataAccess();

	$propertyName = "wiki-db_version";
	$property = new SystemProperty($da);

	// Nacti verzi system a verzi db
	$databaseVersion = intval($property->getValue($propertyName));
	$newVersion = $databaseVersion;

	$xml = new SimpleXMLElement(file_get_contents($module->getRootPath() . 'data/autoupdate.xml'));
	foreach ($xml->script as $script) {
		$attrs = $script->attributes();

		$build = intval($attrs['build']);
		
		if ($build > $databaseVersion) {
			$ok = false;
			$sql = '';
			if ($attrs['resource'] != '') {
				if (file_exists($attrs['resource'])) {
					$ok = true;
					$sql = file_get_contents($attrs['resource']);
				}
			} else {
				$ok = true;
				$sql = trim($script);
			}

            if ($ok) {
                $sql = explode(PHP_EOL, $sql);
                foreach ($sql as $command) {
                    $da->execute($command);
                }
                
                if ($build > $newVersion) {
                    $newVersion = $build;
                }
            }
		}
	}

	if ($databaseVersion != $newVersion) {
		$property->setValue($propertyName, $newVersion);
	}

?>