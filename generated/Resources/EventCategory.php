<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * EventCategory resource class
 * 
 * @package Emonsite\Api\Resources
 */
class EventCategory 
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
	 * EventCategory resource class constructor
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
	 * Site module Agenda event category version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return EventCategoryVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEventCategoryVersions($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/category/event/{eventCategoryId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{eventCategoryId}' => $this->id,
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

		$response = new EventCategoryVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new EventCategoryVersion(
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
	
	/**
	 * Site module Agenda event category event list
	 * 
	 * You can specify a GET parameters `published` and/or `trash` to filter results.
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return EventListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEvents($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/category/event/{eventCategoryId}/event';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{eventCategoryId}' => $this->id,
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

		$response = new EventListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new Event(
					$this->apiClient, 
					$data['id'], 
					$data['site_id'], 
					$data['parent_id'], 
					$data['published'], 
					$data['publish_from'], 
					$data['publish_to'], 
					$data['date_start'], 
					$data['date_end'], 
					$data['hour'], 
					$data['hour_end'], 
					$data['website'], 
					$data['contact'], 
					$data['recurrent'], 
					$data['is_recurrent'], 
					$data['recurrent_end'], 
					$data['organizer_id'], 
					$data['trash'], 
					$data['trash_dt'], 
					$data['trash_user_id'], 
					$data['add_dt'], 
					$data['add_user_id'], 
					$data['upd_dt'], 
					$data['upd_user_id'], 
					((isset($data['modelItemBlockLines']) && !is_null($data['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
						$this->apiClient, 
						array_map(function($data) {
							return new ModelItemBlockLine(
								$this->apiClient, 
								$data['id'], 
								$data['item_id'], 
								$data['css_class'], 
								$data['css_id'], 
								$data['css_style'], 
								$data['height'], 
								$data['position'], 
								$data['pagination'], 
								((isset($data['modelItemBlockLineVersions']) && !is_null($data['modelItemBlockLineVersions'])) ? (new ModelItemBlockLineVersionListResponse(
									$this->apiClient, 
									array_map(function($data) {
										return new ModelItemBlockLineVersion(
											$this->apiClient, 
											$data['id'], 
											$data['block_line_id'], 
											$data['lang'], 
											$data['title']
										); 
									}, $requestBody['modelItemBlockLineVersions']['data']), 
									new Meta(
										$this->apiClient, 
										((isset($data['modelItemBlockLineVersions']['meta']['pagination']) && !is_null($data['modelItemBlockLineVersions']['meta']['pagination'])) ? (new Pagination(
											$this->apiClient, 
											$data['modelItemBlockLineVersions']['meta']['pagination']['total'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['count'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['per_page'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['current_page'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['total_pages'], 
											$data['modelItemBlockLineVersions']['meta']['pagination']['links']
										)) : null)
									)
								)) : null), 
								((isset($data['modelItemBlockCells']) && !is_null($data['modelItemBlockCells'])) ? (new ModelItemBlockCellListResponse(
									$this->apiClient, 
									array_map(function($data) {
										return new ModelItemBlockCell(
											$this->apiClient, 
											$data['id'], 
											$data['block_line_id'], 
											$data['width'], 
											$data['content_type'], 
											$data['widget_id'], 
											$data['css_class'], 
											$data['css_id'], 
											$data['css_style'], 
											$data['position']
										); 
									}, $requestBody['modelItemBlockCells']['data']), 
									new Meta(
										$this->apiClient, 
										((isset($data['modelItemBlockCells']['meta']['pagination']) && !is_null($data['modelItemBlockCells']['meta']['pagination'])) ? (new Pagination(
											$this->apiClient, 
											$data['modelItemBlockCells']['meta']['pagination']['total'], 
											$data['modelItemBlockCells']['meta']['pagination']['count'], 
											$data['modelItemBlockCells']['meta']['pagination']['per_page'], 
											$data['modelItemBlockCells']['meta']['pagination']['current_page'], 
											$data['modelItemBlockCells']['meta']['pagination']['total_pages'], 
											$data['modelItemBlockCells']['meta']['pagination']['links']
										)) : null)
									)
								)) : null)
							); 
						}, $requestBody['modelItemBlockLines']['data']), 
						new Meta(
							$this->apiClient, 
							((isset($data['modelItemBlockLines']['meta']['pagination']) && !is_null($data['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
								$this->apiClient, 
								$data['modelItemBlockLines']['meta']['pagination']['total'], 
								$data['modelItemBlockLines']['meta']['pagination']['count'], 
								$data['modelItemBlockLines']['meta']['pagination']['per_page'], 
								$data['modelItemBlockLines']['meta']['pagination']['current_page'], 
								$data['modelItemBlockLines']['meta']['pagination']['total_pages'], 
								$data['modelItemBlockLines']['meta']['pagination']['links']
							)) : null)
						)
					)) : null), 
					((isset($data['mainItemHasCategory']) && !is_null($data['mainItemHasCategory'])) ? (new ItemHasCategoryResponse(
						$this->apiClient, 
						new ItemHasCategory(
							$this->apiClient, 
							$data['mainItemHasCategory']['data']['id'], 
							$data['mainItemHasCategory']['data']['site_id'], 
							$data['mainItemHasCategory']['data']['model_id'], 
							$data['mainItemHasCategory']['data']['item_id'], 
							$data['mainItemHasCategory']['data']['parent_id'], 
							$data['mainItemHasCategory']['data']['ordering'], 
							$data['mainItemHasCategory']['data']['add_dt'], 
							$data['mainItemHasCategory']['data']['add_user_id'], 
							$data['mainItemHasCategory']['data']['upd_dt'], 
							$data['mainItemHasCategory']['data']['upd_user_id']
						)
					)) : null), 
					((isset($data['aliasItemHasCategories']) && !is_null($data['aliasItemHasCategories'])) ? (new ItemHasCategoryListResponse(
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
						}, $requestBody['aliasItemHasCategories']['data']), 
						new Meta(
							$this->apiClient, 
							((isset($data['aliasItemHasCategories']['meta']['pagination']) && !is_null($data['aliasItemHasCategories']['meta']['pagination'])) ? (new Pagination(
								$this->apiClient, 
								$data['aliasItemHasCategories']['meta']['pagination']['total'], 
								$data['aliasItemHasCategories']['meta']['pagination']['count'], 
								$data['aliasItemHasCategories']['meta']['pagination']['per_page'], 
								$data['aliasItemHasCategories']['meta']['pagination']['current_page'], 
								$data['aliasItemHasCategories']['meta']['pagination']['total_pages'], 
								$data['aliasItemHasCategories']['meta']['pagination']['links']
							)) : null)
						)
					)) : null), 
					$data['item_url']
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
	 * Site module Agenda event category event category list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return EventCategoryListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getEventCategories($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/agenda/category/event/{eventCategoryId}/category';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{eventCategoryId}' => $this->id,
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

		$response = new EventCategoryListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new EventCategory(
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
}
