<?php

namespace Model\MongoMenuBundle\Base;

/**
 * Base class of repository of Model\MongoMenuBundle\Menu document.
 */
abstract class MenuRepository extends \Mandango\Repository
{
    protected $documentClass = 'Model\\MongoMenuBundle\\Menu';
    protected $isFile = false;
    protected $connectionName;
    protected $collectionName = 'model_mongomenubundle_menu';

    /**
     * Save documents.
     *
     * @param mixed $documents          A document or an array of documents.
     * @param array $batchInsertOptions The options for the batch insert operation (optional).
     * @param array $updateOptions      The options for the update operation (optional).
     */
    public function save($documents, array $batchInsertOptions = array(), array $updateOptions = array())
    {
        if (!is_array($documents)) {
            $documents = array($documents);
        }

        $identityMap =& $this->getIdentityMap()->allByReference();
        $collection = $this->getCollection();

        $inserts = array();
        $updates = array();
        foreach ($documents as $document) {
             if ($document->isNew()) {
                $inserts[spl_object_hash($document)] = $document;
            } else {
                $updates[] = $document;
            }
        }

        // insert
        if ($inserts) {
            $a = array();
            foreach ($inserts as $oid => $document) {
                $document->preInsertEvent();
                $a[$oid] = $document->queryForSave();
            }

            if ($a) {
                $collection->batchInsert($a, $batchInsertOptions);

                foreach ($a as $oid => $data) {
                    $document = $inserts[$oid];

                    $document->setId($data['_id']);
                    $document->clearModified();
                    $identityMap[$data['_id']->__toString()] = $document;            $document->resetGroups();
                }
            }
        }

        // updates
        foreach ($updates as $document) {
            if ($document->isModified()) {
                $document->preUpdateEvent();
                $query = $document->queryForSave();
                $collection->update(array('_id' => $document->getId()), $query, $updateOptions);
                $document->clearModified();            $document->resetGroups();
            }
        }
    }

    /**
     * Delete documents.
     *
     * @param mixed $documents     A document or an array of documents.
     * @param array $removeOptions The options for the remove operation (optional).
     */
    public function delete($documents, array $removeOptions = array())
    {
        if (!is_array($documents)) {
            $documents = array($documents);
        }

        $identityMap =& $this->getIdentityMap()->allByReference();

        $ids = array();
        foreach ($documents as $document) {
            $ids[] = $id = $document->getAndRemoveId();
            unset($identityMap[$id->__toString()]);
        }

        $this->getCollection()->remove(array('_id' => array('$in' => $ids)), $removeOptions);
    }

    /**
     * Ensure the inexes.
     */
    public function ensureIndexes()
    {
        $this->getCollection()->ensureIndex(array(
            'slug' => 1,
        ), array(
            'unique' => 1,
            'safe' => true,
        ));
    }

    /**
     * Returns a document by slug.
     *
     * @param string $slug The slug.
     *
     * @return mixed The document or null if it does not exist.
     */
    public function findOneBySlug($slug)
    {
        return $this->createQuery(array('slug' => $slug))->one();
    }

    /**
     * Returns the min position.
     *
     * @return integer The min position.
     */
    public function getMinPosition()
    {
        $position = false;
		$result = $this->createQuery();
		$result->sort(array('position'=>1));
		$result->limit(1)->one();
		
		
		foreach($result as $r):
			$position =  $r->getPosition();
		endforeach;
		
		
       if( $position!== false )  return $result ? (int) $position : null;
       else return null;
    }

    /**
     * Returns the max position.
     *
     * @return integer The max position.
     */
    public function getMaxPosition()
    {
        $position = false;
		$result = $this->createQuery();
		$result->sort(array('position'=>-1));
		$result->limit(1)->one();
		
		
		foreach($result as $r):
			$position =  $r->getPosition();
		endforeach;
		
		
       if( $position!== false )  return $result ? (int) $position : null;
       else return null;
    }
}