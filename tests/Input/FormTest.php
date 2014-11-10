<?php
namespace tests\Input;

use WScore\Form\Form;

require_once( __DIR__.'/../autoloader.php' );

class FormTest extends \PHPUnit_Framework_TestCase
{
    function setup()
    {
        class_exists( 'WScore\Form\Input' );
        class_exists( 'WScore\Form\Form' );
        class_exists( 'WScore\Form\Format\FormList' );
    }

    /**
     * @test
     */
    function Form_open_returns_form()
    {
        $form = Form::open();
        $this->assertEquals( 'WScore\Form\Form', get_class( $form ) );
    }

    /**
     * @test
     */
    function open_form_tag()
    {
        $form = Form::open()->action('act.php')->uploader();
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
        $form = Form::close();
        $html = <<<END_TAG
</form>
END_TAG;
        $this->assertEquals( $html, (string) $form );
    }
}
