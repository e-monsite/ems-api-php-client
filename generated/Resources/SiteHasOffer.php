<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * SiteHasOffer resource class
 * 
 * @package Emonsite\Api\Resources
 */
class SiteHasOffer 
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
	 * Format: date.
	 * 
	 * @var string
	 */
	public $offer_added_at;

	/**
	 * Format: date.
	 * 
	 * @var string
	 */
	public $offer_renewed_at;

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
	 * SiteHasOffer resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $offer_id Format: ems-offerid.
	 * @param string $expiration_date Format: date.
	 * @param string $offer_added_at Format: date.
	 * @param string $offer_renewed_at Format: date.
	 * @param string $domain
	 * @param string $support_user_id Format: ems-uuid.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $offer_id = null, $expiration_date = null, $offer_added_at = null, $offer_renewed_at = null, $domain = null, $support_user_id = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->offer_id = $offer_id;
		$this->expiration_date = $expiration_date;
		$this->offer_added_at = $offer_added_at;
		$this->offer_renewed_at = $offer_renewed_at;
		$this->domain = $domain;
		$this->support_user_id = $support_user_id;
	}
}
