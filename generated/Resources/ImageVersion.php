<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ImageVersion resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ImageVersion 
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
	 * ImageVersion resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $item_id Format: ems-uuid.
	 * @param string $lang Format: ems-lang.
	 * @param boolean $active
	 * @param string $title
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
	public function __construct(ApiClient $apiClient, $item_id = null, $lang = null, $active = null, $title = null, $content = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null, $add_dt = null, $add_user_id = null)
	{
		$this->apiClient = $apiClient;
		$this->item_id = $item_id;
		$this->lang = $lang;
		$this->active = $active;
		$this->title = $title;
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
	/**
	 * Update a specified module Album image item version
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $imageId Image ID
	 * @param string $lang
	 * @param boolean $active
	 * @param string $title
	 * @param string $content
	 * @param string $seo_uri
	 * @param string $seo_title
	 * @param string $seo_h1
	 * @param string $seo_keywords
	 * @param string $seo_description
	 * @param string $seo_image_id
	 * @param string $seo_additional_meta
	 * @param boolean $seo_no_index
	 * 
	 * @return ImageResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function update($siteId, $imageId, $lang, $active, $title = null, $content = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image/{imageId}/version/{lang}';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{imageId}' => $imageId,
			'{lang}' => $this->lang,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['lang'] = $lang;
		$bodyParameters['active'] = $active;

		if (!is_null($title)) {
			$bodyParameters['title'] = $title;
		}

		if (!is_null($content)) {
			$bodyParameters['content'] = $content;
		}

		if (!is_null($seo_uri)) {
			$bodyParameters['seo_uri'] = $seo_uri;
		}

		if (!is_null($seo_title)) {
			$bodyParameters['seo_title'] = $seo_title;
		}

		if (!is_null($seo_h1)) {
			$bodyParameters['seo_h1'] = $seo_h1;
		}

		if (!is_null($seo_keywords)) {
			$bodyParameters['seo_keywords'] = $seo_keywords;
		}

		if (!is_null($seo_description)) {
			$bodyParameters['seo_description'] = $seo_description;
		}

		if (!is_null($seo_image_id)) {
			$bodyParameters['seo_image_id'] = $seo_image_id;
		}

		if (!is_null($seo_additional_meta)) {
			$bodyParameters['seo_additional_meta'] = $seo_additional_meta;
		}

		if (!is_null($seo_no_index)) {
			$bodyParameters['seo_no_index'] = $seo_no_index;
		}

		$requestOptions = [];
		$requestOptions['form_params'] = $bodyParameters;

		$request = $this->apiClient->getHttpClient()->request('patch', $routeUrl, $requestOptions);

		if ($request->getStatusCode() != 200) {
			$requestBody = json_decode((string) $request->getBody(), true);

			$apiExceptionResponse = new ErrorResponse(
				$this->apiClient, 
				$requestBody['message'], 
				(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
				(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
				(isset($requestBody['debug']) ? $requestBody['debug'] : null)
			);

			throw new UnexpectedResponseException($request->getStatusCode(), 200, $request, $apiExceptionResponse);
		}

		$requestBody = json_decode((string) $request->getBody(), true);

		$response = new ImageResponse(
			$this->apiClient, 
			new Image(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['storageserver_id'], 
				$requestBody['data']['privatefilepath'], 
				$requestBody['data']['privatefilename'], 
				$requestBody['data']['publicfilepath'], 
				$requestBody['data']['publicfilename'], 
				$requestBody['data']['filesize'], 
				$requestBody['data']['mime'], 
				$requestBody['data']['transaction_id'], 
				$requestBody['data']['cover'], 
				$requestBody['data']['emstorage_id'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['mainItemHasCategory']) && !is_null($requestBody['data']['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
					$this->apiClient, 
					new ItemHasCategory(
						$this->apiClient, 
						$requestBody['data']['mainItemHasCategory']['data']['id'], 
						$requestBody['data']['mainItemHasCategory']['data']['site_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['model_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['item_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['parent_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['ordering'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['add_user_id'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_dt'], 
						$requestBody['data']['mainItemHasCategory']['data']['upd_user_id']
					)
				)) : null), 
				((isset($requestBody['data']['aliasItemHasCategories']) && !is_null($requestBody['data']['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
					$this->apiClient, 
					array_map(function($data) {
						return new ItemHasCategory(
							$this->apiClient, 
							$data['id'], 
							$data['site_id'], 
							$data['model_id'], 
							$data['item_id'], 
							$data['parent_id'], 
							$data['ordering'], 
							$data['add_dt'], 
							$data['add_user_id'], 
							$data['upd_dt'], 
							$data['upd_user_id']
						); 
					}, $requestBody['data']['aliasItemHasCategories']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['aliasItemHasCategories']['meta']['pagination']) && !is_null($requestBody['data']['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['count'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['per_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['current_page'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
							$requestBody['data']['aliasItemHasCategories']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
				$requestBody['data']['item_url'], 
				$requestBody['data']['image_url']
			)
		);

		return $response;
	}
}
