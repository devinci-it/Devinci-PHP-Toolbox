<?php

namespace Devinci\UICore;

class UICore
{
    /**
     * Include CSS files by generating link tags.
     *
     * @param string $publicDirectory The relative path to the public directory.
     */
    public static function includeCssFiles($publicDirectory = '/public/')
    {
        $cssFiles = [
            'buttons.css',
            'forms.css',
            'home.css',
            'reset.css',
            'styles.css',
            'toast.css',
            'typography.css',
            'ui.css',
            'user_management.css',
        ];

        $cssPath = $publicDirectory . '/css/';

        foreach ($cssFiles as $cssFile) {
            echo '<link rel="stylesheet" type="text/css" href="' . $cssPath . $cssFile . '">';
        }
    }
}
