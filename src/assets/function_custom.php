<?php
    /**
     * array ( link, content, class_css, title, target )
     */
    function slink(array $link_datas)
    {
        /**
         * Corps même du lien
         */
        if (!empty($link_datas["link"])) { $link = $link_datas["link"]; } else {$link= "";}
        if (!empty($link_datas["content"])) { $content = $link_datas["content"]; } else {$content= $link;}

        /**
         * Paramètres du lien
         */
        if (!empty($link_datas["class_css"])) { $class_css = "class='".$link_datas["class_css"]."'"; } else {$class_css= "";}
        if (!empty($link_datas["title"])) { $title = "title='".$link_datas["title"]."'"; } else {$title= "";}
        if (!empty($link_datas["target"])) { $target = "target='".$link_datas["target"]."'"; } else {$target= "";}        

        return('<a href="'.$link.'" '.$class_css.$title.$target.'>'.$content.'</a>');
    }

    /**
     * Determine the age with the birthday and the currently date.
     * dateOfBirth need to be in format : d-m-Y
     */
    function age(string $dateOfBirth)
    {
        $today = date("d-m-Y");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));      
        $age = $diff->format("%Y");
        return($age);
    }