<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * SiteHadOffer resource class
 * 
 * @package Emonsite\Api\Resources
 */
class SiteHadOffer 
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
	 * Format: ems-offerid.
	 * 
	 * @var string
	 */
	public $offer_id;

	/**
	 * Format: date.
	 * 
	 * @var string
	 */
	public $expiration_date;

	/**
	 * @var string
	 */
	public $domain;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $support_user_id;

	/**
	 * SiteHadOffer resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $offer_id Format: ems-offerid.
	 * @param string $expiration_date Format: date.
	 * @param string $domain
	 * @param string $support_user_id Format: ems-uuid.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $offer_id = null, $expiration_date = null, $domain = null, $support_user_id = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->offer_id = $offer_id;
		$this->expiration_date = $expiration_date;
		$this->domain = $domain;
		$this->support_user_id = $support_user_id;
	}
}
