<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * I18nLangResponse resource class
 * 
 * @package Emonsite\Api\Resources
 */
class I18nLangResponse 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * @var I18nLang
	 */
	public $data;

	/**
	 * I18nLangResponse resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param I18nLang $data
	 */
	public function __construct(ApiClient $apiClient, $data = null)
	{
		$this->apiClient = $apiClient;
		$this->data = $data;
	}
}
