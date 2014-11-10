<?php
namespace tests\Input;

use WScore\Form\Input;

class InputTest extends \PHPUnit_Framework_TestCase
{
    function setup()
    {
        class_exists( 'WScore\Form\Input' );
    }

    /**
     * @param string $type
     * @param string $name
     * @param string $value
     * @param array  $option
     * @return Input
     */
    function getElement( $type, &$name, &$value, $option = array() )
    {
        $name  = 'name-' . mt_rand( 1000, 9999 );
        $value = 'value-' . mt_rand( 1000, 9999 );
        $form  = Input::$type( $name, $value, $option );
        return $form;
    }

    function test0()
    {
        $form = Input::text( 'test' );
        $this->assertEquals( 'WScore\Basic\Html\FormElement', get_class( $form ) );
    }
}