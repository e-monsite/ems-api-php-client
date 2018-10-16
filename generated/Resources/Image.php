<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * Image resource class
 * 
 * @package Emonsite\Api\Resources
 */
class Image 
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
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $parent_id;

	/**
	 * @var boolean
	 */
	public $published;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $publish_from;

	/**
	 * @var string
	 */
	public $storageserver_id;

	/**
	 * @var string
	 */
	public $privatefilepath;

	/**
	 * @var string
	 */
	public $privatefilename;

	/**
	 * @var string
	 */
	public $publicfilepath;

	/**
	 * @var string
	 */
	public $publicfilename;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $filesize;

	/**
	 * @var string
	 */
	public $mime;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $transaction_id;

	/**
	 * @var boolean
	 */
	public $cover;

	/**
	 * @var string
	 */
	public $emstorage_id;

	/**
	 * @var boolean
	 */
	public $trash;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $trash_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $trash_user_id;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $add_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $add_user_id;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $upd_dt;

	/**
	 * Format: ems-uuid.
	 * 
	 * @var string
	 */
	public $upd_user_id;

	/**
	 * @var ItemHasCategoryResponse
	 */
	public $mainItemHasCategory;

	/**
	 * @var ItemHasCategoryListResponse
	 */
	public $aliasItemHasCategories;

	/**
	 * Format: uri.
	 * 
	 * @var string
	 */
	public $item_url;

	/**
	 * Format: uri.
	 * 
	 * @var string
	 */
	public $image_url;

	/**
	 * Image resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $parent_id Format: ems-uuid.
	 * @param boolean $published
	 * @param int $publish_from Format: int32.
	 * @param string $storageserver_id
	 * @param string $privatefilepath
	 * @param string $privatefilename
	 * @param string $publicfilepath
	 * @param string $publicfilename
	 * @param int $filesize Format: int32.
	 * @param string $mime
	 * @param string $transaction_id Format: ems-uuid.
	 * @param boolean $cover
	 * @param string $emstorage_id
	 * @param boolean $trash
	 * @param int $trash_dt Format: int32.
	 * @param string $trash_user_id Format: ems-uuid.
	 * @param int $add_dt Format: int32.
	 * @param string $add_user_id Format: ems-uuid.
	 * @param int $upd_dt Format: int32.
	 * @param string $upd_user_id Format: ems-uuid.
	 * @param ItemHasCategoryResponse $mainItemHasCategory
	 * @param ItemHasCategoryListResponse $aliasItemHasCategories
	 * @param string $item_url Format: uri.
	 * @param string $image_url Format: uri.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $parent_id = null, $published = null, $publish_from = null, $storageserver_id = null, $privatefilepath = null, $privatefilename = null, $publicfilepath = null, $publicfilename = null, $filesize = null, $mime = null, $transaction_id = null, $cover = null, $emstorage_id = null, $trash = null, $trash_dt = null, $trash_user_id = null, $add_dt = null, $add_user_id = null, $upd_dt = null, $upd_user_id = null, $mainItemHasCategory = null, $aliasItemHasCategories = null, $item_url = null, $image_url = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->parent_id = $parent_id;
		$this->published = $published;
		$this->publish_from = $publish_from;
		$this->storageserver_id = $storageserver_id;
		$this->privatefilepath = $privatefilepath;
		$this->privatefilename = $privatefilename;
		$this->publicfilepath = $publicfilepath;
		$this->publicfilename = $publicfilename;
		$this->filesize = $filesize;
		$this->mime = $mime;
		$this->transaction_id = $transaction_id;
		$this->cover = $cover;
		$this->emstorage_id = $emstorage_id;
		$this->trash = $trash;
		$this->trash_dt = $trash_dt;
		$this->trash_user_id = $trash_user_id;
		$this->add_dt = $add_dt;
		$this->add_user_id = $add_user_id;
		$this->upd_dt = $upd_dt;
		$this->upd_user_id = $upd_user_id;
		$this->mainItemHasCategory = $mainItemHasCategory;
		$this->aliasItemHasCategories = $aliasItemHasCategories;
		$this->item_url = $item_url;
		$this->image_url = $image_url;
	}
	/**
	 * Site module Album image item version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ImageVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getImageVersions($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image/{imageId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{imageId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$queryParameters = [];

		if (!is_null($include)) {
			$queryParameters['include'] = $include;
		}

		if (!is_null($search)) {
			$queryParameters['search'] = $search;
		}

		if (!is_null($page)) {
			$queryParameters['page'] = $page;
		}

		if (!is_null($limit)) {
			$queryParameters['limit'] = $limit;
		}

		if (!is_null($order_by)) {
			$queryParameters['order_by'] = $order_by;
		}

		$requestOptions = [];
		$requestOptions['query'] = $queryParameters;

		$request = $this->apiClient->getHttpClient()->request('get', $routeUrl, $requestOptions);

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

		$response = new ImageVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ImageVersion(
					$this->apiClient, 
					$data['item_id'], 
					$data['lang'], 
					$data['active'], 
					$data['title'], 
					$data['content'], 
					$data['seo_uri'], 
					$data['seo_title'], 
					$data['seo_h1'], 
					$data['seo_keywords'], 
					$data['seo_description'], 
					$data['seo_image_id'], 
					$data['seo_additional_meta'], 
					$data['seo_no_index'], 
					$data['add_dt'], 
					$data['add_user_id']
				); 
			}, $requestBody['data']), 
			new Meta(
				$this->apiClient, 
				((isset($requestBody['meta']['pagination']) && !is_null($requestBody['meta']['pagination'])) ? (new Pagination(
					$this->apiClient, 
					$requestBody['meta']['pagination']['total'], 
					$requestBody['meta']['pagination']['count'], 
					$requestBody['meta']['pagination']['per_page'], 
					$requestBody['meta']['pagination']['current_page'], 
					$requestBody['meta']['pagination']['total_pages'], 
					$requestBody['meta']['pagination']['links']
				)) : null)
			)
		);

		return $response;
	}
	
	/**
	 * Create and store new module Album image item version
	 * 
	 * Excepted HTTP code : 201
	 * 
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
	 * @return ImageVersionResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function createImageVersion($lang, $active, $title, $content = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image/{imageId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{imageId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['lang'] = $lang;
		$bodyParameters['active'] = $active;
		$bodyParameters['title'] = $title;

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

		$request = $this->apiClient->getHttpClient()->request('post', $routeUrl, $requestOptions);

		if ($request->getStatusCode() != 201) {
			$requestBody = json_decode((string) $request->getBody(), true);

			$apiExceptionResponse = new ErrorResponse(
				$this->apiClient, 
				$requestBody['message'], 
				(isset($requestBody['errors']) ? $requestBody['errors'] : null), 
				(isset($requestBody['status_code']) ? $requestBody['status_code'] : null), 
				(isset($requestBody['debug']) ? $requestBody['debug'] : null)
			);

			throw new UnexpectedResponseException($request->getStatusCode(), 201, $request, $apiExceptionResponse);
		}

		$requestBody = json_decode((string) $request->getBody(), true);

		$response = new ImageVersionResponse(
			$this->apiClient, 
			new ImageVersion(
				$this->apiClient, 
				$requestBody['data']['item_id'], 
				$requestBody['data']['lang'], 
				$requestBody['data']['active'], 
				$requestBody['data']['title'], 
				$requestBody['data']['content'], 
				$requestBody['data']['seo_uri'], 
				$requestBody['data']['seo_title'], 
				$requestBody['data']['seo_h1'], 
				$requestBody['data']['seo_keywords'], 
				$requestBody['data']['seo_description'], 
				$requestBody['data']['seo_image_id'], 
				$requestBody['data']['seo_additional_meta'], 
				$requestBody['data']['seo_no_index'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id']
			)
		);

		return $response;
	}
	
	/**
	 * Get specified module Album image item version
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $lang Lang
	 * 
	 * @return ImageVersionResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getImageVersion($lang)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image/{imageId}/version/{lang}';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{imageId}' => $this->id,
			'{lang}' => $lang,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$requestOptions = [];

		$request = $this->apiClient->getHttpClient()->request('get', $routeUrl, $requestOptions);

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

		$response = new ImageVersionResponse(
			$this->apiClient, 
			new ImageVersion(
				$this->apiClient, 
				$requestBody['data']['item_id'], 
				$requestBody['data']['lang'], 
				$requestBody['data']['active'], 
				$requestBody['data']['title'], 
				$requestBody['data']['content'], 
				$requestBody['data']['seo_uri'], 
				$requestBody['data']['seo_title'], 
				$requestBody['data']['seo_h1'], 
				$requestBody['data']['seo_keywords'], 
				$requestBody['data']['seo_description'], 
				$requestBody['data']['seo_image_id'], 
				$requestBody['data']['seo_additional_meta'], 
				$requestBody['data']['seo_no_index'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id']
			)
		);

		return $response;
	}
	
	/**
	 * Update a specified module Album image item version
	 * 
	 * Excepted HTTP code : 200
	 * 
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
	public function update($lang, $active, $title = null, $content = null, $seo_uri = null, $seo_title = null, $seo_h1 = null, $seo_keywords = null, $seo_description = null, $seo_image_id = null, $seo_additional_meta = null, $seo_no_index = null)
	{
		$routePath = '/api/site/{siteId}/module/album/model/image/{imageId}/version/{lang}';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{imageId}' => $this->id,
			'{lang}' => $lang,
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
