<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * ModelCategory resource class
 * 
 * @package Emonsite\Api\Resources
 */
class ModelCategory 
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
	public $parent_id;

	/**
	 * Format: int32.
	 * 
	 * @var int
	 */
	public $ordering;

	/**
	 * @var boolean
	 */
	public $published;

	/**
	 * @var boolean
	 */
	public $masked;

	/**
	 * @var object
	 */
	public $params;

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
	 * ModelCategory resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $model_id
	 * @param string $parent_id Format: ems-uuid.
	 * @param int $ordering Format: int32.
	 * @param boolean $published
	 * @param boolean $masked
	 * @param object $params
	 * @param string $add_dt Format: date-time.
	 * @param string $add_user_id Format: ems-uuid.
	 * @param string $upd_dt Format: date-time.
	 * @param string $upd_user_id Format: ems-uuid.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $model_id = null, $parent_id = null, $ordering = null, $published = null, $masked = null, $params = null, $add_dt = null, $add_user_id = null, $upd_dt = null, $upd_user_id = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->model_id = $model_id;
		$this->parent_id = $parent_id;
		$this->ordering = $ordering;
		$this->published = $published;
		$this->masked = $masked;
		$this->params = $params;
		$this->add_dt = $add_dt;
		$this->add_user_id = $add_user_id;
		$this->upd_dt = $upd_dt;
		$this->upd_user_id = $upd_user_id;
	}
	/**
	 * Site model category model category list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ModelCategoryListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteModelCategories($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/modelCategory/{modelCategoryId}/modelCategory';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{modelCategoryId}' => $this->id,
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

		$response = new ModelCategoryListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ModelCategory(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['model_id'], 
					$data['parent_id'], 
					$data['ordering'], 
					$data['published'], 
					$data['masked'], 
					$data['params'], 
					$data['add_dt'], 
					$data['add_user_id'], 
					$data['upd_dt'], 
					$data['upd_user_id']
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
	 * Site model category model category version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return ModelCategoryVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getSiteModelCategoryVersions($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/modelCategory/{modelCategoryId}/modelCategoryVersion';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{modelCategoryId}' => $this->id,
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

		$response = new ModelCategoryVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new ModelCategoryVersion(
					$this->apiClient, 
					$data['item_id'], 
					$data['lang'], 
					$data['name'], 
					$data['active'], 
					$data['seo_uri'], 
					$data['seo_title'], 
					$data['seo_keywords'], 
					$data['seo_description'], 
					$data['seo_image_id'], 
					$data['params'], 
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
}
