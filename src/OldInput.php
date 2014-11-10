<?php
namespace WScore\Form;

class OldInput
{
    protected $old_input = [];

    public function __construct( $old_input = [ ] )
    {
        $this->old_input = $old_input;
    }

    /**
     * @param $name
     * @return string|array|mixed
     */
    public function getOld( $name )
    {
        $name = str_replace( '[]', '', $name );
        parse_str( $name, $levels );
        $old = $this->old_input;
        return $this->recursiveOldInput( $levels, $old );
    }

    /**
     * @param array $levels
     * @param array $old
     * @return mixed
     */
    protected function recursiveOldInput( $levels, $old )
    {
        if( !is_array( $levels ) ) return $old;
        list( $key, $next ) = each( $levels );
        if( isset( $old[$key] ) ) {
            return $this->recursiveOldInput( $next, $old[$key] );
        }
        return null;
    }

}