<?php
/***************************************************************
* Copyright notice
*
* (c) 2006-2007 Mario Rimann (typo3-coding@rimann.org)
* All rights reserved
*
* This script is part of the TYPO3 project. The TYPO3 project is
* free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* The GNU General Public License can be found at
* http://www.gnu.org/copyleft/gpl.html.
*
* This script is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Module 'Events' for the 'seminars' extension.
 *
 * @author	Mario Rimann <typo3-coding@rimann.org>
 * @author	Niels Pardon <mail@niels-pardon.de>
 */

unset($MCONF);

require_once('conf.php');
require_once($BACK_PATH.'init.php');
require_once($BACK_PATH.'template.php');
require_once(PATH_t3lib.'class.t3lib_scbase.php');
require_once(PATH_t3lib.'class.t3lib_page.php');
require_once(PATH_t3lib.'class.t3lib_befunc.php');
require_once(t3lib_extMgm::extPath('seminars').'class.tx_seminars_configgetter.php');
require_once(t3lib_extMgm::extPath('seminars').'mod2/class.tx_seminars_eventslist.php');
require_once(t3lib_extMgm::extPath('seminars').'mod2/class.tx_seminars_registrationslist.php');
require_once(t3lib_extMgm::extPath('seminars').'mod2/class.tx_seminars_speakerslist.php');
require_once(t3lib_extMgm::extPath('seminars').'mod2/class.tx_seminars_organizerslist.php');
require_once(t3lib_extMgm::extPath('seminars').'pi2/class.tx_seminars_pi2.php');

$LANG->includeLLFile('EXT:lang/locallang_show_rechis.xml');
$LANG->includeLLFile('EXT:lang/locallang_mod_web_list.xml');
$LANG->includeLLFile('EXT:seminars/mod2/locallang.php');

// This checks permissions and exits if the users has no permission for entry.
$BE_USER->modAccess($MCONF, 1);

class tx_seminars_module2 extends t3lib_SCbase {
	/** Holds information about the current page. */
	var $pageInfo;

	/**
	 * Initializes some variables and also starts the initialization of the parent class.
	 *
	 * @access	public
	 */
	function init() {
		/*
		 * This is a workaround for the wrong generated links. The workaround is needed to
		 * get the right values from the GET Parameter. This workaround is from Elmar Hinz
		 * who also noted this in the bug tracker (http://bugs.typo3.org/view.php?id=2178).
		 */
		$matches = array();
		foreach ($GLOBALS['_GET'] as $key => $value) {
			if (preg_match('/amp;(.*)/', $key, $matches)) {
				$GLOBALS['_GET'][$matches[1]] = $value;
			}
		}
		/* --- END OF Workaround --- */

		parent::init();

		return;
	}

