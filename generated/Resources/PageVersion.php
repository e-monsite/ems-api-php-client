<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * PageVersion resource class
 * 
 * @package Emonsite\Api\Resources
 */
class PageVersion 
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
	 * @var boolean
	 */
	public $active;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $titlemenu;

	/**
	 * @var string
	 */
	public $content;

	/**
	 * @var string
	 */
	public $seo_uri;

	/**
	 * @var string
	 */
	public $seo_title;

	/**
	 * @var string
	 */
	public $seo_h1;

	/**
	 * @var string
	 */
	public $seo_keywords;

	/**
	 * @var string
	 */
	public $seo_description;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $seo_image_id;

	/**
	 * @var string
	 */
	public $seo_additional_meta;

	/**
	 * @var boolean
	 */
	public $seo_no_index;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $add_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $add_user_id;

	/**
	 * PageVersion resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $item_id Format: ems-uuid.
	 * @param string $lang Format: ems-lang.
	 * @param boolean $active
	 * @param string $title
	 * @param string $titlemenu
	 * @param string $content
	 * @param string $seo_uri
	 * @param string $seo_title
	 * @param string $seo_h1
	 * @param string $seo_keywords
	 * @param string $seo_description
	 * @param string $seo_image_id Format: ems-uuid.
	 * @param string $seo_additional_meta
	 * @param boolean $seo_no_index
	 * @param string $add_dt Format: date-time.
	 * @param string $add_user_id Format: ems-uuid.
	 */
	public function __construct(ApiClient $apiClient, $item_id = null, $lang = null, $active = null, $title = null, $titlemenu = null, $content = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null, $add_dt = null, $add_user_id = null)
	{
		$this->apiClient = $apiClient;
		$this->item_id = $item_id;
		$this->lang = $lang;
		$this->active = $active;
		$this->title = $title;
		$this->titlemenu = $titlemenu;
		$this->content = $content;
		$this->seo_uri = $seo_uri;
		$this->seo_title = $seo_title;
		$this->seo_h1 = $seo_h1;
		$this->seo_keywords = $seo_keywords;
		$this->seo_description = $seo_description;
		$this->seo_image_id = $seo_image_id;
		$this->seo_additional_meta = $seo_additional_meta;
		$this->seo_no_index = $seo_no_index;
		$this->add_dt = $add_dt;
		$this->add_user_id = $add_user_id;
	}
}
