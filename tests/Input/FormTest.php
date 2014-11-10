<?php
namespace tests\Input;

use WScore\Form\Builder;
use WScore\Form\Form;

require_once( __DIR__.'/../autoloader.php' );

class FormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Builder
     */
    protected $builder;

    function setup()
    {
        class_exists( 'WScore\Form\Input' );
        class_exists( 'WScore\Form\Form' );
        class_exists( 'WScore\Form\Format\FormList' );
        $this->builder = new Builder();
    }

    /**
     * @test
     */
    function Form_open_returns_form()
    {
        $form = $this->builder->open();
        $this->assertEquals( 'WScore\Form\Form', get_class( $form ) );
    }

    /**
     * @test
     */
    function open_form_tag()
    {
        $form = $this->builder->open()->action('act.php')->uploader();
        $html = <<<END_TAG
<form method="post" action="act.php" enctype="multipart/form-data" >

END_TAG;
        $this->assertEquals( $html, (string) $form );
    }

    /**
     * @test
     */
    function open_close_tag()
    {
        $form = $this->builder->close();
        $html = <<<END_TAG
</form>
END_TAG;
        $this->assertEquals( $html, (string) $form );
    }
}
