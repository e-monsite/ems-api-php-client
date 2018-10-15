<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ShardSite resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ShardSite 
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
	 * @var string
	 */
	public $timezone;

	/**
	 * @var string
	 */
	public $activity;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * ShardSite resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $timezone
	 * @param string $activity
	 * @param string $add_dt Format: date-time.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $timezone = null, $activity = null, $add_dt = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->timezone = $timezone;
		$this->activity = $activity;
		$this->add_dt = $add_dt;
	}
}
