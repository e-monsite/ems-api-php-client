<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelCategoryVersionListResponse resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelCategoryVersionListResponse 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * @var ModelCategoryVersion[]
	 */
	public $data;

	/**
	 * @var Meta
	 */
	public $meta;

	/**
	 * ModelCategoryVersionListResponse resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param ModelCategoryVersion[] $data
	 * @param Meta $meta
	 */
	public function __construct(ApiClient $apiClient, $data = null, $meta = null)
	{
		$this->apiClient = $apiClient;
		$this->data = $data;
		$this->meta = $meta;
	}
}
