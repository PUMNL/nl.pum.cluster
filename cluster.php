<?php

require_once 'cluster.civix.php';
use CRM_Cluster_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function cluster_civicrm_config(&$config) {
  _cluster_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function cluster_civicrm_xmlMenu(&$files) {
  _cluster_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function cluster_civicrm_install() {
  _cluster_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function cluster_civicrm_postInstall() {
  _cluster_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function cluster_civicrm_uninstall() {
  _cluster_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function cluster_civicrm_enable() {
  _cluster_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function cluster_civicrm_disable() {
  _cluster_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function cluster_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _cluster_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function cluster_civicrm_managed(&$entities) {
  _cluster_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function cluster_civicrm_caseTypes(&$caseTypes) {
  _cluster_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function cluster_civicrm_angularModules(&$angularModules) {
  _cluster_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function cluster_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _cluster_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function cluster_civicrm_entityTypes(&$entityTypes) {
  _cluster_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function cluster_civicrm_themes(&$themes) {
  _cluster_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function cluster_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function cluster_civicrm_navigationMenu(&$menu) {
  $item = array (
    'name'          =>  ts('PUM Clusterlist'),
    'url'           =>  CRM_Utils_System::url('civicrm/clusterlist', 'reset=1', true),
    'permission'    => 'administer CiviCRM',
  );

  $maxKey = CRM_Cluster_Utils::getMaxMenuKey($params);
  $menuAdministerId = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_Navigation', 'Administer', 'id', 'name');
  $menuParentId = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_Navigation', 'Customize Data and Screens', 'id', 'name');
  $params[$menuAdministerId]['child'][$menuParentId]['child'][$maxKey+1] =
    array (
    'attributes' => array (
      'label'      => ts('Manage Clusters'),
      'name'       => ts('Manage Clusters'),
      'url'        => NULL,
      'permission' => NULL,
      'operator'   => NULL,
      'separator'  => NULL,
      'parentID'   => $menuParentId,
      'navID'      => $maxKey+1,
      'active'     => 1
    ));

  _cluster_civix_insert_navigation_menu($menu, 'Administer', $item);
}

function cluster_civicrm_caseSummary($caseId) {
  $page = new CRM_Cluster_Page_ClusterLink($caseId);
  $content = $page->run();

  return array(
    'case_cluster' => array('value' => $content)
  );
}