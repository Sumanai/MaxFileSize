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
	* @var \phpbb\php\ini
	*/
	private $php_ini;

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
		\phpbb\php\ini $php_ini,
		\phpbb\template\template $template,
		\phpbb\user $user
	) {
		$this->auth = $auth;
		$this->config = $config;
		$this->php_ini = $php_ini;
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

		$php_max_size = $this->get_upload_max_filesize();
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

	/**
	* Get allowed file size uploaded per PHP ini settings
	*
	* @return int
	*/
	private function get_upload_max_filesize()
	{
		$max = min(
			$this->php_ini->get_bytes('upload_max_filesize'),
			$this->php_ini->get_bytes('post_max_size')
		);

		return $max;
	}
}
