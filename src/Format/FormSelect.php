<?php
namespace WScore\Form\Format;

use WScore\Form\Lists;

class FormSelect
{
    /**
     * @param Lists $element
     * @return string
     */
    public static function toString( $element )
    {
        $lists = $element->getList();
        $selectedValue = $element->getValue();
        $element->lists(null);
        $html  = '';
        foreach( $lists as $value => $label ) {
            if( $selectedValue == $value ) {
                $html .= "  <option value=\"{$value}\" selected>{$label}</option>\n";
            } else {
                $html .= "  <option value=\"{$value}\">{$label}</option>\n";
            }
        }
        if( $html ) {
            $prop = ToString::htmlProperty( $element, 'name', 'id', 'class', 'style' );
            $html = "<select {$prop}>" . "\n" . $html . '</select>';
        }
        $html = ToString::addLabel( $html, $element );
        return $html;
    }

}
