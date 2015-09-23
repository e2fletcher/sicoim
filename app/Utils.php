<?php

namespace App;


class Utils
{
	public static function after ($this, $inthat)
    {
        if (!is_bool(strpos($inthat, $this)))
        return substr($inthat, strpos($inthat,$this)+strlen($this));
    }

    public static function after_last ($this, $inthat)
    {
        if (!is_bool(strrevpos($inthat, $this)))
        return substr($inthat, strrevpos($inthat, $this)+strlen($this));
    }

    public static function before ($this, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $this));
    }

    public static function before_last ($this, $inthat)
    {
        return substr($inthat, 0, strrevpos($inthat, $this));
    }

    public static function between ($this, $that, $inthat)
    {
        return before ($that, after($this, $inthat));
    }

    public static function between_last ($this, $that, $inthat)
    {
     return after_last($this, before_last($that, $inthat));
    }
}
