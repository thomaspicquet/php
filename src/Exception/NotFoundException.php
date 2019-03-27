<?php
declare(strict_types=1);

/**
 * @author    Aaron Scherer <aequasi@gmail.com>
 * @date      2019
 * @license   http://opensource.org/licenses/MIT
 */


namespace Secretary\Exception;

/**
 * Class NotFoundException
 *
 * @package Secretary\Exception
 */
class NotFoundException extends \Exception
{
	/**
	 * NotFoundException constructor.
	 *
	 * @param string      $key
	 * @param string|null $path
	 */
	public function __construct(string $key, ?string $path = null)
	{
		$message = 'Could not find the secret using the given arguments: ';
		$message .= "\nKey: " . $key;
		if ($path !== null) {
			$message .= "\nPath: " . $path;
		}

		parent::__construct($message, 404);
	}
}
