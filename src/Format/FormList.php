<?php
namespace WScore\Form\Format;

use WScore\Form\Lists;

class FormList
{
    /**
     * @param Lists $e
     * @return string
     */
    public static function toString( $e )
    {
        $element = clone $e;

        $lists        = $element->getList();
        $checkedValue = $element->getValue();
        $element->lists( null );
        $html = '';
        foreach ( $lists as $value => $label ) {
            if ( $checkedValue == $value ) {
                $html .= '  <li>' . $element->value( $value )->label( $label )->checked()->toString() . "</li>\n";
            }
            else {
                $html .= '  <li>' . $element->value( $value )->label( $label )->checked( false )->toString() . "</li>\n";
            }
        }
        if ( $html ) {
            $html = "<ul>\n{$html}</ul>";
        }
        return $html;
    }

}
