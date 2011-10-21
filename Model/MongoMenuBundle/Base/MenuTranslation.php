<?php

namespace Model\MongoMenuBundle\Base;

/**
 * Base class of Model\MongoMenuBundle\MenuTranslation document.
 */
abstract class MenuTranslation extends \Mandango\Document\EmbeddedDocument
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
     * @return Model\MongoMenuBundle\MenuTranslation The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if ($clean) {
            $this->data = array();
            $this->fieldsModified = array();
        }



        if (isset($data['_query_hash'])) {
            $this->addQueryHash($data['_query_hash']);
        }

        if (isset($data['locale'])) {
            $this->data['fields']['locale'] = (string) $data['locale'];
        } elseif (isset($data['_fields']['locale'])) {
            $this->data['fields']['locale'] = null;
        }
        if (isset($data['traduc'])) {
            $this->data['fields']['traduc'] = (string) $data['traduc'];
        } elseif (isset($data['_fields']['traduc'])) {
            $this->data['fields']['traduc'] = null;
        }



        return $this;
    }

    /**
     * Set the "locale" field.
     *
     * @param mixed $value The value.
     *
     * @return Model\MongoMenuBundle\MenuTranslation The document (fluent interface).
     */
    public function setLocale($value)
    {
        if (!isset($this->data['fields']['locale'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getLocale();
                if ($value === $this->data['fields']['locale']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['locale'] = null;
                $this->data['fields']['locale'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['locale']) {
            return $this;
        }

        if (!isset($this->fieldsModified['locale']) && !array_key_exists('locale', $this->fieldsModified)) {
            $this->fieldsModified['locale'] = $this->data['fields']['locale'];
        } elseif ($value === $this->fieldsModified['locale']) {
            unset($this->fieldsModified['locale']);
        }

        $this->data['fields']['locale'] = $value;

        return $this;
    }

    /**
     * Returns the "locale" field.
     *
     * @return mixed The locale field.
     */
    public function getLocale()
    {
        if (!isset($this->data['fields']['locale'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('locale', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.locale';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['locale'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['locale'])) {
                $this->data['fields']['locale'] = null;
            }
        }

        return $this->data['fields']['locale'];
    }

    /**
     * Set the "traduc" field.
     *
     * @param mixed $value The value.
     *
     * @return Model\MongoMenuBundle\MenuTranslation The document (fluent interface).
     */
    public function setTraduc($value)
    {
        if (!isset($this->data['fields']['traduc'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getTraduc();
                if ($value === $this->data['fields']['traduc']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['traduc'] = null;
                $this->data['fields']['traduc'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['traduc']) {
            return $this;
        }

        if (!isset($this->fieldsModified['traduc']) && !array_key_exists('traduc', $this->fieldsModified)) {
            $this->fieldsModified['traduc'] = $this->data['fields']['traduc'];
        } elseif ($value === $this->fieldsModified['traduc']) {
            unset($this->fieldsModified['traduc']);
        }

        $this->data['fields']['traduc'] = $value;

        return $this;
    }

    /**
     * Returns the "traduc" field.
     *
     * @return mixed The traduc field.
     */
    public function getTraduc()
    {
        if (!isset($this->data['fields']['traduc'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('traduc', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.traduc';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['traduc'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['traduc'])) {
                $this->data['fields']['traduc'] = null;
            }
        }

        return $this->data['fields']['traduc'];
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
        if ('locale' == $name) {
            return $this->setLocale($value);
        }
        if ('traduc' == $name) {
            return $this->setTraduc($value);
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
        if ('locale' === $name) {
            return $this->getLocale();
        }
        if ('traduc' === $name) {
            return $this->getTraduc();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $data An array.
     *
     * @return Model\MongoMenuBundle\MenuTranslation The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['locale'])) {
            $this->setLocale($array['locale']);
        }
        if (isset($array['traduc'])) {
            $this->setTraduc($array['traduc']);
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

        $array['locale'] = $this->get('locale');
        $array['traduc'] = $this->get('traduc');

        return $array;
    }

    public function queryForSave($query, $isNew, $reset = false)
    {
        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                $rootQuery = $query;
                $query =& $rootQuery;
                $rap = $this->getRootAndPath();
                if (true === $reset) {
                    $path = array('$set', $rap['path']);
                } elseif ('deep' == $reset) {
                    $path = explode('.', '$set.'.$rap['path']);
                } else {
                    $path = explode('.', $rap['path']);
                }
                foreach ($path as $name) {
                    if (0 === strpos($name, '_add')) {
                        $name = substr($name, 4);
                    }
                    if (!isset($query[$name])) {
                        $query[$name] = array();
                    }
                    $query =& $query[$name];
                }

                if (isset($this->data['fields']['locale'])) {
                    $query['locale'] = (string) $this->data['fields']['locale'];
                }
                if (isset($this->data['fields']['traduc'])) {
                    $query['traduc'] = (string) $this->data['fields']['traduc'];
                }

                unset($query);
                $query = $rootQuery;
            } else {
                $rap = $this->getRootAndPath();
                $documentPath = $rap['path'];

                if (isset($this->data['fields']['locale']) || array_key_exists('locale', $this->data['fields'])) {
                    $value = $this->data['fields']['locale'];
                    $originalValue = $this->getOriginalFieldValue('locale');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.locale'] = (string) $this->data['fields']['locale'];
                        } else {
                            $query['$unset'][$documentPath.'.locale'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['traduc']) || array_key_exists('traduc', $this->data['fields'])) {
                    $value = $this->data['fields']['traduc'];
                    $originalValue = $this->getOriginalFieldValue('traduc');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.traduc'] = (string) $this->data['fields']['traduc'];
                        } else {
                            $query['$unset'][$documentPath.'.traduc'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
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
                'traduc' => array(
                    0 => array(
                        'NotBlank' => null,
                    ),
                    1 => array(
                        'Type' => 'string',
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
}