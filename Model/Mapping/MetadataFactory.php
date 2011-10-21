<?php

namespace Model\Mapping;

class MetadataFactory extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Model\\MongoMenuBundle\\Menu' => false,
        'Model\\MongoMenuBundle\\Contenu' => true,
        'Model\\MongoMenuBundle\\MenuTranslation' => true,
    );
}