	/**
	 * Main function of the module. Writes the content to $this->content.
	 *
	 * No return value; output is directly written to the page.
	 *
	 * @access	public
	 */
	function main() {
		global $LANG, $BACK_PATH, $BE_USER;

		$this->content = '';

		/**
		 * This variable will hold the information about the page. It will only be filled with values
		 * if the user has access to the page.
		 */
		$this->pageInfo = t3lib_BEfunc::readPageAccess($this->id, $this->perms_clause);
		// Access check:
		// The page will only be displayed if there is a valid page, if this
		// page may be viewed by the current BE user and if the static template
		// has been included or there actually are any records that will be
		// listed by this module on the current page.
		$hasAccess = is_array($this->pageInfo);

		if ((($this->id && $hasAccess) || ($BE_USER->user['admin']))
			&& $this->hasStaticTemplateOrRecords()) {
			// start the document
			$this->doc = t3lib_div::makeInstance('bigDoc');
			$this->doc->backPath = $BACK_PATH;
			$this->doc->form = '<form action="" method="post">';
			$this->doc->docType = 'xhtml_strict';
			$this->doc->styleSheetFile2 = '../typo3conf/ext/seminars/mod2/mod2.css';

			// JavaScript function called within getDeleteIcon()
			$this->doc->JScode = '
				<script type="text/javascript">
					function jumpToUrl(URL)	{
						document.location = URL;
					}
				</script>
			';

			// draw the header
			$this->content .= $this->doc->startPage($LANG->getLL('title'));
			$this->content .= $this->doc->header($LANG->getLL('title'));
			$this->content .= $this->doc->spacer(5);

			$databasePlugin =& t3lib_div::makeInstance('tx_seminars_dbplugin');
			$databasePlugin->setTableNames();

			// define the sub modules that should be available in the tabmenu
			$this->availableSubModules = array();

			// only show the tabs if the back-end user has access to the corresponding tables
			if ($BE_USER->check('tables_select', $databasePlugin->tableSeminars)) {
				$this->availableSubModules[1] = $LANG->getLL('subModuleTitle_events');
			}

			if ($BE_USER->check('tables_select', $databasePlugin->tableAttendances)) {
				$this->availableSubModules[2] = $LANG->getLL('subModuleTitle_registrations');
			}

			if ($BE_USER->check('tables_select', $databasePlugin->tableSpeakers)) {
				$this->availableSubModules[3] = $LANG->getLL('subModuleTitle_speakers');
			}

			if ($BE_USER->check('tables_select', $databasePlugin->tableOrganizers)) {
				$this->availableSubModules[4] = $LANG->getLL('subModuleTitle_organizers');
			}

			// Read the selected sub module (from the tab menu) and make it available within this class.
			$this->subModule = intval(t3lib_div::_GET('subModule'));

			// If $this->subModule is not a key of $this->availableSubModules,
			// set it to the key of the first element in $this->availableSubModules
			// so the first tab is activated.
			if (!array_key_exists($this->subModule, $this->availableSubModules)) {
				reset($this->availableSubModules);
				$this->subModule = key($this->availableSubModules);
			}

			// Only generate the tab menu if the current back-end user has the
			// rights to show any of the tabs.
			if ($this->subModule) {
				$this->content .= $this->doc->getTabMenu(array('id' => $this->id),
					'subModule',
					$this->subModule,
					$this->availableSubModules);
				$this->content .= $this->doc->spacer(5);
			}

			// Select which sub module to display.
			// If no sub module is specified, an empty page will be displayed.
			switch ($this->subModule) {
				case 2:
					$registrationsListClassname = t3lib_div::makeInstanceClassName('tx_seminars_registrationslist');
					$registrationsList = new $registrationsListClassname($this);
					$this->content .= $registrationsList->show();
					break;
				case 3:
					$speakersListClassname = t3lib_div::makeInstanceClassName('tx_seminars_speakerslist');
					$speakersList = new $speakersListClassname($this);
					$this->content .= $speakersList->show();
					break;
				case 4:
					$organizersListClassname = t3lib_div::makeInstanceClassName('tx_seminars_organizerslist');
					$organizersList = new $organizersListClassname($this);
					$this->content .= $organizersList->show();
					break;
				case 1:
					$eventsListClassname = t3lib_div::makeInstanceClassName('tx_seminars_eventslist');
					$eventsList = new $eventsListClassname($this);
					$this->content .= $eventsList->show();
				default:
					$this->content .= '';
					break;
			}

			// Finish the document (eg. add a closing html tag).
			$this->content .= $this->doc->endPage();
		} else {
			// The user doesn't have access.
			$this->doc = t3lib_div::makeInstance('mediumDoc');
			$this->doc->backPath = $BACK_PATH;

			$this->content .= $this->doc->startPage($LANG->getLL('title'));
			$this->content .= $this->doc->header($LANG->getLL('title'));
			$this->content .= $this->doc->spacer(5);

			// end page
			$this->content .= $this->doc->endPage();
		}

		// Output the whole content.
		echo $this->content;
	}

	/**
	 * Checks whether this extension's static template is included on the
	 * current page or there is at least one event, attendance, organizer or
	 * speaker record (and be it even hidden or deleted) on the current page.
	 *
	 * @return	boolean		true if the static template has been included or there is at least one event, attendance, organizer or speaker record on the current page, false otherwise
	 *
	 * @access	protected
	 */
	function hasStaticTemplateOrRecords() {
		$configGetterClassname = t3lib_div::makeInstanceClassName('tx_seminars_configgetter');
		$configGetter =& new $configGetterClassname();
		$configGetter->init();

		$result = $configGetter->getConfValueBoolean('isStaticTemplateLoaded');

		// Only bother to check the existence of records on this page if there
		// is *no* static template.
		if (!$result) {
			$dbResult = $GLOBALS['TYPO3_DB']->sql_query(
				'(SELECT COUNT(*) AS num FROM '.$configGetter->tableSeminars
					.' WHERE deleted=0 AND pid='.$this->id.') UNION '
					.'(SELECT COUNT(*) AS num FROM '.$configGetter->tableAttendances
					.' WHERE deleted=0 AND pid='.$this->id.') UNION '
					.'(SELECT COUNT(*) AS num FROM '.$configGetter->tableOrganizers
					.' WHERE deleted=0 AND pid='.$this->id.') UNION '
					.'(SELECT COUNT(*) AS num FROM '.$configGetter->tableSpeakers
					.' WHERE deleted=0 AND pid='.$this->id.')'
			);
			if ($dbResult) {
				$dbResultRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbResult);
				$result = ($dbResultRow['num'] > 0);
			}
		}

		return $result;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminars/mod2/index.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminars/mod2/index.php']);
}

// Make instance:
$SOBE = t3lib_div::makeInstance('tx_seminars_module2');
$SOBE->init();

// Include files?
foreach ($SOBE->include_once as $INC_FILE) {
	include_once($INC_FILE);
}

$SOBE->main();

?>
