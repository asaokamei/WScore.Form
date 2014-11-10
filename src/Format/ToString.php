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
                return TextArea::toString( $element );
            }
            return FormInput::toString( $element );
        }
        if( $element instanceof Form ) {
            return FormForm::toString( $element );
        }
        throw new \InvalidArgumentException;
    }
}