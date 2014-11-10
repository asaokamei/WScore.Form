<?php
namespace WScore\Form\Format;

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
            return FormList::toString( $element );
        }
        if( $element instanceof Input ) {
            if( 'textarea' == $element->getTagName() ) {
                return TextArea::toString( $element );
            }
            return FormInput::toString( $element );
        }
    }
}