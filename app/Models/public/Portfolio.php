<?php
/**
 * Portfolio pages model
 */

// require SYSTEM_DIR . 'Database/Database.php';

class Portfolio{

    /**
     * Validate if selected project exists
     * 
     * @param string selected project name
     * 
     * @return html
     */
    public static function validateProjectURL($project)
    {
        // $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // $urls = $db->query("SELECT `links` FROM `projects_url` WHERE `status`=?", "public")->fetchAll();

        $urls = ["project-a", "project-b", "project-c"];
        
        $validURL = false;
        if(in_array($project, $urls)) $validURL = true;

        return $validURL;
    }

    /**
     * Create buffer page title HTML layout
     * 
     * @param string selected lang
     * 
     * @return html
     */
    public static function createBufferPageTitle($lang)
    {
        $title = "";

        if ($lang == "ua")
        {
            $title = "<h1>Буфер проєктів</h1>";
        }
        elseif ($lang == "ru")
        {
            $title = "<h1>Буфер проектов</h1>";
        }
        elseif ($lang == "en")
        {
            $title = "<h1>Projects buffer</h1>";
        }

        return $title;
    }


    /**
     * Get project page title HTML layout
     * 
     * @param string selected lang
     * @param string selected project
     * 
     * @return html
     */
    public static function getProjectPageTitle($lang, $project)
    {
        // $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // $info = $db->query("SELECT `title_?` FROM `projects_url` WHERE `status`=?", $lang, "public")->fetchArray();

        $info = [
            "project-a" => [
                "ua" => "<h1>Проєкт А</h1>",
                "ru" => "<h1>Проект A</h1>",
                "en" => "<h1>Projects A</h1>",
            ],
            "project-b" => [
                "ua" => "<h1>Проєкт B</h1>",
                "ru" => "<h1>Проект B</h1>",
                "en" => "<h1>Projects B</h1>",
            ],
            "project-c" => [
                "ua" => "<h1>Проєкт C</h1>",
                "ru" => "<h1>Проект C</h1>",
                "en" => "<h1>Projects C</h1>",
            ]
        ];

        return $info[$project][$lang];
    }
}

?>