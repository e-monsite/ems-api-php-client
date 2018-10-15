<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * SiteHadOfferListResponse resource class
 * 
 * @package Emonsite\Api\Resources
 */
class SiteHadOfferListResponse 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * @var SiteHadOffer[]
	 */
	public $data;

	/**
	 * @var Meta
	 */
	public $meta;

	/**
	 * SiteHadOfferListResponse resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param SiteHadOffer[] $data
	 * @param Meta $meta
	 */
	public function __construct(ApiClient $apiClient, $data = null, $meta = null)
	{
		$this->apiClient = $apiClient;
		$this->data = $data;
		$this->meta = $meta;
	}
}
