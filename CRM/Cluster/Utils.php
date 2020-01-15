<?php
class CRM_Cluster_Utils {

  protected static $_singleton;

  /**
   * @return CRM_Cluster_Utils
   */
  public static function singleton() {
    if (!self::$_singleton) {
      self::$_singleton = new CRM_Cluster_Utils;
    }
    return self::$_singleton;
  }

  /**
   * Method to determine max key in navigation menu (core solutions do not cater for child keys!)
   *
   * @param array $menuItems
   * @return int $maxKey
   */
  public static function getMaxMenuKey($menuItems) {
    $maxKey = 0;
    foreach ($menuItems as $menuKey => $menuItem) {
      if ($menuKey > $maxKey) {
        $maxKey = $menuKey;
      }
      if (isset($menuItem['child'])) {
        foreach ($menuItem['child'] as $childKey => $child) {
          if ($childKey > $maxKey) {
            $maxKey = $childKey;
          }
        }
      }
    }
    return $maxKey;
  }

  /**
   * Method to get list of clusters
   *
   * @param $active - 1 = active clusters, 0 = inactive clusters
   * @param $country_id - Add country_id to only get the list of clusters for that country
   *
   * @return array of clusters with cluster id & cluster label
   *
   * @throws CiviCRM_API3_Exception
   */
  public static function getList($active=1,$country_id='') {
    $clusterList = array();

    try{
      if($active == 1) {
        if(!empty($country_id)){
          $clusters = civicrm_api('Cluster', 'get', array('version' => 3, 'sequential' => 1, 'is_active' => $active, 'country_id' => $country_id));
        } else {
          $clusters = civicrm_api('Cluster', 'get', array('version' => 3,'sequential' => 1, 'is_active' => $active));
        }
      } else {
        if(!empty($country_id)){
          $clusters = civicrm_api('Cluster', 'get', array('version' => 3,'sequential' => 1, 'is_active' => 0, 'country_id'=>$country_id));
        } else {
          $clusters = civicrm_api('Cluster', 'get', array('version' => 3,'sequential' => 1, 'is_active' => 0));
        }
      }

      foreach ($clusters['values'] as $key => $cluster) {
        if (isset($cluster['label']) && isset($cluster['id'])) {
          $clusterList[$cluster['id']] = $cluster['label'];
        }
      }
    } catch(Exception $e) {
      $clusterList = array();
      CRM_Core_Error::debug_log_message($e->getCode() & " - " & $e->getMessage(), FALSE);
    }

    //asort($clusterList);
    //array_unshift($clusterList,'- select -');
    return $clusterList;
  }

  public static function getCustomGroup($custom_group_name){
    return civicrm_api3('CustomGroup', 'getsingle', array('name' => $custom_group_name));
  }
}
?>