<?php
use CRM_Cluster_ExtensionUtil as E;

/**
 * EntityCluster.Create API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_entity_cluster_create_spec(&$spec) {
  $spec['id'] = array(
    'name' => 'id',
    'title' => 'id',
    'type' => CRM_Utils_Type::T_INT
  );
  $spec['entity_type'] = array(
    'name' => 'entity_type',
    'title' => 'entity_type',
    'type' => CRM_Utils_Type::T_STRING,
    'api.required' => 1
  );
  $spec['entity_id'] = array(
    'name' => 'entity_id',
    'title' => 'entity_id',
    'type' => CRM_Utils_Type::T_INT,
    'api.required' => 1
  );
  $spec['cluster_id'] = array(
    'name' => 'cluster_id',
    'title' => 'cluster_id',
    'type' => CRM_Utils_Type::T_INT,
    'api.required' => 1
  );
}

/**
 * EntityCluster.Create API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_entity_cluster_create($params) {
  return civicrm_api3_create_success(CRM_Cluster_BAO_EntityCluster::add($params), $params, 'EntityCluster', 'Create');
}
