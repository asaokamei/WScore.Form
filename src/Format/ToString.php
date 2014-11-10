<?php
namespace WScore\Form\Format;

use WScore\Form\Form;
use WScore\Form\Input;
use WScore\Form\Lists;
use WScore\Form\Tag;

class ToString
{
    /**
     * @param Tag $element
     * @return string
     */
    public static function format( $element )
    {
        if( $element instanceof Lists && $element->isList() ) {
            if( 'select' == $element->getTagName() ) {
                return FormSelect::toString( $element );
            }
            return FormList::toString( $element );
        }
        if( $element instanceof Input ) {
            if( 'textarea' == $element->getTagName() ) {
                return FormTextArea::toString( $element );
            }
            return FormInput::toString( $element );
        }
        if( $element instanceof Form ) {
            return FormForm::toString( $element );
        }
        throw new \InvalidArgumentException;
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