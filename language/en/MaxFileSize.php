<?php
/**
*
* @package phpBB Extension - MaxFileSize
* @copyright (c) 2016 Sumanai
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'MAX_FILE_SIZE' => 'Maximum file size: %1$d %2$s.',
));
