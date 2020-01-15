<?php
use CRM_Cluster_ExtensionUtil as E;

/**
 * EntityCluster.Delete API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_entity_cluster_delete_spec(&$spec) {
  $spec['id'] = array(
    'name' => 'id',
    'title' => 'id',
    'type' => CRM_Utils_Type::T_INT,
    'api.required' => 1
  );
}

/**
 * EntityCluster.Delete API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_entity_cluster_delete($params) {
  return civicrm_api3_create_success(CRM_Cluster_BAO_EntityCluster::remove($params), $params, 'EntityCluster', 'Delete');
}
