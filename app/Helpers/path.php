<?php

function DS()
{
    return DIRECTORY_SEPARATOR;
}

function getModulePath($moduleName)
{
    return app_path('Modules' . DS() . $moduleName . DS());
}

function loadConfigFile($fileName, $moduleName)
{
    return getModulePath($moduleName) . 'config' . DS() . $fileName . '.php';
}

function loadRoute($fileName, $moduleName)
{
    return getModulePath($moduleName) . 'routes' . DS() . $fileName . '.php';
}

function loadViews($moduleName)
{
    return getModulePath($moduleName) . 'resources' . DS() . 'views';
}

function loadTranslations($moduleName)
{
    return getModulePath($moduleName) . 'resources' . DS() . 'lang';
}

function loadMigrations($moduleName)
{
    return getModulePath($moduleName) . 'database' . DS() . 'migrations';
}

