<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * EventVersionListResponse resource class
 * 
 * @package Emonsite\Api\Resources
 */
class EventVersionListResponse 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * @var EventVersion[]
	 */
	public $data;

	/**
	 * @var Meta
	 */
	public $meta;

	/**
	 * EventVersionListResponse resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param EventVersion[] $data
	 * @param Meta $meta
	 */
	public function __construct(ApiClient $apiClient, $data = null, $meta = null)
	{
		$this->apiClient = $apiClient;
		$this->data = $data;
		$this->meta = $meta;
	}
}
