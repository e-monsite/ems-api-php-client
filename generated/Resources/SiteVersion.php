<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * SiteVersion resource class
 * 
 * @package Emonsite\Api\Resources
 */
class SiteVersion 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $item_id;

	/**
	 * Format: ems-lang.
	 * 
	 * @var string
	 */
	public $lang;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var boolean
	 */
	public $active;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * SiteVersion resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $item_id Format: ems-uuid.
	 * @param string $lang Format: ems-lang.
	 * @param string $title
	 * @param boolean $active
	 * @param string $description
	 * @param string $add_dt Format: date-time.
	 */
	public function __construct(ApiClient $apiClient, $item_id = null, $lang = null, $title = null, $active = null, $description = null, $add_dt = null)
	{
		$this->apiClient = $apiClient;
		$this->item_id = $item_id;
		$this->lang = $lang;
		$this->title = $title;
		$this->active = $active;
		$this->description = $description;
		$this->add_dt = $add_dt;
	}
}
