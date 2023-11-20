<?php
/**
 * Global pages templates creator
 */

class PagesTemplates{

    /**
     * Init request info
     * 
     * @param array information about request
     */
    private $r = "";
    protected function initRequestInfo($r)
    {
        $this->r = $r;
    }

    
    /**
     * Set template link considering active language
     * 
     * @param string template
     * 
     * @return html
     */
    protected function prepareAndShowTemplate($tmp)
    {
        // set assets path
        $tmp = str_replace("{SITE_ASSETS}", SITE_ASSETS, $tmp);

        // set site link
        $tmp = str_replace("{SITE_LINK}", SITE_LINK, $tmp);

        // set lang link
        $tmp = str_replace("{LANG_LINK}", $this->r['lang_link'], $tmp);

        // set other links
        // $tmp = str_replace("{OTHER_DOMAIN_LINK}", OTHER_DOMAIN_LINK, $tmp);

        // show template
        echo $tmp;
    }


    /**
     * Creation of page head template
     */
    protected function showHead()
    {
        // get template
        $tmp = file_get_contents(APP_DIR . "Views/public/components/head/tmp.html");
        $arr = include(APP_DIR . "Views/public/components/head/info.php"); // it would be better to store this info in the database

        // set page metadata
        $tmp = str_replace("{HTML}", $arr[$this->r['page_with_params']][$this->r['lang']], $tmp);

        // show template
        $this->prepareAndShowTemplate($tmp);
    }


    /**
     * Creation of page header template
     */
    protected function showHeader()
    {
        // get template
        $tmp = file_get_contents(APP_DIR . "Views/public/components/header/tmp.html");

        // show template
        $this->prepareAndShowTemplate($tmp);
    }


    /**
     * Creation of page scripts template
     */
    protected function showScripts()
    {
        //
        // IF YOU HAVE MANY PAGES WITH DIFFERENT SCRIPTS
        // it would be better to create routing with *HTML files intsead of using info.php file
        // 

        // get template
        $tmp = file_get_contents(APP_DIR . "Views/public/components/scripts/html.php");
        $arr  = include(APP_DIR . "Views/public/components/scripts/info.php");

        // set page scripts
        (!empty($arr[$this->r['page_name_only']])) ? $scripts = $arr[$this->r['page_name_only']] : $scripts = "";
        $tmp = str_replace("{SCRIPTS}", $scripts, $tmp);

        // show template
        $this->prepareAndShowTemplate($tmp);
    }
}
?>