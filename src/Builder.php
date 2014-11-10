<?php
namespace WScore\Form;

/**
 * Class Builder
 * @package WScore\Form
 *
 * @method Input text( $name, $value = null, $option = [ ] )
 * @method Input hidden( $name, $value = null, $option = [ ] )
 * @method Input search( $name, $value = null, $option = [ ] )
 * @method Input tel( $name, $value = null, $option = [ ] )
 * @method Input url( $name, $value = null, $option = [ ] )
 * @method Input email( $name, $value = null, $option = [ ] )
 * @method Input password( $name, $value = null, $option = [ ] )
 * @method Input datetime( $name, $value = null, $option = [ ] )
 * @method Input date( $name, $value = null, $option = [ ] )
 * @method Input month( $name, $value = null, $option = [ ] )
 * @method Input week( $name, $value = null, $option = [ ] )
 * @method Input time( $name, $value = null, $option = [ ] )
 * @method Input number( $name, $value = null, $option = [ ] )
 * @method Input range( $name, $value = null, $option = [ ] )
 * @method Input color( $name, $value = null, $option = [ ] )
 * @method Input file( $name, $value = null, $option = [ ] )
 * @method Input radio( $name, $value = null, $option = [ ] )
 * @method Input checkbox( $name, $value = null, $option = [ ] )
 */
class Builder
{
    // +----------------------------------------------------------------------+
    //  construction and managing object
    // +----------------------------------------------------------------------+
    public function __construct()
    {

    }

    // +----------------------------------------------------------------------+
    //  open/close form
    // +----------------------------------------------------------------------+
    /**
     * @return Form
     */
    public function open()
    {
        return Form::open();
    }

    /**
     * @return Form
     */
    public function close()
    {
        return Form::close();
    }

    // +----------------------------------------------------------------------+
    //  lists (select, radio, and checkbox)
    // +----------------------------------------------------------------------+
    /**
     * @param string       $name
     * @param array        $lists
     * @param string|array $values
     * @return static
     */
    public function checkList( $name, $lists, $values = null )
    {
        return Lists::checkbox( $name, $lists, $values );
    }

    /**
     * @param string $name
     * @param array  $lists
     * @param string $values
     * @return static
     */
    public function radioList( $name, $lists, $values = null )
    {
        return Lists::radio( $name, $lists, $values );
    }

    /**
     * @param string       $name
     * @param array        $lists
     * @param string|array $values
     * @return static
     */
    public function select( $name, $lists, $values = null )
    {
        return Lists::select( $name, $lists, $values );
    }

    // +----------------------------------------------------------------------+
    //  other input elements
    // +----------------------------------------------------------------------+
    /**
     * @param string $name
     * @param string $value
     * @param array  $options
     * @return Input
     */
    public function textarea( $name, $value = null, $options = [ ] )
    {
        return Input::textarea( $name, $value, $options );
    }

    /**
     * @param $method
     * @param $args
     * @internal param string $name
     * @internal param string $value
     * @internal param array $options
     * @return static
     */
    public function __call( $method, $args )
    {
        $name    = isset( $args[ 0 ] ) ? $args[ 0 ] : null;
        $value   = isset( $args[ 1 ] ) ? $args[ 1 ] : null;
        $options = isset( $args[ 2 ] ) ? $args[ 2 ] : [ ];
        $element = Input::forge( 'input', $name, $value, $options );
        $element->type( $method );
        return $element;
    }

}