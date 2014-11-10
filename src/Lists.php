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
        return static::make( $name, $lists, $values );
    }

    /**
     * @param string $name
     * @param array  $lists
     * @param string|array $values
     * @return static
     */
    public static function select( $name, $lists, $values=null )
    {
        return static::make( $name, $lists, $values );
    }

    /**
     * @param string $name
     * @param array  $lists
     * @param string|array $values
     * @return static
     */
    public static function checkbox( $name, $lists, $values=null )
    {
        $element = static::make( $name, $lists, $values );
        $element->asArray();
        return $element;
    }

    /**
     * @param string $name
     * @param array  $lists
     * @param string|array $values
     * @return static
     */
    protected static function make( $name, $lists, $values=null )
    {
        $element = new self( $name );
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