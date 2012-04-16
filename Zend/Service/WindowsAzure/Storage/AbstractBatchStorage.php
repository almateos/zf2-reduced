<?php
/**
 * Zend2 Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend2
 * @package    Zend2_Service_WindowsAzure
 * @subpackage Storage
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @uses       Zend2_Http_Client
 * @uses       Zend2_Http_Response
 * @uses       Zend2_Service_WindowsAzure_Credentials_AbstractCredentials
 * @uses       Zend2_Service_WindowsAzure_Exception
 * @uses       Zend2_Service_WindowsAzure_Storage
 * @uses       Zend2_Service_WindowsAzure_Storage_Batch
 * @category   Zend2
 * @package    Zend2_Service_WindowsAzure
 * @subpackage Storage
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Zend2_Service_WindowsAzure_Storage_AbstractBatchStorage
    extends Zend2_Service_WindowsAzure_Storage
{	
    /**
     * Current batch
     * 
     * @var Zend2_Service_WindowsAzure_Storage_Batch
     */
    protected $_currentBatch = null;
    
    /**
     * Set current batch
     * 
     * @param Zend2_Service_WindowsAzure_Storage_Batch $batch Current batch
     * @throws Zend2_Service_WindowsAzure_Exception
     */
    public function setCurrentBatch(Zend2_Service_WindowsAzure_Storage_Batch $batch = null)
    {
        if ($batch !== null && $this->isInBatch()) {
            throw new Zend2_Service_WindowsAzure_Exception('Only one batch can be active at a time.');
        }
        $this->_currentBatch = $batch;
    }
    
    /**
     * Get current batch
     * 
     * @return Zend2_Service_WindowsAzure_Storage_Batch
     */
    public function getCurrentBatch()
    {
        return $this->_currentBatch;
    }
    
    /**
     * Is there a current batch?
     * 
     * @return boolean
     */
    public function isInBatch()
    {
        return $this->_currentBatch !== null;
    }
    
    /**
     * Starts a new batch operation set
     * 
     * @return Zend2_Service_WindowsAzure_Storage_Batch
     * @throws Zend2_Service_WindowsAzure_Exception
     */
    public function startBatch()
    {
        return new Zend2_Service_WindowsAzure_Storage_Batch($this, $this->getBaseUrl());
    }
	
	/**
	 * Perform batch using Zend2_Http_Client channel, combining all batch operations into one request
	 *
	 * @param array $operations Operations in batch
	 * @param boolean $forTableStorage Is the request for table storage?
	 * @param boolean $isSingleSelect Is the request a single select statement?
	 * @param string $resourceType Resource type
	 * @param string $requiredPermission Required permission
	 * @return Zend2_Http_Response
	 */
	public function performBatch($operations = array(), $forTableStorage = false, $isSingleSelect = false, $resourceType = Zend2_Service_WindowsAzure_Storage::RESOURCE_UNKNOWN, $requiredPermission = Zend2_Service_WindowsAzure_Credentials_AbstractCredentials::PERMISSION_READ)
	{
	    // Generate boundaries
	    $batchBoundary = 'batch_' . md5(time() . microtime());
	    $changesetBoundary = 'changeset_' . md5(time() . microtime());
	    
	    // Set headers
	    $headers = array();
	    
		// Add version header
		$headers['x-ms-version'] = $this->_apiVersion;
		
		// Add content-type header
		$headers['Content-Type'] = 'multipart/mixed; boundary=' . $batchBoundary;

		// Set path and query string
		$path           = '/$batch';
		$queryString    = '';
		
		// Set verb
		$httpVerb = Zend2_Http_Client::POST;
		
		// Generate raw data
    	$rawData = '';
    		
		// Single select?
		if ($isSingleSelect) {
		    $operation = $operations[0];
		    $rawData .= '--' . $batchBoundary . "\n";
            $rawData .= 'Content-Type: application/http' . "\n";
            $rawData .= 'Content-Transfer-Encoding: binary' . "\n\n";
            $rawData .= $operation; 
            $rawData .= '--' . $batchBoundary . '--';
		} else {
    		$rawData .= '--' . $batchBoundary . "\n";
    		$rawData .= 'Content-Type: multipart/mixed; boundary=' . $changesetBoundary . "\n\n";
    		
        		// Add operations
        		foreach ($operations as $operation)
        		{
                    $rawData .= '--' . $changesetBoundary . "\n";
                	$rawData .= 'Content-Type: application/http' . "\n";
                	$rawData .= 'Content-Transfer-Encoding: binary' . "\n\n";
                	$rawData .= $operation;
        		}
        		$rawData .= '--' . $changesetBoundary . '--' . "\n";
    		    		    
    		$rawData .= '--' . $batchBoundary . '--';
		}

		// Generate URL and sign request
		$requestUrl     = $this->_credentials->signRequestUrl($this->getBaseUrl() . $path . $queryString, $resourceType, $requiredPermission);
		$requestHeaders = $this->_credentials->signRequestHeaders($httpVerb, $path, $queryString, $headers, $forTableStorage, $resourceType, $requiredPermission);

		// Prepare request
		$this->_httpClientChannel->resetParameters(true);
		$this->_httpClientChannel->setUri($requestUrl);
		$this->_httpClientChannel->setHeaders($requestHeaders);
		$this->_httpClientChannel->setRawData($rawData);
		
		// Execute request
		$response = $this->_retryPolicy->execute(
		    array($this->_httpClientChannel, 'request'),
		    array($httpVerb)
		);

		return $response;
	}
}
