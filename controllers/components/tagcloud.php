<?php
/**
* Tagcloud Component
*
* Tagcloud Component for Croogo 1.3+
*
* @category Component
* @package  Croogo
* @version  1.3
* @author  	bumuckl <bumuckl@gmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php
* @link     http://www.bumuckl.com
*/
class TagcloudComponent extends Object {

    /**
    * Called after the Controller::beforeFilter() and before the controller action
    *
    * @param object $controller Controller with components to startup
    * @return void
    */
    function startup(&$controller) {
        $controller->set('tags', $this->fetchTags());
    }

    /**
    * Fetch tags from database
    *
    * @return array
    */
    function fetchTags() {
		
		$Taxonomy = ClassRegistry::init('Taxonomy');
		$Taxonomy->bindModel(
			array('hasAndBelongsToMany' => array(
			        'Node' => array(
			            'className' => 'Node',
			            'with' => 'NodesTaxonomy',
			            'joinTable' => 'nodes_taxonomies',
			            'foreignKey' => 'taxonomy_id',
			            'associationForeignKey' => 'node_id',
			            'unique' => true,
			            'conditions' => '',
			            'fields' => '',
			            'order' => '',
			            'limit' => '',
			            'offset' => '',
			            'finderQuery' => '',
			            'deleteQuery' => '',
			            'insertQuery' => '',
			        )
				)
			)
		);
		
		$tags = $Taxonomy->find('all', array(
			'conditions' => array(
				'vocabulary_id' => Configure::read('Tagcloud.vocabulary'),
			),
		));
		
		$temp_tags = array();
		if (!empty($tags)) {
			foreach($tags as $temp) {
				$temp['Term']['weight'] = count($temp['Node']);
				array_push($temp_tags, $temp['Term']);
			}
		}
		$tags = $temp_tags;
		
		if (Configure::read('Tagcloud.shuffle') == 1) {
			shuffle($tags);
		}
		
		if (Configure::read('Tagcloud.display') > 0 && count($tags) > Configure::read('Tagcloud.display')) {
			while(count($tags) > Configure::read('Tagcloud.display')) {
				array_pop($tags);
			}
		}

        return $tags;

    }

}
?>