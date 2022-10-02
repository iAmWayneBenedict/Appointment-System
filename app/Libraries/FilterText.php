<?php

/**
 * function from : https://splunktool.com/php-swear-word-filter
 *  description: filter and removed unecessary words in text
 */

namespace App\Libraries;

class FilterText
{

    private $swearwords = [
        'pisti', 'putang', 'puta', 'buras', 'buray', 'bray', 'bwesit', 'masi',
        'lintik', 'tarantado', 'kado', 'kayos', 'shit', 'bitch', 'fuck you',
        'pak u', 'naniya'
    ];

    function filtertext(string $text)
    {

        $filterCount = sizeof($this->swearwords);
        for ($i = 0; $i < $filterCount; $i++) {
            $text = preg_replace('/\b' . $this->swearwords[$i] .
                '\b/ie', "str_repeat('*',strlen('$0'))", $text);
        }
        return $text;
    }
}
