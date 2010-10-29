<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheFrontends']['tx_cacheigbinary_IgbinaryFrontend'] = 'typo3conf/ext/cache_igbinary/class.tx_cacheigbinary_igbinaryfrontend.php:tx_cacheigbinary_IgbinaryFrontend';

?>