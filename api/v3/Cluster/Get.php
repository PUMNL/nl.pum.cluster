<?php
use CRM_Cluster_ExtensionUtil as E;

/**
 * Cluster.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_cluster_get_spec(&$spec) {
  $spec['id'] = array(
    'name' => 'id',
    'title' => 'id',
    'type' => CRM_Utils_Type::T_INT,
    'api.required' => 0
  );
  $spec['name'] = array(
    'name' => 'name',
    'title' => 'name',
    'type' => CRM_Utils_Type::T_STRING,
    'api.required' => 0
  );
  $spec['label'] = array(
    'name' => 'label',
    'title' => 'label',
    'type' => CRM_Utils_Type::T_STRING,
    'api.required' => 0
  );
  $spec['is_active'] = array(
    'name' => 'is_active',
    'title' => 'is_active',
    'type' => CRM_Utils_Type::T_BOOLEAN,
    'api.required' => 0
  );
  $spec['countries'] = array(
    'name' => 'countries',
    'title' => 'countries',
    'type' => CRM_Utils_Type::T_STRING,
    'api.required' => 0
  );
}

/**
 * Cluster.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_cluster_get($params) {
    $returnValues = CRM_Cluster_BAO_Cluster::getValues($params);

    foreach($returnValues as $key => $value){
      if(!empty($returnValues[$key]['countries'])){
        $returnValues[$key]['countries'] = @unserialize($returnValues[$key]['countries']);
      }

      if(!empty($params['countries'])){

        if(is_int((int)$params['countries'])) {
          $countries = array();
          $countries[] = $params['countries'];
        } else if(is_array($params['countries'])){
          $countries = array();
          foreach($params['countries'] as $country_key => $country_id) {
            if(is_int($country_id)){
              $returnValues[$key]['countries'][] = $country_id;
            }
          }
        } else if(strpos($params['countries'],',')){
          $countries = array();
          $countries = explode(',',$params['countries']);
          foreach($countries as $country_key => $country_id) {
            if(is_int($country_id)){
              $returnValues[$key]['countries'][] = $country_id;
            }
          }
        }
        $returnValues[$key]['countries'] = $countries;
      }

    }

    return civicrm_api3_create_success($returnValues, $params, 'Cluster', 'Get');
}

