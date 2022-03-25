<?php

namespace {
    require_once __DIR__ . '/vendor/autoload.php';

    use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
    use Symfony\Component\PropertyInfo\Extractor\PhpStanExtractor;

    $phpDocExtractor = new PhpDocExtractor();
    $phpStanExtractor = new PhpStanExtractor();


    dump(
        $phpDocTypes = $phpDocExtractor->getTypes(B\Dummy::class, 'property'),
        $phpStanTypes = $phpStanExtractor->getTypes(B\Dummy::class, 'property')
    );

    assert($phpStanTypes[0]->getClassName() === 'A\Property');
    assert($phpDocTypes[0]->getClassName() === $phpStanTypes[0]->getClassName());
}


namespace A {
    class Property {

    }

    class Dummy {
        /**
         * @var Property
         */
        public $property;
    }
}

namespace B {
    class Dummy extends \A\Dummy {

    }
}