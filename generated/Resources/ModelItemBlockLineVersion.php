<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelItemBlockLineVersion resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelItemBlockLineVersion 
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
	public $block_line_id;

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
	 * ModelItemBlockLineVersion resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $block_line_id Format: ems-uuid.
	 * @param string $lang Format: ems-lang.
	 * @param string $title
	 */
	public function __construct(ApiClient $apiClient, $id = null, $block_line_id = null, $lang = null, $title = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->block_line_id = $block_line_id;
		$this->lang = $lang;
		$this->title = $title;
	}
}
