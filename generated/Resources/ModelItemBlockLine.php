<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelItemBlockLine resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelItemBlockLine 
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
	public $item_id;

	/**
	 * @var string
	 */
	public $css_class;

	/**
	 * @var string
	 */
	public $css_id;

	/**
	 * @var string
	 */
	public $css_style;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $height;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $position;

	/**
	 * @var string
	 */
	public $pagination;

	/**
	 * @var ModelItemBlockLineVersionListResponse
	 */
	public $modelItemBlockLineVersions;

	/**
	 * @var ModelItemBlockCellListResponse
	 */
	public $modelItemBlockCells;

	/**
	 * ModelItemBlockLine resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $item_id Format: ems-uuid.
	 * @param string $css_class
	 * @param string $css_id
	 * @param string $css_style
	 * @param int $height Format: int32.
	 * @param int $position Format: int32.
	 * @param string $pagination
	 * @param ModelItemBlockLineVersionListResponse $modelItemBlockLineVersions
	 * @param ModelItemBlockCellListResponse $modelItemBlockCells
	 */
	public function __construct(ApiClient $apiClient, $id = null, $item_id = null, $css_class = null, $css_id = null, $css_style = null, $height = null, $position = null, $pagination = null, $modelItemBlockLineVersions = null, $modelItemBlockCells = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->item_id = $item_id;
		$this->css_class = $css_class;
		$this->css_id = $css_id;
		$this->css_style = $css_style;
		$this->height = $height;
		$this->position = $position;
		$this->pagination = $pagination;
		$this->modelItemBlockLineVersions = $modelItemBlockLineVersions;
		$this->modelItemBlockCells = $modelItemBlockCells;
	}
}
