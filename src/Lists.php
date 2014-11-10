<?php
namespace WScore\Form;

use WScore\Enum\EnumInterface;

/**
 * Class FormElement
 *
 * @package WScore\Html
 *
 */
class Lists extends Input
{
    /**
     * @var array
     */
    protected $list = array();

    /**
     * @var bool       overwrite this to false for normal input element.
     */
    protected $isList = true;

    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * @var
     */
    protected $asArray;

    // +----------------------------------------------------------------------+
    //  construction 
    // +----------------------------------------------------------------------+
    /**
     * @param string $name
     * @param array  $lists
     * @param string|array $values
     * @return static
     */
    public static function radio( $name, $lists, $values=null )
    {
        return static::make( 'input', $name, $lists, $values )->type( 'radio' );
    }

    /**
     * @param string $name
     * @param array  $lists
     * @param string|array $values
     * @return static
     */
    public static function select( $name, $lists, $values=null )
    {
        return static::make( 'select', $name, $lists, $values );
    }

    /**
     * @param string $name
     * @param array  $lists
     * @param string|array $values
     * @return static
     */
    public static function checkbox( $name, $lists, $values=null )
    {
        $element = static::make( 'input', $name, $lists, $values )->type( 'checkbox' );
        $element->asArray();
        return $element;
    }

    /**
     * @param string $name
     * @param array  $lists
     * @param string|array $values
     * @return static
     */
    protected static function make( $tag, $name, $lists, $values=null )
    {
        $element = new self( $tag );
        $element->name( $name );
        $element->lists( $lists );
        if( $values ) {
            $element->value($values);
        }
        return $element;
    }

    // +----------------------------------------------------------------------+
    //  setting up
    // +----------------------------------------------------------------------+
    /**
     * @param bool $isList
     */
    public function overwriteLists( $isList = false ) {
        $this->isList = $isList;
    }

    /**
     * @return bool
     */
    public function isList() {
        return $this->isList;
    }

    /**
     * @param array $lists
     * @return $this
     */
    public function lists( $lists ) {
        $this->list = $lists;
        return $this;
    }
    
    /**
     * @param EnumInterface $enum
     * @return $this
     */
    public function enum( EnumInterface $enum ) {
        $this->lists( $enum::getChoices() );
        $this->value( $enum->get() );
        return $this;
    }

    /**
     * for Select, select multiple items.
     *
     * @param bool $as
     * @return $this
     */
    public function multiple( $as = true )
    {
        $this->setAttribute( 'multiple', true );
        $this->asArray();
        return $this;
    }

    /**
     * use name as array (i.e. name="input_name[]")
     *
     * @param bool $as
     * @return $this
     */
    public function asArray( $as = true )
    {
        $this->asArray = $as;
        return $this;
    }

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
     * @return array
     */
    public function getList() {
        return $this->list;
    }
    // +----------------------------------------------------------------------+
}