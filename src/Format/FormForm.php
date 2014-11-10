<?php
namespace WScore\Form\Format;

use WScore\Form\Form;

class FormForm
{
    /**
     * @param Form $element
     * @return string
     */
    public static function toString( $element )
    {
        if( $element->isClosed() ) {
            return self::close( $element );
        }
        $html = ToString::htmlProperty( $element, 'id', 'class', 'style' );
        $html = '<' . $element->getTagName() . ' ' . $html . ' >' . "\n";
        $html = ToString::addLabel( $html, $element );
        return $html;
    }

    /**
     * @param Form $element
     * @return string
     */
    public static function close( $element )
    {
        return "</{$element->getTagName()}>";
    }
}
