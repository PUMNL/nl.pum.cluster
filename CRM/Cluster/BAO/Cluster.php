<?php
class CRM_Cluster_BAO_Cluster extends CRM_Cluster_DAO_Cluster {
  /**
   * Function to get values
   *
   * @return array $result found rows with data
   * @access public
   * @static
   */
  public static function getValues($params) {
    $result = array();
    $cluster = new CRM_Cluster_BAO_Cluster();
    if (!empty($params)) {
      $fields = self::fields();
      foreach ($params as $key => $value) {
        if (isset($fields[$key])) {
          $cluster->$key = $value;
        }
      }
    }
    $cluster->find();
    while ($cluster->fetch()) {
      $row = array();
      CRM_Core_DAO::storeValues($cluster, $row);
      $result[$row['id']] = $row;
    }
    return $result;
  }
  /**
   * Function to add or update doorloopnorm
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
      throw new Exception('Params can not be empty when adding or updating a Cluster');
    }

    if (is_numeric($params['id'])) {
      CRM_Utils_Hook::pre('edit', 'Cluster', $params['id'], $params);
    }
    else {
      CRM_Utils_Hook::pre('create', 'Cluster', NULL, $params);
    }

    $cluster = new CRM_Cluster_BAO_Cluster();
    $fields = self::fields();
    foreach ($params as $key => $value) {
      if (isset($fields[$key])) {
        $cluster->$key = $value;
      }
    }
    $cluster->save();
    CRM_Core_DAO::storeValues($cluster, $result);

    if (is_numeric($params['id'])) {
      CRM_Utils_Hook::post('edit', 'Cluster', $params['id'], $cluster);
    }
    else {
      CRM_Utils_Hook::post('create', 'Cluster', NULL, $cluster);
    }

    return $result;
  }
}