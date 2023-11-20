<?php
/**
 * Home page model
 */

// require SYSTEM_DIR . 'Database/Database.php';

class Home{

    /**
     * Create page title HTML layout
     * 
     * @param string selected lang
     * 
     * @return html
     */
    public static function createPageTitle($lang)
    {
        $title = "";

        if ($lang == "ua")
        {
            $title = "<h1>Головна сторiнка</h1>";
        }
        elseif ($lang == "ru")
        {
            $title = "<h1>Главная страница</h1>";
        }
        elseif ($lang == "en")
        {
            $title = "<h1>Home page</h1>";
        }

        return $title;
    }

}

?>