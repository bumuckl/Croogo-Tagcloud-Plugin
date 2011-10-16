<?php

class TagcloudActivation {

    public function beforeActivation(&$controller) {
    	return true; 

    }

    public function onActivation(&$controller) {
		$controller->Setting->write('Tagcloud.vocabulary', '2', array('editable' => 1, 'title' => 'Vocabulary ID', 'description' => 'Vocabulary ID that serves as the source for tags.'));
		$controller->Setting->write('Tagcloud.display', '20', array('editable' => 1, 'title' => 'Display', 'description' => 'How many tags do you want to be displayed?'));
		$controller->Setting->write('Tagcloud.shuffle', '0', array('editable' => 1, 'title' => 'Shuffle Tags', 'description' => 'Do you want your tags to be shuffled?'));
        
        $block = ClassRegistry::init('Block')->find('first',
        array('conditions' => array(
            'Block.alias' => 'tagcloud'
        )));
        if (empty($block)) {
            ClassRegistry::init('Block')->create();
            ClassRegistry::init('Block')->save(array('Block' => array(
                	'region_id' => 4,
	                'title'     => 'Tagcloud',
	                'alias'     => 'tagcloud',
	                'status'    => 1,
	                'element'   => 'Tagcloud.tagcloud'
	            	),
				)
			);
			
        }

    }


    public function beforeDeactivation(&$controller) {
        return true;

    }


    public function onDeactivation(&$controller) {
        ClassRegistry::init('Block')->deleteAll(array('Block.alias' => 'tagcloud'));
    	$controller->Setting->deleteKey('Tagcloud.vocabulary');
		$controller->Setting->deleteKey('Tagcloud.display');
		$controller->Setting->deleteKey('Tagcloud.shuffle');

    }
}
?>