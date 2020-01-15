{*
 * This template is used for displaying the cluster on the case (tab cluster)
 *}
<div id="pum_cluster" class="crm-accordion-wrapper collapsed">
<div class="crm-accordion-header">
Cluster
</div>
<div class="crm-accordion-body" style="display: none;">
<table class="crm-info-panel">
<tbody><tr>
<td class="label">Cluster</td>
<td class="html-adjust">{$linked_to_cluster_label}</td>
</tr>
</tbody></table>

<div>
<a href="/civicrm/entitycluster/edit?id={$entity_cluster_id}&case_id={$caseId}&cid={$caseContactId}&entity_type=case" class="button" style="margin-left: 6px;margin-top:-6px;">
<div class="icon edit-icon"></div>Edit
</a>
</div>
<br>
</div>
</div>
<div class="clear"></div>

{literal}
<script type="text/javascript">
cj( document ).ready(function() {
  var pumCaseNumber = cj('#PUM_Case_number');
  if(pumCaseNumber) {
    cj('#case_cluster').insertAfter(pumCaseNumber);
  }
});
</script>
{/literal}