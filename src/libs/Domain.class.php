<?php

namespace wiki;

use BaseTagLib;

class Domain extends BaseTagLib {

    public function addToFavorites($pageId) {
        $favorites = parent::autolib("var")->getProperty("favorites");
        $favorites = explode(",", $favorites);

        $favorites[] = $pageId;

        $favorites = implode(",", $favorites);
        parent::autolib("var")->setValue("favorites", $favorites, "user");
    }

    public function removeFromFavorites($pageId) {
        $favorites = parent::autolib("var")->getProperty("favorites");
        $favorites = explode(",", $favorites);

        if (($key = array_search($pageId, $favorites)) !== false) {
            unset($favorites[$key]);
        }

        $favorites = implode(",", $favorites);
        parent::autolib("var")->setValue("favorites", $favorites, "user");
    }
}

?>