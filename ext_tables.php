<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'facebooklogin',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:facebooklogin/Resources/Public/Icons/extension.png']
        );

        // --------------------------------------------------------------------------------------



        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'SaschaEnde.Facebooklogin',
            'Login',
            'Facebook Login'
        );

        // --------------------------------------------------------------------------------------
        // Register FlexForm
        // --------------------------------------------------------------------------------------

        $extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('facebooklogin');
        $frontendpluginName = 'Login'; //Your Front-end Plugin Name
        $pluginSignature = strtolower($extensionName) . '_'.strtolower($frontendpluginName);
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,pages,recursive';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:facebooklogin/Configuration/FlexForm/Login.xml');

    }
);
