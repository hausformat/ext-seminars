<?php
defined('TYPO3_MODE') or die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_seminars=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_speakers=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_attendances=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_sites=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_organizers=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_payment_methods=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_event_types=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_checkboxes=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_lodgings=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_foods=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_target_groups=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_categories=1
');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_seminars_skills=1
');


// Adds our custom function to a hook in \TYPO3\CMS\Core\DataHandling\DataHandler
// Used for post-validation of fields in back-end forms.
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:seminars/Classes/class.tx_seminars_tcemain.php:tx_seminars_tcemainprocdm';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43(
	$_EXTKEY, 'Classes/FrontEnd/DefaultController.php', '_pi1', 'list_type', 0
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY, 'setup', '
	plugin.' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getCN($_EXTKEY) . '_pi1.userFunc = Tx_Seminars_FrontEnd_DefaultController->main
', 43);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
	$_EXTKEY,
	'setup', '
	tt_content.shortcut.20.conf.tx_seminars_seminars = < plugin.' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getCN($_EXTKEY) . '_pi1
	tt_content.shortcut.20.conf.tx_seminars_seminars.CMD = singleView
',
	43
);

// registers the seminars command line interface
$TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys']['seminars'] = array(
	'EXT:seminars/Classes/cli/tx_seminars_cli.php', '_CLI_seminars',
);