<?php
/**
*
* @package phpBB Extension - MaxFileSize
* @copyright (c) 2016 Sumanai
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace Sumanai\MaxFileSize\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/**
	* Auth object
	*
	* @var \phpbb\auth\auth
	*/
	private $auth;

	/**
	* The config
	*
	* @var \phpbb\config\config
	*/
	private $config;

	/**
	* The plupload object
	*
	* @var \phpbb\plupload\plupload
	*/
	private $plupload;

	/**
	* Template object
	*
	* @var \phpbb\template\template
	*/
	private $template;

	/**
	* User object
	*
	* @var \phpbb\user
	*/
	private $user;

	/**
	* Constructor
	* Always your Captain Obvious
	*/
	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\config\config $config,
		\phpbb\plupload\plupload $plupload,
		\phpbb\template\template $template,
		\phpbb\user $user
	) {
		$this->auth = $auth;
		$this->config = $config;
		$this->plupload = $plupload;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'   => 'main',
		);
	}

	public function main($event)
	{
		$this->user->add_lang_ext('Sumanai/MaxFileSize', 'MaxFileSize');
		$this->user->add_lang('common');

		$php_max_size = $this->plupload->get_upload_max_filesize();
		if ($this->auth->acl_get('a_'))
		{
			$max_filesize = $php_max_size;
		}
		else
		{
			$max_filesize = min($config['max_filesize'], $php_max_size);
		}

		$max_filesize = get_formatted_filesize($max_filesize, false);

		$this->template->assign_vars(array(
			'MAX_FILE_SIZE' => $this->user->lang('MAX_FILE_SIZE', $max_filesize['value'], $max_filesize['unit']),
		));
	}
}
