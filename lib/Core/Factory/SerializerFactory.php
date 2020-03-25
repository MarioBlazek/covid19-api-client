<?php

namespace Marek\Covid19\Core\Factory;

use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class SerializerFactory
{
    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    public function create(): Serializer
    {
        $classMetadataFactory = new ClassMetadataFactory(
            new YamlFileLoader(__DIR__ . '/../../Resources/config/definition.yaml')
        );

        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $normalizer = new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter);

        return new Serializer([new DateTimeNormalizer(), $normalizer]);
    }
}
