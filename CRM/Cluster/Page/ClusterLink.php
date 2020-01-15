<?php

/*
 * This class is used for displaying the cluster on the case (tab cluster)
 *
 */

class CRM_Cluster_Page_ClusterLink extends CRM_Core_Page {

  protected $caseId;

  public function __construct($caseId) {
    parent::__construct();

    $this->caseId = $caseId;
  }

  public function run() {
    $this->preProcess();

    //get template file name
    $pageTemplateFile = $this->getHookedTemplateFileName();

    $sys_config = CRM_Core_Config::singleton();
    $clusterUtils = CRM_Cluster_Utils::singleton();
    $session = CRM_Core_Session::singleton();

    $sql = "SELECT ec.id as 'id', c.id as 'case_id', cc.contact_id, ec.cluster_id, pc.label as 'cluster_label' "
        . "FROM `civicrm_case` c "
        . "LEFT JOIN `civicrm_case_contact` cc ON `cc`.`case_id` = `c`.`id` "
        . "LEFT JOIN `civicrm_pum_entity_cluster` ec ON ec.entity_id = `c`.`id` "
        . "LEFT JOIN `civicrm_pum_cluster` pc ON pc.id = ec.cluster_id "
        . "WHERE `c`.`id` = '".$this->caseId."' "
        . "AND ((c.case_type_id LIKE CONCAT('%',(SELECT ov.value FROM civicrm_option_value ov WHERE ov.option_group_id = (SELECT id FROM civicrm_option_group og WHERE og.name = 'case_type') AND ov.label = 'Advice'),'%'))"
        . "OR (c.case_type_id LIKE CONCAT('%',(SELECT ov.value FROM civicrm_option_value ov WHERE ov.option_group_id = (SELECT id FROM civicrm_option_group og WHERE og.name = 'case_type') AND ov.label = 'Business'),'%'))"
        . "OR (c.case_type_id LIKE CONCAT('%',(SELECT ov.value FROM civicrm_option_value ov WHERE ov.option_group_id = (SELECT id FROM civicrm_option_group og WHERE og.name = 'case_type') AND ov.label = 'PDV'),'%'))"
        . "OR (c.case_type_id LIKE CONCAT('%',(SELECT ov.value FROM civicrm_option_value ov WHERE ov.option_group_id = (SELECT id FROM civicrm_option_group og WHERE og.name = 'case_type') AND ov.label = 'CTM'),'%'))"
        . "OR (c.case_type_id LIKE CONCAT('%',(SELECT ov.value FROM civicrm_option_value ov WHERE ov.option_group_id = (SELECT id FROM civicrm_option_group og WHERE og.name = 'case_type') AND ov.label = 'RemoteCoaching'),'%'))"
        . "OR (c.case_type_id LIKE CONCAT('%',(SELECT ov.value FROM civicrm_option_value ov WHERE ov.option_group_id = (SELECT id FROM civicrm_option_group og WHERE og.name = 'case_type') AND ov.label = 'Seminar'),'%'))"
        . "OR (c.case_type_id LIKE CONCAT('%',(SELECT ov.value FROM civicrm_option_value ov WHERE ov.option_group_id = (SELECT id FROM civicrm_option_group og WHERE og.name = 'case_type') AND ov.label = 'Grant'),'%')))"
        . " LIMIT 1";

    $dao = CRM_Core_DAO::executeQuery($sql);
    $case = false;

    if ($dao->fetch()) {
      $this->assign('block_id', 'pum_cluster');
      $this->assign('entity_cluster_id', $dao->id);
      $this->assign('caseId', $dao->case_id);
      $this->assign('caseContactId', $dao->contact_id);
      $this->assign('linked_to_cluster_id', $dao->cluster_id);
      $this->assign('linked_to_cluster_label', $dao->cluster_label);

      //render the template
      $content = self::$_template->fetch($pageTemplateFile);

      CRM_Utils_System::appendTPLFile($pageTemplateFile, $content);

      //its time to call the hook.
      CRM_Utils_Hook::alterContent($content, 'page', $pageTemplateFile, $this);

      return $content;
    }
  }

  protected function preProcess() {

  }
}

