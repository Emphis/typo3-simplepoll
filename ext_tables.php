<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

/**
 * Register Icons
 */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'simplepoll-poll',
    \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class,
    ['name' => 'bar-chart']
);
$iconRegistry->registerIcon(
    'simplepoll-answer',
    \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class,
    ['name' => 'check-square-o']
);
$iconRegistry->registerIcon(
    'simplepoll-iplock',
    \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class,
    ['name' => 'lock']
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Polllisting',
	'Simple Poll'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Simple Poll Extension');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_simplepoll_domain_model_simplepoll', 'EXT:simplepoll/Resources/Private/Language/locallang_csh_tx_simplepoll_domain_model_simplepoll.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_simplepoll_domain_model_simplepoll');
$GLOBALS['TCA']['tx_simplepoll_domain_model_simplepoll'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:simplepoll/Resources/Private/Language/locallang_db.xlf:tx_simplepoll_domain_model_simplepoll',
		'label' => 'question',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'question,image,end_time,show_result_link,show_result_after_vote,allow_multiple_vote,answers,ip_locks,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/SimplePoll.php',
		'typeicon_classes' => array(
            'default' => 'simplepoll-poll',
        ),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_simplepoll_domain_model_answer', 'EXT:simplepoll/Resources/Private/Language/locallang_csh_tx_simplepoll_domain_model_answer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_simplepoll_domain_model_answer');
$GLOBALS['TCA']['tx_simplepoll_domain_model_answer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:simplepoll/Resources/Private/Language/locallang_db.xlf:tx_simplepoll_domain_model_answer',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,counter,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Answer.php',
		'typeicon_classes' => array(
            'default' => 'simplepoll-answer',
        ),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_simplepoll_domain_model_iplock', 'EXT:simplepoll/Resources/Private/Language/locallang_csh_tx_simplepoll_domain_model_iplock.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_simplepoll_domain_model_iplock');
$GLOBALS['TCA']['tx_simplepoll_domain_model_iplock'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:simplepoll/Resources/Private/Language/locallang_db.xlf:tx_simplepoll_domain_model_iplock',
		'label' => 'address',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'address,timestamp,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/IpLock.php',
		'typeicon_classes' => array(
            'default' => 'simplepoll-iplock',
        ),
	),
);

// include the flexform for the plugin
$pluginSignature = 'simplepoll_polllisting';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:simplepoll/Configuration/FlexForms/flexform_simplepoll.xml');
