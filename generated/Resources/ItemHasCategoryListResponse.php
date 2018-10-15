<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ItemHasCategoryListResponse resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ItemHasCategoryListResponse 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * @var ItemHasCategory[]
	 */
	public $data;

	/**
	 * @var Meta
	 */
	public $meta;

	/**
	 * ItemHasCategoryListResponse resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param ItemHasCategory[] $data
	 * @param Meta $meta
	 */
	public function __construct(ApiClient $apiClient, $data = null, $meta = null)
	{
		$this->apiClient = $apiClient;
		$this->data = $data;
		$this->meta = $meta;
	}
}
