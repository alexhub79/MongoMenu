<?php

namespace Model\MongoMenuBundle\Base;

/**
 * Base class of Model\MongoMenuBundle\Menu document.
 */
abstract class Menu extends \Mandango\Document\Document
{
    /**
     * Initializes the document defaults.
     */
    public function initializeDefaults()
    {
    }

    /**
     * Set the document data (hydrate).
     *
     * @param array $data  The document data.
     * @param bool  $clean Whether clean the document.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if ($clean) {
            $this->data = array();
            $this->fieldsModified = array();
        }

        if (isset($data['_id'])) {
            $this->id = $data['_id'];
        }

        if (isset($data['_query_hash'])) {
            $this->addQueryHash($data['_query_hash']);
        }

        if (isset($data['name'])) {
            $this->data['fields']['name'] = (string) $data['name'];
        } elseif (isset($data['_fields']['name'])) {
            $this->data['fields']['name'] = null;
        }
        if (isset($data['title'])) {
            $this->data['fields']['title'] = (string) $data['title'];
        } elseif (isset($data['_fields']['title'])) {
            $this->data['fields']['title'] = null;
        }
        if (isset($data['slug'])) {
            $this->data['fields']['slug'] = (string) $data['slug'];
        } elseif (isset($data['_fields']['slug'])) {
            $this->data['fields']['slug'] = null;
        }
        if (isset($data['position'])) {
            $this->data['fields']['position'] = (int) $data['position'];
        } elseif (isset($data['_fields']['position'])) {
            $this->data['fields']['position'] = null;
        }

        if (isset($data['contenu'])) {
            $embedded = new \Mandango\Group\EmbeddedGroup('Model\MongoMenuBundle\Contenu');
            $embedded->setRootAndPath($this, 'contenu');
            $embedded->setSavedData($data['contenu']);
            $this->data['embeddedsMany']['contenu'] = $embedded;
        }
        if (isset($data['translations'])) {
            $embedded = new \Mandango\Group\EmbeddedGroup('Model\MongoMenuBundle\MenuTranslation');
            $embedded->setRootAndPath($this, 'translations');
            $embedded->setSavedData($data['translations']);
            $this->data['embeddedsMany']['translations'] = $embedded;
        }

        return $this;
    }

    /**
     * Set the "name" field.
     *
     * @param mixed $value The value.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function setName($value)
    {
        if (!isset($this->data['fields']['name'])) {
            if (null !== $this->id) {
                $this->getName();
                if ($value === $this->data['fields']['name']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['name'] = null;
                $this->data['fields']['name'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['name']) {
            return $this;
        }

        if (!isset($this->fieldsModified['name']) && !array_key_exists('name', $this->fieldsModified)) {
            $this->fieldsModified['name'] = $this->data['fields']['name'];
        } elseif ($value === $this->fieldsModified['name']) {
            unset($this->fieldsModified['name']);
        }

        $this->data['fields']['name'] = $value;

        return $this;
    }

    /**
     * Returns the "name" field.
     *
     * @return mixed The name field.
     */
    public function getName()
    {
        if (!isset($this->data['fields']['name'])) {
            if ($this->isNew()) {
                $this->data['fields']['name'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('name', $this->data['fields'])) {
                $this->addFieldCache('name');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->id), array('name' => 1));
                if (isset($data['name'])) {
                    $this->data['fields']['name'] = (string) $data['name'];
                } else {
                    $this->data['fields']['name'] = null;
                }
            }
        }

