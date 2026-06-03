<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedPropertyRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictArrayParamDimFetchRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictStringParamConcatRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.  '/app/Http/Controllers/Api',
        __DIR__ . '/app/Http/Requests',
        __DIR__ . '/app/Http/Resources',
        __DIR__ . '/app/Actions',
        __DIR__ . '/app/Services',
        __DIR__ . '/app/Dto',
        __DIR__ . '/app/Models',
        __DIR__ . '/app/Enums',
        __DIR__.'/database/factories',
        __DIR__.'/database/migrations',
        __DIR__.'/database/seeders',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets(php84: true)
    ->withRules([
        // infers the type from the manufacturer
        TypedPropertyFromStrictConstructorRector::class,
        // inferred from the assignments
        TypedPropertyFromAssignsRector::class,

        // RETURN TYPES
        AddVoidReturnTypeWhereNoReturnRector::class,
        ReturnTypeFromReturnNewRector::class,
        BoolReturnTypeFromBooleanStrictReturnsRector::class,
        ReturnTypeFromStrictNativeCallRector::class,
        ReturnTypeFromStrictTypedCallRector::class,
        ReturnTypeFromStrictTypedPropertyRector::class,

        // Rector inherits the parent's type
        AddReturnTypeDeclarationBasedOnParentClassMethodRector::class,

        // reads the type of the target property
        AddMethodCallBasedStrictParamTypeRector::class,
        StrictArrayParamDimFetchRector::class,
        StrictStringParamConcatRector::class,

        //DEAD CODE
        RemoveUnusedPrivatePropertyRector::class,
        RemoveUnusedPrivateMethodRector::class,
        RemoveUnusedPromotedPropertyRector::class,
      ])
    ->withSkip([
        // Eloquent Models: Magic Properties $attributes
        TypedPropertyFromAssignsRector::class => [
            __DIR__ . '/app/Models',
            __DIR__ . '/database/factories',
        ],

        // Migrations: one-shot scripts, no need for readonly
        // SetUp() tests: readonly incompatible with certain mocks
        ReadOnlyPropertyRector::class => [
            __DIR__ . '/database/migrations',
            __DIR__ . '/database/seeders',
            __DIR__ . '/tests',
        ],
    ])
    ->withImportNames(
        importNames: true,
        importDocBlockNames: true,
        importShortClasses: false,
        removeUnusedImports: true,
    )
    ->withTypeCoverageLevel(3)
    ->withDeadCodeLevel(3);


