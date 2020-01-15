<?php
class CRM_Cluster_BAO_EntityCluster extends CRM_Cluster_DAO_EntityCluster {
  /**
   * Function to get values
   *
   * @return array $result found rows with data
   * @access public
   * @static
   */
  public static function getValues($params) {
    $result = array();
    $entityCluster = new CRM_Cluster_BAO_EntityCluster();
    if (!empty($params)) {
      $fields = self::fields();
      foreach ($params as $key => $value) {
        if (isset($fields[$key])) {
          $entityCluster->$key = $value;
        }
      }
    }
    $entityCluster->find();

    while ($entityCluster->fetch()) {
      $row = array();
      $result[$entityCluster->id] = array('entity_id' => $entityCluster->entity_id,'entity_type' => $entityCluster->entity_type,'cluster_id' => $entityCluster->cluster_id);
    }

    return $result;
  }

  /**
   * Function to add or update entitycluster
   *
   * @param array $params
   * @return array $result
   * @access public
   * @throws Exception when params is empty
   * @static
   */
  public static function add($params) {
    $result = array();

    if (empty($params)) {
      throw new Exception('Params can not be empty when adding or updating a entity cluster');
    }

    if (!empty($params['id']) && is_numeric($params['id'])) {
      CRM_Utils_Hook::pre('edit', 'EntityCluster', $params['id'], $params);
    } else {
      CRM_Utils_Hook::pre('create', 'EntityCluster', NULL, $params);
    }

    $entityCluster = new CRM_Cluster_BAO_EntityCluster();
    $fields = self::fields();
    foreach ($params as $key => $value) {
      if (isset($fields[$key])) {
        $entityCluster->$key = $value;
      }
    }
    $entityCluster->save();
    CRM_Core_DAO::storeValues($entityCluster, $result);

    if (is_numeric($params['id']) && $params['id'] > 0) {
      CRM_Utils_Hook::post('edit', 'EntityCluster', $entityCluster->id, $params);
    }
    else {
      CRM_Utils_Hook::post('create', 'EntityCluster', $entityCluster->id, $params);
    }
    $result['params'] = $params;
    return $result;
  }

  public static function remove($params) {
    if (!empty($params['id']) && is_numeric($params['id'])) {
      CRM_Utils_Hook::pre('delete', 'EntityCluster', $params['id'], $params);
    }

    $entityCluster = new CRM_Cluster_BAO_EntityCluster();
    $fields = self::fields();
    foreach ($params as $key => $value) {
      if (isset($fields[$key])) {
        $entityCluster->$key = $value;
      }
    }
    $entityCluster->delete();
    CRM_Core_DAO::storeValues($entityCluster, $result);

    if (is_numeric($params['id']) && $params['id'] > 0) {
      CRM_Utils_Hook::post('delete', 'EntityCluster', $entityCluster->id, $params);
    }
  }
}