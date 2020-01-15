<?php
use CRM_Cluster_ExtensionUtil as E;

class CRM_Cluster_Page_Clusterlist extends CRM_Core_Page {

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Clusterlist'));

    $params = array();
    $countries_params = array();
    $countries = array();
    $clusters = CRM_Cluster_BAO_Cluster::getValues($params);

    foreach($clusters as $key => $cluster) {
      $countries_params = array();

      $params = array(
        'version' => 3,
        'sequential' => 1,
        'id' => $cluster['country_id'],
      );
      $countries_params[$cluster['country_id']] = civicrm_api('Country', 'getsingle', $params);

      $clusters[$key]['countries'] = $countries_params;
    }

    $this->assign('clusters', $clusters);

    parent::run();
  }

}
