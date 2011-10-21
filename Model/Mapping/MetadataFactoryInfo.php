<?php

namespace Model\Mapping;

class MetadataFactoryInfo
{
    public function getModelMongoMenuBundleMenuClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => null,
            'collection' => 'model_mongomenubundle_menu',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'name' => array(
                    'type' => 'string',
                    'validation' => array(
                        0 => array(
                            'NotBlank' => null,
                        ),
                        1 => array(
                            'Type' => 'string',
                        ),
                    ),
                    'dbName' => 'name',
                ),
                'title' => array(
                    'type' => 'string',
                    'validation' => array(
                        0 => array(
                            'NotBlank' => null,
                        ),
                        1 => array(
                            'Type' => 'string',
                        ),
                    ),
                    'dbName' => 'title',
                ),
                'slug' => array(
                    'type' => 'string',
                    'dbName' => 'slug',
                ),
                'position' => array(
                    'type' => 'integer',
                    'dbName' => 'position',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(
                'contenu' => array(
                    'class' => 'Model\\MongoMenuBundle\\Contenu',
                    'validation' => array(
                        0 => array(
                            'NotNull' => null,
                        ),
                    ),
                ),
                'translations' => array(
                    'class' => 'Model\\MongoMenuBundle\\MenuTranslation',
                ),
            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(
                0 => array(
                    'keys' => array(
                        'slug' => 1,
                    ),
                    'options' => array(
                        'unique' => 1,
                    ),
                ),
            ),
            '_indexes' => array(
                0 => array(
                    'keys' => array(
                        'slug' => 1,
                    ),
                    'options' => array(
                        'unique' => 1,
                    ),
                ),
            ),
        );
    }

    public function getModelMongoMenuBundleContenuClass()
    {
        return array(
            'isEmbedded' => true,
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'title' => array(
                    'type' => 'string',
                    'validation' => array(
                        0 => array(
                            'NotBlank' => null,
                        ),
                        1 => array(
                            'Type' => 'string',
                        ),
                    ),
                    'dbName' => 'title',
                ),
                'text' => array(
                    'type' => 'string',
                    'validation' => array(
                        0 => array(
                            'NotBlank' => null,
                        ),
                        1 => array(
                            'Type' => 'string',
                        ),
                    ),
                    'dbName' => 'text',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getModelMongoMenuBundleMenuTranslationClass()
    {
        return array(
            'isEmbedded' => true,
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'locale' => array(
                    'type' => 'string',
                    'length' => 7,
                    'dbName' => 'locale',
                ),
                'traduc' => array(
                    'type' => 'string',
                    'validation' => array(
                        0 => array(
                            'NotBlank' => null,
                        ),
                        1 => array(
                            'Type' => 'string',
                        ),
                    ),
                    'dbName' => 'traduc',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }
}