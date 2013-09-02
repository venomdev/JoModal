<?php

// no direct access
defined('_JEXEC') or die;

class plgContentModal extends JPlugin
{

	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{

		$regex = '#\{modal url="(.*)"\}(.+)\{/modal\}#i';
 
 
                // find all instances of plugin and put in $matches
                preg_match_all( $regex, $row->text, $matches );
 
                // Number of plugins
                $count = count( $matches[0] );
 
                // plugin only processes if there are any instances of the plugin in the text
                if ( $count ) {
			JHTML::_('behavior.modal');
                        // Get plugin parameters
                        $this->_process( $row, $matches, $count, $regex);
                }
                // No return value
        }

	// The proccessing function
        protected function _process( &$row, &$matches, $count, $regex)
        {
                for ( $i=0; $i < $count; $i++ )
                {
                        $row->text = preg_replace( '#\{modal url="(.*)"\}(.+)\{/modal\}#i', '<a class="modal" href="$1" rel="{handler: \'iframe\', size: {x:1000, y:600}}" >$2</a>', $row->text );
                }
 
                // removes tags without matching module positions
        }
}

?>