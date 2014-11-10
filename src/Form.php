<?php
namespace WScore\Form;

/**
 * Class Form
 *
 * @package WScore\Form
 */
class Form extends Tag
{
    /**
     * @return Form
     */
    public static function open()
    {
        $form = new self( 'form' );
        $form->method( 'post' );
        return $form;
    }

    /**
     * @return Form
     */
    public static function close()
    {
        $self = new self('form');
        return $self->closeTag();
    }

    /**
     * @param string $method
     * @return $this
     */
    public function method( $method )
    {
        return $this->setAttribute( 'method', $method );
    }

    /**
     * @param string $action
     * @return $this
     */
    public function action( $action )
    {
        return $this->setAttribute( 'action', $action );
    }

    /**
     * @return $this
     */
    public function uploader()
    {
        return $this->setAttribute( 'enctype', 'multipart/form-data' );
    }
}
