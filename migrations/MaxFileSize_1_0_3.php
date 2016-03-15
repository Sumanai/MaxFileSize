<?php
/**
*
* @package phpBB Extension - MaxFileSize
* @copyright (c) 2016 Sumanai
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace Sumanai\MaxFileSize\migrations;

class MaxFileSize_1_0_3 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['max_filesize_version']) && version_compare($this->config['max_filesize_version'], '1.0.3', '>=');
	}

	static public function depends_on()
	{
		return array('\Sumanai\MaxFileSize\migrations\MaxFileSize_1_0_2');
	}

	public function update_schema()
	{
		return array(
		);
	}

	public function revert_schema()
	{
		return array(
		);
	}

	public function update_data()
	{
		return array(
			// Current version
			array('config.update', array('max_filesize_version', '1.0.3')),
		);
	}
}
