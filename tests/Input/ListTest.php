<?php
namespace tests\Input;

use WScore\Form\Builder;
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
        $builder = new Builder();
        $form  = $builder->$type( $name, $lists, $option );
        return $form;
    }

    function test0()
    {
        $form = $this->getElement( 'radioList', $name, $value );
        $this->assertEquals( 'WScore\Form\Lists', get_class( $form ) );
    }

    /**
     * @test
     */
    function radio_element_with_list()
    {
        $form = $this->getElement( 'radioList', $name, $lists );
        $label1 = $lists['value-1'];
        $label2 = $lists['value-2'];
        $form->value( 'value-1' );
        $html = <<<TAG
<ul>
  <li><label><input type="radio" name="{$name}" value="value-1" id="$name-value-1" checked />
 $label1</label></li>
  <li><label><input type="radio" name="{$name}" value="value-2" id="$name-value-2" />
 $label2</label></li>
</ul>
TAG;

        $this->assertEquals( $html, (string) $form );
    }

    /**
     * @test
     */
    function check_element_with_list()
    {
        $form = $this->getElement( 'checkList', $name, $lists );
        $label1 = $lists['value-1'];
        $label2 = $lists['value-2'];
        $form->value( ['value-1', 'value-2'] );
        $html = <<<TAG
<ul>
  <li><label><input type="checkbox" name="{$name}[]" value="value-1" id="$name-value-1" checked />
 $label1</label></li>
  <li><label><input type="checkbox" name="{$name}[]" value="value-2" id="$name-value-2" checked />
 $label2</label></li>
</ul>
TAG;
        $this->assertEquals( $html, (string) $form );
    }

    /**
     * @test
     */
    function select_element()
    {
        $form = $this->getElement( 'select', $name, $lists );
        $label1 = $lists['value-1'];
        $label2 = $lists['value-2'];
        $form->value( 'value-1' );
        $html = <<<TAG
<select name="$name" id="$name">
  <option value="value-1" selected>$label1</option>
  <option value="value-2">$label2</option>
</select>
TAG;
        $this->assertEquals( $html, (string) $form );
    }

    /**
     * @test
     */
    function select_multiple_element()
    {
        $form = $this->getElement( 'select', $name, $lists );
        $form->multiple();
        $label1 = $lists['value-1'];
        $label2 = $lists['value-2'];
        $form->value( 'value-1' );
        $html = <<<TAG
<select name="{$name}[]" id="$name" multiple>
  <option value="value-1" selected>$label1</option>
  <option value="value-2">$label2</option>
</select>
TAG;
        $this->assertEquals( $html, (string) $form );
    }
}