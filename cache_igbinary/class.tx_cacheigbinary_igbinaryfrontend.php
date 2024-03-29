<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Jeff Segars <jsegars@alumni.rice.edu>
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
 * A cache for any kind of PHP variable, using Igbinary for serialize and unserialize.
 * Derviced from TYPO3's built in VariableFrontend
 *
 *
 * @package TYPO3
 * @subpackage t3lib_cache
 * @api
 */
class tx_cacheigbinary_IgbinaryFrontend extends t3lib_cache_frontend_AbstractFrontend {

	/**
	 * Constructs the cache
	 *
	 * @param string A identifier which describes this cache
	 * @param t3lib_cache_backend_Backend Backend to be used for this cache
	 * @throws InvalidArgumentException if the identifier doesn't match PATTERN_ENTRYIDENTIFIER
	 * @internal
	 */
	public function __construct($identifier, t3lib_cache_backend_Backend $backend) {
		if (!extension_loaded('igbinary')) {
			throw new t3lib_cache_Exception(
				'The PHP extension "igbinary" must be installed and loaded in ' .
				'order to use the Igbinary frontend.',
				1279505380
			);
		}

		parent::__construct($identifier, $backend);
	}

	/**
	 * Saves the value of a PHP variable in the cache. Note that the variable
	 * will be serialized if necessary.
	 *
	 * @param string $entryIdentifier An identifier used for this cache entry
	 * @param mixed $variable The variable to cache
	 * @param array $tags Tags to associate with this cache entry
	 * @param integer $lifetime Lifetime of this cache entry in seconds. If NULL is specified, the default lifetime is used. "0" means unlimited liftime.
 	 * @return void
	 */
	public function set($entryIdentifier, $variable, $tags = array(), $lifetime = NULL) {
		if (!$this->isValidEntryIdentifier($entryIdentifier)) {
			throw new InvalidArgumentException(
				'"' . $entryIdentifier . '" is not a valid cache entry identifier.',
				1233058264
			);
		}

		foreach ($tags as $tag) {
			if (!$this->isValidTag($tag)) {
				throw new InvalidArgumentException(
					'"' . $tag . '" is not a valid tag for a cache entry.',
					1233058269
				);
			}
		}

		$this->backend->set($entryIdentifier, igbinary_serialize($variable), $tags, $lifetime);
	}

	/**
	 * Loads a variable value from the cache.
	 *
	 * @param string Identifier of the cache entry to fetch
	 * @return mixed The value
	 * @throws t3lib_cache_exception_ClassAlreadyLoaded if the class already exists
	 */
	public function get($entryIdentifier) {
		if (!$this->isValidEntryIdentifier($entryIdentifier)) {
			throw new InvalidArgumentException(
				'"' . $entryIdentifier . '" is not a valid cache entry identifier.',
				1233058294
			);
		}

		return igbinary_unserialize($this->backend->get($entryIdentifier));
	}

	/**
	 * Finds and returns all cache entries which are tagged by the specified tag.
	 *
	 * @param string $tag The tag to search for
	 * @return array An array with the content of all matching entries. An empty array if no entries matched
	 */
	public function getByTag($tag) {
		if (!$this->isValidTag($tag)) {
			throw new InvalidArgumentException(
				'"' . $tag . '" is not a valid tag for a cache entry.',
				1233058312
			);
		}

		$entries = array();
		$identifiers = $this->backend->findIdentifiersByTag($tag);

		foreach ($identifiers as $identifier) {
			$entries[] = igbinary_unserialize($this->backend->get($identifier));
		}

		return $entries;
	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['typo3conf/ext/cache_igbinary/class.tx_cacheigbinary_igbinaryfrontend.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['typo3conf/ext/cache_igbinary/class.tx_cacheigbinary_igbinaryfrontend.php']);
}

?>