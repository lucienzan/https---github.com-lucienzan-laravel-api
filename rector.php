<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
use RectorLaravel\Set\LaravelLevelSetList;

return static function (RectorConfig $rectorConfig): void {
    // Define paths to analyze (Laravel-specific directories)
    $rectorConfig->paths([
        __DIR__.'/app',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/resources',
        __DIR__.'/routes',
        __DIR__.'/tests',
    ]);

    // Enable caching for performance
    $rectorConfig->cacheDirectory(__DIR__.'/storage/rector');
    $rectorConfig->cacheClass(Rector\Caching\ValueObject\Storage\FileCacheStorage::class);

    // Apply Laravel-specific rules (e.g., for Laravel 11)
    $rectorConfig->sets([
        LaravelLevelSetList::UP_TO_LARAVEL_110,
        SetList::DEAD_CODE,
        SetList::NAMING,
        SetList::CODE_QUALITY,
        SetList::TYPE_DECLARATION, // Enables type declaration rules
    ]);

    // Add specific type declaration rules
    $rectorConfig->rules([
        ReturnTypeFromStrictNativeCallRector::class, // Adds return types based on native PHP calls
        ReturnTypeFromStrictTypedCallRector::class, // Adds return types for typed calls
        TypedPropertyFromStrictConstructorRector::class, // Adds typed properties from constructors
        AddParamTypeDeclarationRector::class, // Adds parameter types based on method calls
    ]);

    // Set PHP version (adjust based on your project)
    $rectorConfig->phpVersion(Rector\ValueObject\PhpVersion::PHP_83);

    // Optional: Skip specific rules or files if needed
    $rectorConfig->skip([
        Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector::class,
        __DIR__.'/vendor/*',
        __DIR__.'/*.blade.php',
    ]);
};
