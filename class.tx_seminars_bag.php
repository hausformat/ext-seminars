<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005-2006 Oliver Klee (typo3-coding@oliverklee.de)
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
 * Class 'tx_seminars_bag' for the 'seminars' extension.
 *
 * This aggregate class holds a bunch of objects that are created from
 * the result of an SQL query and allows to iterate over them.
 *
 * This is an abstract class; don't instantiate it.
 *
 * When inheriting from this class, make sure to implement the function
 * createItemFromDbResult.
 *
 * @author	Oliver Klee <typo3-coding@oliverklee.de>
 */

require_once(t3lib_extMgm::extPath('seminars').'class.tx_seminars_dbplugin.php');

class tx_seminars_bag extends tx_seminars_dbplugin {
	/** Same as class name */
	var $prefixId = 'tx_seminars_seminar_bag';
	/**  Path to this script relative to the extension dir. */
	var $scriptRelPath = 'class.tx_seminars_bag.php';

	/** the name of the DB table from which we get the records for this bag */
	var $dbTableName;
	/** an SQL query result (not converted to an associative array yet) */
	var $dbResult = null;
	/** the current object (may be null) */
	var $currentItem = null;
	/**
	 * string that will be prepended to the WHERE clause using AND, e.g. 'pid=42'
	 * (the AND and the enclosing spaces are not necessary for this parameter)
	 */
	var $queryParameters;

	/**
	 * The constructor. Sets the iterator to the first result of a query
	 *
	 * @param	string		the name of an SQL table to query
	 * @param	string		string that will be prepended to the WHERE clause
	 *						using AND, e.g. 'pid=42' (the AND and the enclosing
	 *						spaces are not necessary for this parameter)
	 *
	 * @access	public
	 */
	function tx_seminars_bag($dbTableName, $queryParameters = '1') {
		$this->dbTableName = $dbTableName;
		$this->queryParameters = trim($queryParameters);

		$this->init();
		$this->resetToFirst();

		return;
	}

	/**
	 * Sets the iterator to the first object, using additional
	 * query parameters from $this->queryParameters for the DB query.
	 *
	 * @return	boolean		true if everything went okay, false otherwise
	 *
	 * @access	public
	 */
	function resetToFirst() {
		$result = false;

		// free old results if there are any
		if ($this->dbResult) {
			$GLOBALS['TYPO3_DB']->sql_free_result($this->dbResult);
			// We don't need to null out $this->dbResult as this will be
			// rewritten immediately.
		}

		// The ' AND' is provided by t3lib_pageSelect::enableFields,
		// so we don't need to set it explicitely after $this->queryParameters.
		$this->dbResult =& $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'*',
			$this->dbTableName,
			$this->queryParameters.t3lib_pageSelect::enableFields($this->dbTableName),
			'',
			'',
			''
		);

		if ($this->dbResult) {
			$result = (boolean) $this->getNext();
		}

		return $result;
	}

	/**
	 * Advances to the next event record and returns a reference to that object.
	 *
	 * @return	object		a reference to the now current object
	 *						(may be null if there is no next object)
	 *
	 * @access	public
	 */
	function &getNext() {
		if ($this->dbResult) {
			$this->createItemFromDbResult();
		} else {
			$this->currentItem = null;
		}

		return $this->getCurrent();
	}

	/**
	 * Creates the current item in $this->currentItem, using $this->dbResult as a source.
	 * If the current item cannot be created, $this->currentItem will be nulled out.
	 *
	 * $this->dbResult is ensured to be non-null when this function is called.
	 *
	 * @access	protected
	 */
	function createItemFromDbResult() {
		trigger_error('The function tx_seminars_bag::createItemFromDbResult() needs to be implemented in a derived class.');
	}

	/**
	 * Returns the current seminar object (which may be null).
	 *
	 * @return	object		a reference to the current seminar object (may be null if there is no current object)
	 *
	 * @access	public
	 */
	function &getCurrent() {
		return $this->currentItem;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminars/class.tx_seminars_bag.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminars/class.tx_seminars_bag.php']);
}
