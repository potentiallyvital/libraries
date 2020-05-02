<?php

// this file contains application specific global functions
// used for session handling, url handling, place handling, etc

/**
 * convert a string into a pretty url slug
 * ex:
 * input: 187 Quick Foxes - all jumping & stuff
 * output: 187-quick-foxes-all-jumping-and-stuff
 *
 * @param $string - string (string to convert)
 *
 * @return string
 */
function slugify($string, $allow_slash = false)
{
        $string = strtolower($string);
        if (!$allow_slash)
        {
                $string = str_replace('/', ' and ', $string);
        }
        $string = str_replace('&', ' and ', $string);
        $string = str_replace(['[',']','_'], '-', $string);
        $string = preg_replace('|[^-/ a-zA-Z0-9]|', '', $string);
        $string = str_replace(' ', '-', $string);
        while (stristr($string, '--'))
        {
                $string = str_replace('--', '-', $string);
        }
        $string = ltrim($string, '-');
        $string = rtrim($string, '-');
        return $string;
}

/**
 * convert a url slug into a pretty string
 *
 * @param $slug - string (url part to convert)
 * @para $ucfirst - boolean (true = capital first letter only, false = cap all words)
 *
 * @return string
 */
function deslugify($string, $ucfirst = false)
{
        $string = str_replace('/', ' | ', $string);
        $string = str_replace(['-','_'], ' ', $string);
        $string = str_replace(' &amp; ', ' & ', $string);
        $string = str_replace(' and ', ' & ', $string);
        if ($ucfirst)
        {
                $string = ucfirst($string);
        }
        else
        {
                $string = ucwords($string);
        }
        return $string;
}

/**
 * display a monetary value
 *
 * @param $amount - money amount
 *
 * @return string
 */
function money($amount)
{
        if (is_numeric($amount))
        {
                $amount = decimal($amount);
        }

        $amount = '<small>$</small>'.$amount;
        $amount = str_replace(',', '<small>,</small>', $amount);

        return '<span class="money">'.$amount.'</span>';
}

/**
 * display a pretty decimal
 */
function decimal($value)
{
        if (is_numeric($value) || stristr($value, '.'))
        {
                $value = number_format($value, 2);
                $value = explode('.', $value);
                $decimal = array_pop($value);
                $value = $value[0].'<small><sup>.'.$decimal.'</sup></small>';
        }

        return $value;
}
