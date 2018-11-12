<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'SaschaEnde.Facebooklogin',
            'Login',
            [
                'Login' => 'login'
            ],
            // non-cacheable actions
            [
                'Login' => 'login'
            ]
        );



        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    login {
                        iconIdentifier = facebooklogin
                        title = Facebook Login
                        description = Anmeldung mit Facebook
                        tt_content_defValues {
                            CType = list
                            list_type = facebooklogin_login
                        }
                    }
                }
                show = *
            }
       }'
        );

    }
);
