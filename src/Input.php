<?php
namespace WScore\Form;

/**
 * Class Input
 *
 * @package WScore\Html
 *
 * @method static Input text( $name = null, $value = null, $option = [ ] )
 * @method static Input hidden( $name = null, $value = null, $option = [ ] )
 * @method static Input search( $name = null, $value = null, $option = [ ] )
 * @method static Input tel( $name = null, $value = null, $option = [ ] )
 * @method static Input url( $name = null, $value = null, $option = [ ] )
 * @method static Input email( $name = null, $value = null, $option = [ ] )
 * @method static Input password( $name = null, $value = null, $option = [ ] )
 * @method static Input datetime( $name = null, $value = null, $option = [ ] )
 * @method static Input date( $name = null, $value = null, $option = [ ] )
 * @method static Input month( $name = null, $value = null, $option = [ ] )
 * @method static Input week( $name = null, $value = null, $option = [ ] )
 * @method static Input time( $name = null, $value = null, $option = [ ] )
 * @method static Input number( $name = null, $value = null, $option = [ ] )
 * @method static Input range( $name = null, $value = null, $option = [ ] )
 * @method static Input color( $name = null, $value = null, $option = [ ] )
 * @method static Input file( $name = null, $value = null, $option = [ ] )
 * @method static Input radio( $name = null, $value = null, $option = [ ] )
 * @method static Input checkbox( $name = null, $value = null, $option = [ ] )
 * @method Input required(bool)
 * @method Input checked(bool)
 * @method Input max(int)
 * @method Input maxlength(int)
 * @method Input pattern(string)
 * @method Input placeholder(string)
 * @method Input readonly(bool)
 * @method Input size(int)
 * @method Input step(bool)
 * @method Input class( $class )
 * @method Input onclick( $class )
 */
class Input extends Tag
{
    protected $type;

    protected $name;

    protected $multiple = false;

    protected $value;

    protected $id;

    // +----------------------------------------------------------------------+
    //  construction 
    // +----------------------------------------------------------------------+
    /**
     * @param string $method
     * @param array  $args
     * @return static
     */
    static function __callStatic( $method, $args )
    {
        $name    = $args[ 0 ];
        $value   = isset( $args[ 1 ] ) ? $args[ 1 ] : null;
        $options = isset( $args[ 2 ] ) ? $args[ 2 ] : [ ];
        $element = static::forge( 'input', $name, $value, $options );
        $element->type( $method );
        return $element;
    }

    /**
     * @param string $name
     * @param string $value
     * @param array  $options
     * @return Input
     */
    public static function textarea( $name, $value = null, $options = [ ] )
    {
        return static::forge( 'textarea', $name, $value, $options );
    }

    /**
     * @param string       $tag
     * @param string       $name
     * @param string|array $value
     * @param array        $options
     * @return static
     */
    public static function forge( $tag, $name, $value, $options )
    {
        $element = new static( $tag );
        $element->name( $name );
        if ( $value ) {
            $element->value( $value );
        }
        if ( $options ) {
            $element->apply( $options );
        }
        return $element;
    }
    // +----------------------------------------------------------------------+
    //  setting up
    // +----------------------------------------------------------------------+
    /**
     * @param string $type
     * @return $this
     */
    public function type( $type )
    {
        $this->type = strtolower( $type );
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name( $name )
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function id( $id )
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function value( $value )
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function imeOn()
    {
        return $this->style( 'ime-mode', 'active' );
    }

    /**
     * @return $this
     */
    public function imeOff()
    {
        return $this->style( 'ime-mode', 'inactive' );
    }

    /**
     * @param string $width
     * @return $this
     */
    public function width( $width ) {
        return $this->style( 'width', $width );
    }

    /**
     * @param string $height
     * @return $this
     */
    public function height( $height ) {
        return $this->style( 'height', $height );
    }

    // +----------------------------------------------------------------------+
    //  getting information
    // +----------------------------------------------------------------------+
    /**
     * @return mixed
     */
    public function getName()
    {
        if ( $this->multiple ) {
            return $this->name . '[]';
        }
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getId()
    {
        if ( $this->id ) return $this->id;
        if ( in_array( $this->type, [ 'radio', 'checkbox' ] ) ) {
            return $this->name . '-' . $this->value;
        }
        return $this->name;
    }
    // +----------------------------------------------------------------------+
}