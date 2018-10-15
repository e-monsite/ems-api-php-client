<?php

namespace Emonsite\Api\Managers;

use Emonsite\Api\ApiClient;
use Emonsite\Api\Exceptions\UnexpectedResponseException;
use Emonsite\Api\Resources\ModelItemResponse;
use Emonsite\Api\Resources\ErrorResponse;
use Emonsite\Api\Resources\ModelItem;
use Emonsite\Api\Resources\ModelItemBlockLineListResponse;
use Emonsite\Api\Resources\ModelItemBlockLineVersionListResponse;
use Emonsite\Api\Resources\ModelItemBlockLineVersion;
use Emonsite\Api\Resources\Meta;
use Emonsite\Api\Resources\Pagination;
use Emonsite\Api\Resources\ModelItemBlockCellListResponse;
use Emonsite\Api\Resources\ModelItemBlockCell;
use Emonsite\Api\Resources\ModelItemBlockLine;
use Emonsite\Api\Resources\ItemHasCategoryResponse;
use Emonsite\Api\Resources\ItemHasCategory;
use Emonsite\Api\Resources\ItemHasCategoryListResponse;

/**
 * ModelItem manager class
 * 
 * @package Emonsite\Api\Managers
 */
class ModelItemManager 
{
	/**
	 * API client
	 *
	 * @var ApiClient
	 */
	protected $apiClient;

	/**
	 * ModelItem manager class constructor
	 *
	 * @param ApiClient $apiClient API Client to use for this manager requests
	 */
	public function __construct(ApiClient $apiClient)
	{
		$this->apiClient = $apiClient;
	}

	/**
	 * Return the API client used for this manager requests
	 *
	 * @return ApiClient
	 */
	public function getApiClient()
	{
		return $this->apiClient;
	}

	/**
	 * Get specified model item
	 * 
	 * Excepted HTTP code : 200
	 * 
	 * @param string $siteId Site ID
	 * @param string $moduleId Module ID
	 * @param string $modelId Model ID
	 * @param string $itemId Item ID
	 * 
	 * @return ModelItemResponse
	 * 
	 * @throws UnexpectedResponseException
	 */
	public function get($siteId, $moduleId, $modelId, $itemId)
	{
		$routePath = '/api/modelItem/{siteId},{moduleId},{modelId},{itemId}';

		$pathReplacements = [
			'{siteId}' => $siteId,
			'{moduleId}' => $moduleId,
			'{modelId}' => $modelId,
			'{itemId}' => $itemId,
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

		$response = new ModelItemResponse(
			$this->apiClient, 
			new ModelItem(
				$this->apiClient, 
				$requestBody['data']['id'], 
				$requestBody['data']['site_id'], 
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
				)) : null)
			)
		);

		return $response;
	}
}
