<?php

namespace Emonsite\Api\Resources;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;

/**
 * Page resource class
 * 
 * @package Emonsite\Api\Resources
 */
class Page 
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
	public $is_pageindex;

	/**
	 * @var boolean
	 */
	public $published;

	/**
	 * Format: date-time.
	 * 
	 * @var string
	 */
	public $publish_from;

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
	 * @var ModelItemBlockLineListResponse
	 */
	public $modelItemBlockLines;

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
	 * Page resource class constructor
	 * 
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 * @param string $id Format: ems-uuid.
	 * @param string $site_id Format: ems-uuid.
	 * @param string $parent_id Format: ems-uuid.
	 * @param boolean $is_pageindex
	 * @param boolean $published
	 * @param string $publish_from Format: date-time.
	 * @param boolean $trash
	 * @param int $trash_dt Format: int32.
	 * @param string $trash_user_id Format: ems-uuid.
	 * @param int $add_dt Format: int32.
	 * @param string $add_user_id Format: ems-uuid.
	 * @param int $upd_dt Format: int32.
	 * @param string $upd_user_id Format: ems-uuid.
	 * @param ModelItemBlockLineListResponse $modelItemBlockLines
	 * @param ItemHasCategoryResponse $mainItemHasCategory
	 * @param ItemHasCategoryListResponse $aliasItemHasCategories
	 * @param string $item_url Format: uri.
	 */
	public function __construct(ApiClient $apiClient, $id = null, $site_id = null, $parent_id = null, $is_pageindex = null, $published = null, $publish_from = null, $trash = null, $trash_dt = null, $trash_user_id = null, $add_dt = null, $add_user_id = null, $upd_dt = null, $upd_user_id = null, $modelItemBlockLines = null, $mainItemHasCategory = null, $aliasItemHasCategories = null, $item_url = null)
	{
		$this->apiClient = $apiClient;
		$this->id = $id;
		$this->site_id = $site_id;
		$this->parent_id = $parent_id;
		$this->is_pageindex = $is_pageindex;
		$this->published = $published;
		$this->publish_from = $publish_from;
		$this->trash = $trash;
		$this->trash_dt = $trash_dt;
		$this->trash_user_id = $trash_user_id;
		$this->add_dt = $add_dt;
		$this->add_user_id = $add_user_id;
		$this->upd_dt = $upd_dt;
		$this->upd_user_id = $upd_user_id;
		$this->modelItemBlockLines = $modelItemBlockLines;
		$this->mainItemHasCategory = $mainItemHasCategory;
		$this->aliasItemHasCategories = $aliasItemHasCategories;
		$this->item_url = $item_url;
	}
	/**
	 * Update a specified module Pages page item
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param boolean $is_pageindex
	 * @param boolean $published
	 * @param string $parent_id
	 * @param int $publish_from
	 * @param boolean $trash
	 * @param int $trash_dt
	 * @param string $trash_user_id
	 * 
	 * @return PageResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function update($is_pageindex, $published, $parent_id = null, $publish_from = null, $trash = null, $trash_dt = null, $trash_user_id = null)
	{
		$routePath = '/api/site/{siteId}/module/pages/model/page/{pageId}';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{pageId}' => $this->id,
		];

		$routeUrl = str_replace(array_keys($pathReplacements), array_values($pathReplacements), $routePath);

		$bodyParameters = [];
		$bodyParameters['is_pageindex'] = $is_pageindex;
		$bodyParameters['published'] = $published;

		if (!is_null($parent_id)) {
			$bodyParameters['parent_id'] = $parent_id;
		}

		if (!is_null($publish_from)) {
			$bodyParameters['publish_from'] = $publish_from;
		}

		if (!is_null($trash)) {
			$bodyParameters['trash'] = $trash;
		}

		if (!is_null($trash_dt)) {
			$bodyParameters['trash_dt'] = $trash_dt;
		}

		if (!is_null($trash_user_id)) {
			$bodyParameters['trash_user_id'] = $trash_user_id;
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

		$response = new PageResponse(
			$this->apiClient, 
			new Page(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
				$requestBody['data']['parent_id'], 
				$requestBody['data']['is_pageindex'], 
				$requestBody['data']['published'], 
				$requestBody['data']['publish_from'], 
				$requestBody['data']['trash'], 
				$requestBody['data']['trash_dt'], 
				$requestBody['data']['trash_user_id'], 
				$requestBody['data']['add_dt'], 
				$requestBody['data']['add_user_id'], 
				$requestBody['data']['upd_dt'], 
				$requestBody['data']['upd_user_id'], 
				((isset($requestBody['data']['modelItemBlockLines']) && !is_null($requestBody['data']['modelItemBlockLines'])) ? (new ModelItemBlockLineListResponse(
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
					}, $requestBody['data']['modelItemBlockLines']['data']), 
					new Meta(
						$this->apiClient, 
						((isset($requestBody['data']['modelItemBlockLines']['meta']['pagination']) && !is_null($requestBody['data']['modelItemBlockLines']['meta']['pagination'])) ? (new Pagination(
							$this->apiClient, 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['count'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['per_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['current_page'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['total_pages'], 
							$requestBody['data']['modelItemBlockLines']['meta']['pagination']['links']
						)) : null)
					)
				)) : null), 
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
				(isset($requestBody['data']['item_url']) ? $requestBody['data']['item_url'] : null)
			)
		);

		return $response;
	}
	
	/**
	 * Site module Pages page item version list
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $include Include responses : {include1},{include2,{include3}[...]
	 * @param string $search Search words
	 * @param int $page Format: int32. Pagination : Page number
	 * @param int $limit Format: int32. Pagination : Maximum entries per page
	 * @param string $order_by Order by : {field},[asc|desc]
	 * 
	 * @return PageVersionListResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getPageVersions($include = null, $search = null, $page = null, $limit = null, $order_by = null)
	{
		$routePath = '/api/site/{siteId}/module/pages/model/page/{pageId}/version';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{pageId}' => $this->id,
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

		$response = new PageVersionListResponse(
			$this->apiClient, 
			array_map(function($data) {
				return new PageVersion(
					$this->apiClient, 
					$data['item_id'], 
					$data['lang'], 
					$data['active'], 
					$data['title'], 
					$data['titlemenu'], 
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
	 * Get specified module Pages page item version
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $lang Lang
	 * 
	 * @return PageVersionResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function getPageVersion($lang)
	{
		$routePath = '/api/site/{siteId}/module/pages/model/page/{pageId}/version/{lang}';

		$pathReplacements = [
			'{siteId}' => $this->site_id,
			'{pageId}' => $this->id,
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

		$response = new PageVersionResponse(
			$this->apiClient, 
			new PageVersion(
				$this->apiClient, 
				$requestBody['data']['item_id'], 
				$requestBody['data']['lang'], 
				$requestBody['data']['active'], 
				$requestBody['data']['title'], 
				$requestBody['data']['titlemenu'], 
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
}
