<?php
use CRM_Cluster_ExtensionUtil as E;

/**
 * Cluster.Create API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_cluster_create_spec(&$spec) {
  $spec['id'] = array(
    'name' => 'id',
    'title' => 'id',
    'type' => CRM_Utils_Type::T_INT
  );
  $spec['name'] = array(
    'name' => 'name',
    'title' => 'name',
    'type' => CRM_Utils_Type::T_STRING,
    'api.required' => 1
  );
  $spec['label'] = array(
    'name' => 'label',
    'title' => 'label',
    'type' => CRM_Utils_Type::T_STRING,
    'api.required' => 1
  );
  $spec['is_active'] = array(
    'name' => 'is_active',
    'title' => 'is_active',
    'type' => CRM_Utils_Type::T_INT,
    'api.required' => 1
  );
  $spec['country_id'] = array(
    'name' => 'country_id',
    'title' => 'country_id',
    'type' => CRM_Utils_Type::T_INT,
    'api.required' => 1
  );
}

/**
 * Cluster.Create API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_cluster_create($params) {
  return civicrm_api3_create_success(CRM_Cluster_BAO_Cluster::add($params), $params, 'Cluster', 'Create');
}
