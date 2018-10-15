<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * SiteHasUser resource class
 * 
 * @package Emonsite\Api\Resources
 */
class SiteHasUser 
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
	public $id;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $site_id;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $user_id;

	/**
	 * @var string
	 */
	public $role;

	/**
	 * @var boolean
	 */
	public $active;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * SiteHasUser resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $user_id Format: ems-uuid.
	 * @param string $role
	 * @param boolean $active
	 * @param string $add_dt Format: date-time.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $user_id = null, $role = null, $active = null, $add_dt = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->user_id = $user_id;
		$this->role = $role;
		$this->active = $active;
		$this->add_dt = $add_dt;
	}
}
