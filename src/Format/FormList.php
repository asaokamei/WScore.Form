<?php
namespace WScore\Form\Format;

use WScore\Form\Lists;

class FormList
{
    /**
     * @param Lists $element
     * @return string
     */
    public static function toString( $element )
    {

        $lists        = $element->getList();
        $checkedValue = (array) $element->getValue();

        $e = clone $element;
        $e->overwriteLists();
        $html = '';
        foreach ( $lists as $value => $label ) {
            if ( in_array( $value, $checkedValue ) ) {
                $html .= '  <li>' . $e->value( $value )->label( $label )->checked()->toString() . "</li>\n";
            }
            else {
                $html .= '  <li>' . $e->value( $value )->label( $label )->checked( false )->toString() . "</li>\n";
            }
        }
        if ( $html ) {
            $html = "<ul>\n{$html}</ul>";
        }
        return $html;
    }

}
