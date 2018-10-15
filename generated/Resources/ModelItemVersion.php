<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelItemVersion resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelItemVersion 
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
	 * ModelItemVersion resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $item_id Format: ems-uuid.
	 * @param string $lang Format: ems-lang.
	 */
	public function __construct(ApiClient $apiClient, $item_id = null, $lang = null)
	{
		$this->apiClient = $apiClient;
		$this->item_id = $item_id;
		$this->lang = $lang;
	}
}
