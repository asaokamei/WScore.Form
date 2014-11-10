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
        $html = self::htmlProperty( $element, 'type', 'name', 'value', 'id', 'class', 'style' );
        $html = '<input ' . $html . ' />' . "\n";
        $html = self::addLabel( $html, $element );
        return $html;
    }

    /**
     * @param Input $element
     * @return string
     * @internal param $type
     * @internal param $name
     * @internal param $id
     */
    public static function htmlProperty( $element )
    {
        $args = func_get_args();
        array_shift( $args );
        $property = [];
        foreach( $args as $key ) {
            $getter = 'get' . ucwords( $key );
            if( method_exists( $element, $getter ) ) {
                $value = $element->$getter();
            } else {
                $value = $element->get( $key );
            }
            if( "$value"!="" ) {
                $property[] = $key . "=\"{$value}\"";
            }
        }
        if( $attribute = $element->getAttribute() ) {
            $property[] = $attribute;
        }
        $property = array_values( $property );
        $html = implode( ' ', $property );
        return $html;
    }

    /**
     * @param string $html
     * @param Input $element
     * @return string
     */
    public static function addLabel( $html, $element )
    {
        if( $label = $element->getLabel() ) {
            $html = "<label>{$html} {$label}</label>";
        }
        return $html;
    }
}
