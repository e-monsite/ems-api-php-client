<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ItemHasCategory resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ItemHasCategory 
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
	 * @var string
	 */
	public $model_id;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $item_id;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $parent_id;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $ordering;

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
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $upd_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $upd_user_id;

	/**
	 * ItemHasCategory resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $model_id
	 * @param string $item_id Format: ems-uuid.
	 * @param string $parent_id Format: ems-uuid.
	 * @param int $ordering Format: int32.
	 * @param string $add_dt Format: date-time.
	 * @param string $add_user_id Format: ems-uuid.
	 * @param string $upd_dt Format: date-time.
	 * @param string $upd_user_id Format: ems-uuid.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $model_id = null, $item_id = null, $parent_id = null, $ordering = null, $add_dt = null, $add_user_id = null, $upd_dt = null, $upd_user_id = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->model_id = $model_id;
		$this->item_id = $item_id;
		$this->parent_id = $parent_id;
		$this->ordering = $ordering;
		$this->add_dt = $add_dt;
		$this->add_user_id = $add_user_id;
		$this->upd_dt = $upd_dt;
		$this->upd_user_id = $upd_user_id;
	}
}
