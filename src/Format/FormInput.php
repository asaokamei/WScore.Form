<?php
namespace WScore\Form\Format;

use WScore\Form\Input;

class FormInput
{
    /**
     * @param Input $element
     * @return string
     */
    public static function toString( $element )
    {
        $html = ToString::htmlProperty( $element, 'type', 'name', 'value', 'id', 'class', 'style' );
        $html = '<input ' . $html . ' />' . "\n";
        $html = ToString::addLabel( $html, $element );
        return $html;
    }
}
