<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * SiteHasModuleVersion resource class
 * 
 * @package Emonsite\Api\Resources
 */
class SiteHasModuleVersion 
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
	 * @var string
	 */
	public $title;

	/**
	 * @var boolean
	 */
	public $active;

	/**
	 * @var string
	 */
	public $seo_uri;

	/**
	 * @var object
	 */
	public $params;

	/**
	 * @var object
	 */
	public $category_params;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * SiteHasModuleVersion resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $item_id Format: ems-uuid.
	 * @param string $lang Format: ems-lang.
	 * @param string $title
	 * @param boolean $active
	 * @param string $seo_uri
	 * @param object $params
	 * @param object $category_params
	 * @param string $add_dt Format: date-time.
	 */
	public function __construct(ApiClient $apiClient, $item_id = null, $lang = null, $title = null, $active = null, $seo_uri = null, $params = null, $category_params = null, $add_dt = null)
	{
		$this->apiClient = $apiClient;
		$this->item_id = $item_id;
		$this->lang = $lang;
		$this->title = $title;
		$this->active = $active;
		$this->seo_uri = $seo_uri;
		$this->params = $params;
		$this->category_params = $category_params;
		$this->add_dt = $add_dt;
	}
}
