<?php
namespace WScore\Form\Format;

use WScore\Form\Input;

class FormTextArea
{
    /**
     * @param Input $element
     * @return string
     */
    public static function toString( $element )
    {
        $tag  = $element->getTagName();
        $value = $element->getValue();
        $prop = ToString::htmlProperty( $element, 'name', 'id', 'class', 'style' );
        $html = "<{$tag} " . "{$prop}>{$value}</{$tag}>";
        return $html;
    }
}