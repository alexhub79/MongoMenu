<?php

namespace Model\MongoMenuBundle\Base;

/**
 * Base class of repository of Model\MongoMenuBundle\MenuTranslation document.
 */
abstract class MenuTranslationRepository extends \Mandango\Repository
{
    protected $documentClass = 'Model\\MongoMenuBundle\\MenuTranslation';
    protected $isFile = false;
    protected $connectionName;
    protected $collectionName = 'model_mongomenubundle_menutranslation';

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
                        $document->saveReferences();
            $document->updateReferenceFields();

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
                                if (!$document->isModified()) {
                    continue;
                }

$a[$oid] = $document->queryForSave();
            }

            if ($a) {
                $collection->batchInsert($a, $batchInsertOptions);

                foreach ($a as $oid => $data) {
                    $document = $inserts[$oid];

                    $document->setId($data['_id']);
                    $document->clearModified();
                    $identityMap[$data['_id']->__toString()] = $document;
                }
            }
        }

        // updates
        foreach ($updates as $document) {
            if ($document->isModified()) {
                $query = $document->queryForSave();
                $collection->update(array('_id' => $document->getId()), $query, $updateOptions);
                $document->clearModified();
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
    }
}