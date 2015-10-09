<?php

function shorten( $html, $length )
{
    $output = '';
    $cursor = 0;
    $add = true;
    $newLength = 0;
    if ( !preg_match_all( '/<[^>]*>/U', $html, $matches, PREG_OFFSET_CAPTURE ) )
    {
        if ( strlen($html) > $length )
        {
            return substr( $html, 0, $length ) . '...';
        }
        else
        {
            return $html;
        }
    }

    foreach ( $matches[0] as &$match )
    {
        $text = substr( $html, $cursor, $match[1]-$cursor );
        $cursor = $match[1]+strlen($match[0]);
        while ( 1 )
        {
            $newText = preg_replace( '/[\s]{2}/U', ' ', $text );
            if ( $newText == '' || $newText == $text )
            {
                $text = $newText;
                break;
            }
            $text = $newText;
        }
        $text = trim($text);
        if ( $add )
        {
            if ( $newLength + strlen($text) > $length )
            {
                $add = false;
                $text = substr( $text, 0, $length - $newLength ) . '...';
            }
            $newLength += strlen($text);
            $output .= $text;
        }
        $output .= $match[0];
    }
   
    if ( $add && $cursor < strlen($html) )
    {
        $text = substr( $html, $cursor );
        while ( 1 )
        {
            $newText = preg_replace( '/[\s]{2}/U', ' ', $text );
            if ( $newText == '' || $newText == $text )
            {
                $text = $newText;
                break;
            }
            $text = $newText;
        }
        $text = trim($text);
        if ( $newLength + strlen($text) > $length )
        {
            $output .= substr( $text, 0, $length - $newLength ) . '...';
        }
        else
        {
            $output .= $text;
        }
    }
    return $output;
}

?>