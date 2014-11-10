<?php
namespace tests\Input;

use WScore\Form\Input;

require_once( __DIR__.'/../autoloader.php' );

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
        $form = $this->getElement( 'test', $name, $value );
        $this->assertEquals( 'WScore\Form\Input', get_class( $form ) );
    }


    /**
     * @test
     */
    function input_element()
    {
        $form = $this->getElement( 'text', $name, $value, ['required'] );
        $html = $form->toString();
        $this->assertEquals("<input type=\"text\" name=\"$name\" value=\"$value\" id=\"$name\" required />\n", $html );
    }

    /**
     * @test
     */
    function radio_element()
    {
        $form = $this->getElement( 'radio', $name, $value );
        $this->assertEquals( "$name-$value", $form->getId() );
        $html = $form->toString();
        $this->assertEquals("<input type=\"radio\" name=\"$name\" value=\"$value\" id=\"$name-$value\" />\n", $html );
    }

    /**
     * @test
     */
    function checkbox_element()
    {
        $form = $this->getElement( 'checkbox', $name, $value );
        $this->assertEquals( "$name-$value", $form->getId() );
        $html = $form->toString();
        $this->assertEquals("<input type=\"checkbox\" name=\"$name\" value=\"$value\" id=\"$name-$value\" />\n", $html );
    }

    /**
     * @test
     */
    function textArea_element()
    {
        $form = $this->getElement( 'textarea', $name, $value );
        $html = $form->toString();
        $this->assertEquals( "<textarea name=\"$name\" id=\"$name\">$value</textarea>", $html );
    }

    /**
     * @test
     */
    function textArea_with_width_and_height()
    {
        $form = $this->getElement( 'textArea', $name, $value, ['width'=>'100%', 'height'=>'6em'] );
        $this->assertEquals( "<textarea name=\"$name\" id=\"$name\" style=\"width:100%; height:6em\">$value</textarea>", (string) $form );
    }
}