        return $this->data['fields']['name'];
    }

    /**
     * Set the "title" field.
     *
     * @param mixed $value The value.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function setTitle($value)
    {
        if (!isset($this->data['fields']['title'])) {
            if (null !== $this->id) {
                $this->getTitle();
                if ($value === $this->data['fields']['title']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['title'] = null;
                $this->data['fields']['title'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['title']) {
            return $this;
        }

        if (!isset($this->fieldsModified['title']) && !array_key_exists('title', $this->fieldsModified)) {
            $this->fieldsModified['title'] = $this->data['fields']['title'];
        } elseif ($value === $this->fieldsModified['title']) {
            unset($this->fieldsModified['title']);
        }

        $this->data['fields']['title'] = $value;

        return $this;
    }

    /**
     * Returns the "title" field.
     *
     * @return mixed The title field.
     */
    public function getTitle()
    {
        if (!isset($this->data['fields']['title'])) {
            if ($this->isNew()) {
                $this->data['fields']['title'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('title', $this->data['fields'])) {
                $this->addFieldCache('title');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->id), array('title' => 1));
                if (isset($data['title'])) {
                    $this->data['fields']['title'] = (string) $data['title'];
                } else {
                    $this->data['fields']['title'] = null;
                }
            }
        }

        return $this->data['fields']['title'];
    }

    /**
     * Set the "slug" field.
     *
     * @param mixed $value The value.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function setSlug($value)
    {
        if (!isset($this->data['fields']['slug'])) {
            if (null !== $this->id) {
                $this->getSlug();
                if ($value === $this->data['fields']['slug']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['slug'] = null;
                $this->data['fields']['slug'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['slug']) {
            return $this;
        }

        if (!isset($this->fieldsModified['slug']) && !array_key_exists('slug', $this->fieldsModified)) {
            $this->fieldsModified['slug'] = $this->data['fields']['slug'];
        } elseif ($value === $this->fieldsModified['slug']) {
            unset($this->fieldsModified['slug']);
        }

        $this->data['fields']['slug'] = $value;

        return $this;
    }

    /**
     * Returns the "slug" field.
     *
     * @return mixed The slug field.
     */
    public function getSlug()
    {
        if (!isset($this->data['fields']['slug'])) {
            if ($this->isNew()) {
                $this->data['fields']['slug'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('slug', $this->data['fields'])) {
                $this->addFieldCache('slug');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->id), array('slug' => 1));
                if (isset($data['slug'])) {
                    $this->data['fields']['slug'] = (string) $data['slug'];
                } else {
                    $this->data['fields']['slug'] = null;
                }
            }
        }

        return $this->data['fields']['slug'];
    }

    /**
     * Set the "position" field.
     *
     * @param mixed $value The value.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function setPosition($value)
    {
        if (!isset($this->data['fields']['position'])) {
            if (null !== $this->id) {
                $this->getPosition();
                if ($value === $this->data['fields']['position']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['position'] = null;
                $this->data['fields']['position'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['position']) {
            return $this;
        }

        if (!isset($this->fieldsModified['position']) && !array_key_exists('position', $this->fieldsModified)) {
            $this->fieldsModified['position'] = $this->data['fields']['position'];
        } elseif ($value === $this->fieldsModified['position']) {
            unset($this->fieldsModified['position']);
        }

        $this->data['fields']['position'] = $value;

        return $this;
    }

    /**
     * Returns the "position" field.
     *
     * @return mixed The position field.
     */
    public function getPosition()
    {
        if (!isset($this->data['fields']['position'])) {
            if ($this->isNew()) {
                $this->data['fields']['position'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('position', $this->data['fields'])) {
                $this->addFieldCache('position');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->id), array('position' => 1));
                if (isset($data['position'])) {
                    $this->data['fields']['position'] = (int) $data['position'];
                } else {
                    $this->data['fields']['position'] = null;
                }
            }
        }

        return $this->data['fields']['position'];
    }

    /**
     * Returns the "contenu" embedded many.
     *
     * @return Mandango\Group\EmbeddedGroup The "contenu" embedded many.
     */
    public function getContenu()
    {
        if (!isset($this->data['embeddedsMany']['contenu'])) {
            $this->data['embeddedsMany']['contenu'] = $embedded = new \Mandango\Group\EmbeddedGroup('Model\MongoMenuBundle\Contenu');
            $embedded->setRootAndPath($this, 'contenu');
        }

        return $this->data['embeddedsMany']['contenu'];
    }

    /**
     * Adds documents to the "contenu" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function addContenu($documents)
    {
        $this->getContenu()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "contenu" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function removeContenu($documents)
    {
        $this->getContenu()->remove($documents);

        return $this;
    }

    /**
     * Returns the "translations" embedded many.
     *
     * @return Mandango\Group\EmbeddedGroup The "translations" embedded many.
     */
    public function getTranslations()
    {
        if (!isset($this->data['embeddedsMany']['translations'])) {
            $this->data['embeddedsMany']['translations'] = $embedded = new \Mandango\Group\EmbeddedGroup('Model\MongoMenuBundle\MenuTranslation');
            $embedded->setRootAndPath($this, 'translations');
        }

        return $this->data['embeddedsMany']['translations'];
    }

    /**
     * Adds documents to the "translations" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function addTranslations($documents)
    {
        $this->getTranslations()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "translations" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function removeTranslations($documents)
    {
        $this->getTranslations()->remove($documents);

        return $this;
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['embeddedsMany']['contenu'])) {
            $this->data['embeddedsMany']['contenu']->reset();
        }
        if (isset($this->data['embeddedsMany']['translations'])) {
            $this->data['embeddedsMany']['translations']->reset();
        }
    }

    /**
     * Set a document data value by data name as string.
     *
     * @param string $name  The data name.
     * @param mixed  $vaule The value.
     *
     * @return mixed the data name setter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function set($name, $value)
    {
        if ('name' == $name) {
            return $this->setName($value);
        }
        if ('title' == $name) {
            return $this->setTitle($value);
        }
        if ('slug' == $name) {
            return $this->setSlug($value);
        }
        if ('position' == $name) {
            return $this->setPosition($value);
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Returns a document data by data name as string.
     *
     * @param string $name The data name.
     *
     * @return mixed The data name getter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function get($name)
    {
        if ('name' === $name) {
            return $this->getName();
        }
        if ('title' === $name) {
            return $this->getTitle();
        }
        if ('slug' === $name) {
            return $this->getSlug();
        }
        if ('position' === $name) {
            return $this->getPosition();
        }
        if ('contenu' === $name) {
            return $this->getContenu();
        }
        if ('translations' === $name) {
            return $this->getTranslations();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $data An array.
     *
     * @return Model\MongoMenuBundle\Menu The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['name'])) {
            $this->setName($array['name']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['slug'])) {
            $this->setSlug($array['slug']);
        }
        if (isset($array['position'])) {
            $this->setPosition($array['position']);
        }





        if (isset($array['contenu'])) {
            $embeddeds = array();
            foreach ($array['contenu'] as $documentData) {
                $embeddeds[] = $embedded = new \Model\MongoMenuBundle\Contenu($this->getMandango());
                $embedded->setDocumentData($documentData);
            }
            $this->getContenu()->replace($embeddeds);
        }
        if (isset($array['translations'])) {
            $embeddeds = array();
            foreach ($array['translations'] as $documentData) {
                $embeddeds[] = $embedded = new \Model\MongoMenuBundle\MenuTranslation($this->getMandango());
                $embedded->setDocumentData($documentData);
            }
            $this->getTranslations()->replace($embeddeds);
        }

        return $this;
    }

    /**
     * Export the document data to an array.
     *
     * @param Boolean $withReferenceFields Whether include the fields of references or not (false by default).
     *
     * @return array An array with the document data.
     */
    public function toArray($withReferenceFields = false)
    {
        $array = array();

        $array['name'] = $this->get('name');
        $array['title'] = $this->get('title');
        $array['slug'] = $this->get('slug');
        $array['position'] = $this->get('position');

        return $array;
    }

    /**
     * INTERNAL. Invoke the "preInsert" event.
     */
    public function preInsertEvent()
    {
        $this->updateSluggableSlug();
        $this->sortableSetPosition();
        $this->translatableFunction();
    }

    /**
     * INTERNAL. Invoke the "preUpdate" event.
     */
    public function preUpdateEvent()
    {
        $this->sortableSetPosition();
        $this->translatableFunction();
    }

    public function queryForSave()
    {
        $isNew = $this->isNew();
        $query = array();
        $reset = false;

        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                if (isset($this->data['fields']['name'])) {
                    $query['name'] = (string) $this->data['fields']['name'];
                }
                if (isset($this->data['fields']['title'])) {
                    $query['title'] = (string) $this->data['fields']['title'];
                }
                if (isset($this->data['fields']['slug'])) {
                    $query['slug'] = (string) $this->data['fields']['slug'];
                }
                if (isset($this->data['fields']['position'])) {
                    $query['position'] = (int) $this->data['fields']['position'];
                }
            } else {
                if (isset($this->data['fields']['name']) || array_key_exists('name', $this->data['fields'])) {
                    $value = $this->data['fields']['name'];
                    $originalValue = $this->getOriginalFieldValue('name');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['name'] = (string) $this->data['fields']['name'];
                        } else {
                            $query['$unset']['name'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['title']) || array_key_exists('title', $this->data['fields'])) {
                    $value = $this->data['fields']['title'];
                    $originalValue = $this->getOriginalFieldValue('title');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['title'] = (string) $this->data['fields']['title'];
                        } else {
                            $query['$unset']['title'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['slug']) || array_key_exists('slug', $this->data['fields'])) {
                    $value = $this->data['fields']['slug'];
                    $originalValue = $this->getOriginalFieldValue('slug');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['slug'] = (string) $this->data['fields']['slug'];
                        } else {
                            $query['$unset']['slug'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['position']) || array_key_exists('position', $this->data['fields'])) {
                    $value = $this->data['fields']['position'];
                    $originalValue = $this->getOriginalFieldValue('position');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['position'] = (int) $this->data['fields']['position'];
                        } else {
                            $query['$unset']['position'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }

        if (isset($this->data['embeddedsMany'])) {
            if ($isNew) {
                if (isset($this->data['embeddedsMany']['contenu'])) {
                    foreach ($this->data['embeddedsMany']['contenu']->getAdd() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                }
                if (isset($this->data['embeddedsMany']['translations'])) {
                    foreach ($this->data['embeddedsMany']['translations']->getAdd() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                }
            } else {
                if (isset($this->data['embeddedsMany']['contenu'])) {
                    $group = $this->data['embeddedsMany']['contenu'];
                    foreach ($group->getSaved() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                    $groupRap = $group->getRootAndPath();
                    foreach ($group->getAdd() as $document) {
                        $q = $document->queryForSave(array(), true);
                        $rap = $document->getRootAndPath();
                        foreach (explode('.', $rap['path']) as $name) {
                            if (0 === strpos($name, '_add')) {
                                $name = substr($name, 4);
                            }
                            $q = $q[$name];
                        }
                        $query['$pushAll'][$groupRap['path']][] = $q;
                    }
                    foreach ($group->getRemove() as $document) {
                        $rap = $document->getRootAndPath();
                        $query['$unset'][$rap['path']] = 1;
                    }
                }
                if (isset($this->data['embeddedsMany']['translations'])) {
                    $group = $this->data['embeddedsMany']['translations'];
                    foreach ($group->getSaved() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                    $groupRap = $group->getRootAndPath();
                    foreach ($group->getAdd() as $document) {
                        $q = $document->queryForSave(array(), true);
                        $rap = $document->getRootAndPath();
                        foreach (explode('.', $rap['path']) as $name) {
                            if (0 === strpos($name, '_add')) {
                                $name = substr($name, 4);
                            }
                            $q = $q[$name];
                        }
                        $query['$pushAll'][$groupRap['path']][] = $q;
                    }
                    foreach ($group->getRemove() as $document) {
                        $rap = $document->getRootAndPath();
                        $query['$unset'][$rap['path']] = 1;
                    }
                }
            }
        }

        return $query;
    }

    /**
     * Maps the validation.
     *
     * @param \Symfony\Component\Validator\Mapping\ClassMetadata $metadata The metadata class.
     */
    static public function loadValidatorMetadata(\Symfony\Component\Validator\Mapping\ClassMetadata $metadata)
    {
        $validation = array(
            'constraints' => array(

            ),
            'getters' => array(
                'name' => array(
                    0 => array(
                        'NotBlank' => null,
                    ),
                    1 => array(
                        'Type' => 'string',
                    ),
                ),
                'title' => array(
                    0 => array(
                        'NotBlank' => null,
                    ),
                    1 => array(
                        'Type' => 'string',
                    ),
                ),
                'contenu' => array(
                    0 => array(
                        'NotNull' => null,
                    ),
                ),
            ),
        );

        foreach (\Mandango\MandangoBundle\Extension\DocumentValidation::parseNodes($validation['constraints']) as $constraint) {
            $metadata->addConstraint($constraint);
        }

        foreach ($validation['getters'] as $getter => $constraints) {
            foreach (\Mandango\MandangoBundle\Extension\DocumentValidation::parseNodes($constraints) as $constraint) {
                $metadata->addGetterConstraint($getter, $constraint);
            }
        }

        return true;
    }

    protected function updateSluggableSlug()
    {
        $slug = $proposal = call_user_func(array (
  0 => '\\Mandango\\Behavior\\Util\\SluggableUtil',
  1 => 'slugify',
), $this->getTitle());

        $similarSlugs = array();
        foreach ($this->getRepository()->getCollection()
            ->find(array('slug' => new \MongoRegex('/^'.$slug.'/')))
        as $result) {
            $similarSlugs[] = $result['slug'];
        }

        $i = 1;
        while (in_array($slug, $similarSlugs)) {
            $slug = $proposal.'-'.++$i;
        }

        $this->setSlug($slug);
    }

    /**
     * Returns if the entity is the first.
     *
     * @return bool Returns if the entity is the first.
     */
    public function isFirst()
    {
        return $this->getPosition() === $this->getRepository()->getMinPosition();
    }

    /**
     * Returns if the entity is the last.
     *
     * @return bool Returns if the entity is the last.
     */
    public function isLast()
    {
        return $this->getPosition() === $this->getRepository()->getMaxPosition();
    }

    /**
     * Returns the next entity.
     *
     * @return mixed The next entity if exists, if not false.
     */
    public function getNext()
    {
        $query = $this->getRepository()->createQuery();
		$query->criteria(array('position' => $this->getPosition() + 1)); 
		$results = $query->one();
        return $results ? $results : false;
    }

    /**
     * Returns the previous entity.
     *
     * @return mixed The previous entity if exists, if not false.
     */
    public function getPrevious()
    {
        $query = $this->getRepository()->createQuery();
		$query->criteria(array('position' => $this->getPosition() - 1)); 
		$results = $query->one();
        return $results ? $results : false;
    }

    /**
     * Swap the position with another entity.
     *
     * @param \Model\MongoMenuBundle\Menu $entity The entity.
     *
     * @return void
     */
    public function swapWith($document)
    {
        if (!$document instanceof \Model\MongoMenuBundle\Menu) {
            throw new \InvalidArgumentException('The entity is not an instance of \Model\MongoMenuBundle\Menu.');
        }

        $oldPosition = $this->getPosition();
        $newPosition = $document->getPosition();
		
		$result  = $this->getRepository()->findOneById($this->getId());
		if($result):
		
			$result->setPosition($newPosition);
			$query = $result->queryForSave();
			$this->getRepository()->getCollection()->update(array('_id' => $result->getId()), $query);		
		endif;

		$result  = $this->getRepository()->findOneById($document->getId());
		if($result):
			$result->setPosition($oldPosition);
			$query = $result->queryForSave();
			$this->getRepository()->getCollection()->update(array('_id' => $result->getId()), $query);		
		endif;
    }

    /**
     * Move up the entity.
     *
     * @return void
     *
     * @throws \RuntimeException If the entity is the first.
     */
    public function moveUp()
    {
        if ($this->isFirst()) {
            throw new \RuntimeException('The entity is the first.');
        }

        $this->swapWith($this->getPrevious());
    }

    /**
     * Move down the entity.
     *
     * @return void
     *
     * @throws \RuntimeException If the entity is the last.
     */
    public function moveDown()
    {
        if ($this->isLast()) {
            throw new \RuntimeException('The entity is the last.');
        }

        $this->swapWith($this->getNext());
    }

    /**
     * Set the position.
     */
    public function sortableSetPosition()
    {
        $maxPosition = $this->getRepository()->getMaxPosition();
        if ($this->isNew()):
            $position = $maxPosition + 1;
        else:
            if ($this->isFieldModified('position') === false):
                return;
            endif;
			$changeSet = $this->getDocumentData();
            $oldPosition = $this->getOriginalFieldValue('position');
            $position    = $changeSet['fields']['position'];
        endif;

        // move entities
        if ($this->isNew()):	
			$query = $this->getRepository()->createQuery();
			$query->criteria(array('position' => array ('$gte' =>$position))); 
			$results = $query->all();
			if($results):
				foreach($result as $r):
					$r->setPosition($r->getPosition()+1);
					$query = $r->queryForSave();
					$this->getRepository()->getCollection()->update(array('_id' => $r->getId()), $query);		
				endforeach;	
			endif;
		 else:
			$sign = $position > $oldPosition ? '-' : '+';
			$min = min($position, $oldPosition);
			$max = max($position, $oldPosition);
			$query = $this->getRepository()->createQuery();
			
			if($sign == '-' ) $query->criteria(array('position' => array ('$gt' =>$min, '$lte' => $max ))); 
			else $query->criteria(array('position' => array ('$gte' =>$min, '$lt' => $max ))); 
			
			$results = $query->all();
			if($results):
				foreach($results as $r):
					if($sign == '-' ) $r->setPosition($r->getPosition() - 1);
 					else  $r->setPosition($r->getPosition() + 1);
					$query = $r->queryForSave();
					$this->getRepository()->getCollection()->update(array('_id' => $r->getId()), $query);		
				endforeach;	
			endif;
		 endif;
		 $this->setPosition($position);
    }

    /**
     * Add default field translate.
     */
    public function translatableFunction()
    {
        $a = $this->getDocumentData();
		foreach($a['embeddedsMany']['translations'] as $m):
			if($m->getLocale() == ""){
				throw new \RuntimeException('Locale value is compulsory.');
			}
		endforeach;
    }

    /**
     * Returns a translation entity by locale.
     *
     * @param string $locale The locale.
     *
     * @return \{Model\MongoMenuBundle\Menu}Translation The translation entity.
     */
    public function translation($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

		$mandango  = $this->getMandango();
		$translation = $mandango->create('Model\MongoMenuBundle\MenuTranslation');
        $translation->setLocale($locale);      

        return $translation;
    }
}