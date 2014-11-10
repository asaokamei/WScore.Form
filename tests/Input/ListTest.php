<?php
namespace tests\Input;

use WScore\Form\Input;
use WScore\Form\Lists;

require_once( __DIR__.'/../autoloader.php' );

class ListTest extends \PHPUnit_Framework_TestCase
{
    function setup()
    {
        class_exists( 'WScore\Form\Input' );
        class_exists( 'WScore\Form\List' );
        class_exists( 'WScore\Form\Format\FormList' );
    }

    /**
     * @param string $type
     * @param string $name
     * @param array  $lists
     * @param array  $option
     * @return Lists
     */
    function getElement( $type, &$name, &$lists, $option = array() )
    {
        $name  = 'name-' . mt_rand( 1000, 9999 );
        $lists = [
            'value-1' => 'label-'.mt_rand(1000,9999),
            'value-2' => 'label-'.mt_rand(1000,9999),
        ];
        $form  = Lists::$type( $name, $lists, $option );
        return $form;
    }

    function test0()
    {
        $form = $this->getElement( 'radio', $name, $value );
        $this->assertEquals( 'WScore\Form\Lists', get_class( $form ) );
    }

    /**
     * @test
     */
    function radio_element_with_list()
    {
        $form = $this->getElement( 'radio', $name, $lists );
        $label1 = $lists['value-1'];
        $label2 = $lists['value-2'];
        $form->value( 'value-1' );
        $html = $form->toString();
        $this->assertEquals(
            "<ul>\n" .
            "  <li><label><input type=\"radio\" name=\"{$name}\" value=\"value-1\" id=\"$name-value-1\" checked />\n" .
            " $label1</label></li>\n" .
            "  <li><label><input type=\"radio\" name=\"{$name}\" value=\"value-2\" id=\"$name-value-2\" />\n" .
            " $label2</label></li>\n" .
            "</ul>", $html );
    }

    /**
     * @test
     */
    function check_element_with_list()
    {
        $form = $this->getElement( 'checkbox', $name, $lists );
        $label1 = $lists['value-1'];
        $label2 = $lists['value-2'];
        $form->value( 'value-1' );
        $html = $form->toString();
        $this->assertEquals(
            "<ul>\n" .
            "  <li><label><input type=\"checkbox\" name=\"{$name}\" value=\"value-1\" id=\"$name-value-1\" checked />\n" .
            " $label1</label></li>\n" .
            "  <li><label><input type=\"checkbox\" name=\"{$name}\" value=\"value-2\" id=\"$name-value-2\" />\n" .
            " $label2</label></li>\n" .
            "</ul>", $html );
    }

    /**
     * @ test
     */
    function select_element()
    {
        $form = $this->getElement( 'select', $name, $value );
        $val2 = 'value-not';
        $list = [
            $value => 'Selected Value',
            $val2  => 'Not Selected',
        ];
        $form->lists( $list );
        $html = $form->toString();
        $this->assertEquals( "<select name=\"$name\" id=\"$name\">\n" .
            "  <option value=\"$value\" selected>Selected Value</option>\n" .
            "  <option value=\"$val2\">Not Selected</option>\n" .
            "</select>", $html );
    }
}