<?php

namespace Emonsite\Api\Tests;

use PHPUnit\Framework\TestCase;
use Emonsite\Api\ApiClient;

/**
 * ems-api client test class (test for version 1.0)
 * 
 * @package Emonsite\Api\Tests
 */
class ApiClientTest extends TestCase
{
	public function testCanCreateClient()
	{
		$apiClient = new ApiClient(
			getenv('bearerToken'),
			getenv('apiBaseUrl')
		);

		$this->assertNotNull(
			$apiClient->getHttpClient()
		);
	}
}