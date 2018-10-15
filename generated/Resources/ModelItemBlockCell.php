<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelItemBlockCell resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelItemBlockCell 
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
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $width;

	/**
	 * @var string
	 */
	public $content_type;

	/**
	 * Format: ems-widgetid.
	 * 
	 * @var string
	 */
	public $widget_id;

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
	public $position;

	/**
	 * ModelItemBlockCell resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $block_line_id Format: ems-uuid.
	 * @param int $width Format: int32.
	 * @param string $content_type
	 * @param string $widget_id Format: ems-widgetid.
	 * @param string $css_class
	 * @param string $css_id
	 * @param string $css_style
	 * @param int $position Format: int32.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $block_line_id = null, $width = null, $content_type = null, $widget_id = null, $css_class = null, $css_id = null, $css_style = null, $position = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->block_line_id = $block_line_id;
		$this->width = $width;
		$this->content_type = $content_type;
		$this->widget_id = $widget_id;
		$this->css_class = $css_class;
		$this->css_id = $css_id;
		$this->css_style = $css_style;
		$this->position = $position;
	}
}
