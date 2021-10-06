<?php

namespace Xpyun\util;

class Encoding
{
   public static function CalcGbkLenForPrint($data)
    {
        return iconv_strlen($data, iconv_get_encoding("internal_encoding")) * 2;
    }

    public static function CalcAsciiLenForPrint($data)
    {
        return strlen($data);
    }
}

?>