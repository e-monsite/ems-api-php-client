<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelItemBlockLineVersionListResponse resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelItemBlockLineVersionListResponse 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * @var ModelItemBlockLineVersion[]
	 */
	public $data;

	/**
	 * @var Meta
	 */
	public $meta;

	/**
	 * ModelItemBlockLineVersionListResponse resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param ModelItemBlockLineVersion[] $data
	 * @param Meta $meta
	 */
	public function __construct(ApiClient $apiClient, $data = null, $meta = null)
	{
		$this->apiClient = $apiClient;
		$this->data = $data;
		$this->meta = $meta;
	}
}
