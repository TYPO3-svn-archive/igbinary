<?php

########################################################################
# Extension Manager/Repository config file for ext "cache_igbinary".
#
# Auto generated 18-07-2010 20:42
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Igbinary Cache Frontend',
	'description' => 'Frontend for TYPO3 caching framework, using the Igbinary PHP extension for better performance with large objects.',
	'category' => 'misc',
	'shy' => 0,
	'dependencies' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.3.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => 0,
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => 'L',
	'author' => 'Jeff Segars',
	'author_email' => 'jsegars@alumni.rice.edu',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '1.0.0',
	'_md5_values_when_last_written' => 'a:2:{s:43:"class.tx_cacheigbinary_igbinaryfrontend.php";s:4:"d654";s:17:"ext_localconf.php";s:4:"4922";}',
	'suggests' => array(
	),
);

?>