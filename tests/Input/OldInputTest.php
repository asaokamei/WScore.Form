<?php
namespace tests\Input;

use WScore\Form\OldInput;

require_once( __DIR__.'/../autoloader.php' );

class OldInputTest extends \PHPUnit_Framework_TestCase
{
    function setup()
    {
        class_exists( 'WScore\Form\Builder' );
    }

    function test0()
    {
        $old = new OldInput( [ 'name' =>[ 'key' => 'found' ] ] );
        $found = $old->getOld( 'name[key]' );
        $this->assertEquals( 'found', $found );

        $old = new OldInput( [ 'name' =>[ 'key' => 'found' ] ] );
        $found = $old->getOld( 'name[key][more]' );
        $this->assertEquals( null, $found );

        $old = new OldInput( [ 'name' =>[ 'key' => [ 'more' => 'found' ] ] ] );
        $found = $old->getOld( 'name[key]]' );
        $this->assertEquals( ['more' => 'found'], $found );

        $old = new OldInput( [ 'name' =>[ 'key' => [ 'more', 'found' ] ] ] );
        $found = $old->getOld( 'name[key]]' );
        $this->assertEquals( ['more', 'found'], $found );

        $old = new OldInput( [ 'name' =>[ 'key' => 'found' ] ] );
        $found = $old->getOld( 'name[bad]' );
        $this->assertEquals( null, $found );

        $old = new OldInput( [ 'name' =>[ 'key' => 'found' ] ] );
        $found = $old->getOld( 'bad[key]' );
        $this->assertEquals( null, $found );
    }
}
