<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 Oliver Klee (typo3-coding@oliverklee.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Module 'Seminars' for the 'seminars' extension.
 *
 * @author	Oliver Klee <typo3-coding@oliverklee.de>
 */

unset($MCONF);
require ('conf.php');
require ($BACK_PATH.'init.php');
require ($BACK_PATH.'template.php');
$LANG->includeLLFile('EXT:seminars/mod1/locallang.php');
#include ('locallang.php');
require_once (PATH_t3lib.'class.t3lib_scbase.php');
require_once (PATH_t3lib.'class.t3lib_page.php');
require_once(t3lib_extMgm::extPath('seminars').'class.tx_seminars_registrationmanager.php');
require_once(t3lib_extMgm::extPath('seminars').'class.tx_seminars_seminar.php');
require_once(t3lib_extMgm::extPath('seminars').'class.tx_seminars_seminarbag.php');
// This checks permissions and exits if the users has no permission for entry.
$BE_USER->modAccess($MCONF, 1);
class tx_seminars_module1 extends t3lib_SCbase {
	var $pageinfo;

	/**
	 * @return	[type]		...
	 */
	function init()	{
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;

		parent::init();
	}

	/**
	 * Adds items to the ->MOD_MENU array. Used for the function menu selector.
	 *
	 * @return	[type]		...
	 */
	function menuConfig()	{
		global $LANG;
		$this->MOD_MENU = Array (
			'function' => Array (
				'updateStats' => $LANG->getLL('menu_updateStats'),
// removed until the corresponding parts are functional
//				'listSpeakers' => $LANG->getLL('menu_listSpeakers'),
//				'listSites' => $LANG->getLL('menu_listSites'),
//				'listSeminars' => $LANG->getLL('menu_listSeminars'),
//				'seminarDetails' => $LANG->getLL('menu_seminarDetails'),
			)
		);
		parent::menuConfig();
	}

	// If you chose 'web' as main module, you will need to consider the $this->id parameter which will contain the uid-number of the page clicked in the page tree
	/**
	 * Main function of the module. Writes the content to $this->content
	 *
	 * @return	[type]		...
	 */
	function main()	{
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;

		// Access check!
		// The page will show only if there is a valid page and if this page may be viewed by the user
		$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
		$access = is_array($this->pageinfo) ? 1 : 0;

		if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->id))	{
			// Draw the header.
			$this->doc = t3lib_div::makeInstance('mediumDoc');
			$this->doc->backPath = $BACK_PATH;
			$this->doc->form='<form action="" method="POST">';

			// JavaScript
			$this->doc->JScode = '
				<script language="javascript" type="text/javascript">
					script_ended = 0;
					function jumpToUrl(URL)	{
						document.location = URL;
					}
				</script>
			';
			$this->doc->postCode='
				<script language="javascript" type="text/javascript">
					script_ended = 1;
					if (top.fsMod) top.fsMod.recentIds["web"] = '.intval($this->id).';
				</script>
			';

			$headerSection = $this->doc->getHeader('pages',$this->pageinfo,$this->pageinfo['_thePath']).'<br>'.$LANG->sL('LLL:EXT:lang/locallang_core.php:labels.path').': '.t3lib_div::fixed_lgd_pre($this->pageinfo['_thePath'],50);

			$this->content.=$this->doc->startPage($LANG->getLL('title'));
			$this->content.=$this->doc->header($LANG->getLL('title'));
			$this->content.=$this->doc->spacer(5);
			$this->content.=$this->doc->section('',$this->doc->funcMenu($headerSection,t3lib_BEfunc::getFuncMenu($this->id,'SET[function]',$this->MOD_SETTINGS['function'],$this->MOD_MENU['function'])));
			$this->content.=$this->doc->divider(5);

			// Render content:
			$this->moduleContent();

			// ShortCut
			if ($BE_USER->mayMakeShortcut())	{
				$this->content.=$this->doc->spacer(20).$this->doc->section('',$this->doc->makeShortcutIcon('id',implode(',',array_keys($this->MOD_MENU)),$this->MCONF['name']));
			}

			$this->content.=$this->doc->spacer(10);
		} else {
			// If no access or if ID == zero

			$this->doc = t3lib_div::makeInstance('mediumDoc');
			$this->doc->backPath = $BACK_PATH;

			$this->content.=$this->doc->startPage($LANG->getLL('title'));
			$this->content.=$this->doc->header($LANG->getLL('title'));
			$this->content.=$this->doc->spacer(5);
			$this->content.=$this->doc->spacer(10);
		}
	}

	/**
	 * Prints out the module HTML
	 *
	 * @return	[type]		...
	 */
	function printContent() {
		$this->content .= $this->doc->endPage();
		echo $this->content;
	}

	/**
	 * Generates the module content.
	 *
	 * @return	[type]		...
	 */
	function moduleContent() {
		global $LANG;

		switch ((string)$this->MOD_SETTINGS['function']) {
			case 'updateStats':
				$content = $this->updateStats();
				$this->content.=$this->doc->section($LANG->getLL('menu_updateStats'),$content,0,1);
			break;
			case 'listSpeakers':
				$content='<div align=center><strong>List Speakers</strong></div>';
				$this->content.=$this->doc->section('Message #2:',$content,0,1);
			break;
			case 'listSites':
				$content='<div align=center><strong>List Sites</strong></div>';
				$this->content.=$this->doc->section('Message #3:',$content,0,1);
			break;
			case 'listSeminars':
				$content='<div align=center><strong>List Seminars</strong></div>';
				$this->content.=$this->doc->section('Message #3:',$content,0,1);
			break;
		}
	}

	/**
	 * Updates the seminar statistics (number of attendances, is full,
	 * has enough attendances etc.).
	 *
	 * @return	string		HTML code displaying the updated statistics
	 *
	 * @access	private
	 */
	function updateStats() {
		global $LANG;

		$tableSeminars = 'tx_seminars_seminars';
		$tableAttendances = 'tx_seminars_attendances';
		$tableUsers = 'fe_users';

		$result = '';

		$registrationManager =& t3lib_div::makeInstance('tx_seminars_registrationmanager');
		$seminarBagClassname = t3lib_div::makeInstanceClassName('tx_seminars_seminarbag');
		$seminarBag =& new $seminarBagClassname($registrationManager);

		$result .= '<h3>'.$LANG->getLL('message_updatingAttendanceNumbers').'</h3>'.chr(10);
		while ($currentSeminar =& $seminarBag->getCurrent()) {
			$currentSeminar->updateStatistics();

			$result .= '<h4>'.htmlspecialchars($currentSeminar->getTitle()).'</h4>'.chr(10);
			$result .= '<p>'.$LANG->getLL('label_all').$currentSeminar->getAttendances().'</p>';
			$result .= '<p>'.$LANG->getLL('label_paid').$currentSeminar->getAttendancesPaid().'</p>';
			$result .= '<p>'.$LANG->getLL('label_unpaid').$currentSeminar->getAttendancesNotPaid().'</p>';
			$result .= '<p>'.$LANG->getLL('label_vacancies').$currentSeminar->getVacancies().'</p>';
			$result .= '<p>'.$LANG->getLL('label_hasEnough').((integer) $currentSeminar->hasEnoughAttendances()).'</p>';
			$result .= '<p>'.$LANG->getLL('label_isFull').((integer) $currentSeminar->isFull()).'</p>';

			$seminarBag->getNext();
		}

		$result .= '<h3>Titel der Anmeldungen werden aktualisiert</h3>';
		$dbResultAttendances = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'*',
			$tableAttendances,
			'1'.t3lib_pageSelect::enableFields($tableAttendances),
			'',
			'',
			''
		);
		if ($dbResultAttendances) {
			while ($currentAttendance = mysql_fetch_assoc($dbResultAttendances)) {
				$dbResultAttendee = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'uid,name,username',
					$tableUsers,
					'uid='.intval($currentAttendance['user'])
						.t3lib_pageSelect::enableFields($tableUsers),
					'',
					'',
					''
				);
				$dbResultSeminar = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'title, begin_date',
					$tableSeminars,
					'uid='.intval($currentAttendance['seminar'])
						.t3lib_pageSelect::enableFields($tableSeminars),
					'',
					'',
					''
				);

				if ($dbResultAttendee && $dbResultSeminar) {
					$attendeeName = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbResultAttendee);
					$seminarData = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbResultSeminar);
					$newTitle = $attendeeName['name'].' / '.$seminarData['title'].' '.strftime('%d.%m.%Y', $seminarData['begin_date']);
					$displayTitle = $attendeeName['name'].' ['.$attendeeName['username'].':'.$attendeeName['uid'].'] / '.$seminarData['title'].' '.strftime('%d.%m.%Y', $seminarData['begin_date']);
					$result .= '<p>'.$displayTitle.'</p>';
					$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
						$tableAttendances,
						'uid='.intval($currentAttendance['uid']),
						array('title' => $GLOBALS['TYPO3_DB']->quoteStr($newTitle, $tableAttendances))
					);
				}
			}
		}
		return $result;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminars/mod1/index.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminars/mod1/index.php']);
}

// Make instance:
$SOBE = t3lib_div::makeInstance('tx_seminars_module1');
$SOBE->init();

// Include files?
foreach ($SOBE->include_once as $INC_FILE) {
	include_once($INC_FILE);
}

$SOBE->main();
$SOBE->printContent();

?>