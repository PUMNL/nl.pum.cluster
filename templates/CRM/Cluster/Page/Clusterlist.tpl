<table id="clusterlist-table" class="display">
  <thead>
    <tr>
      <th>{ts}ID{/ts}</th>
      <th>{ts}Label{/ts}</th>
      <th>{ts}Name{/ts}</th>
      <th>{ts}Country{/ts}</th>
      <th>{ts}Is active?{/ts}</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <a href="{crmURL p='civicrm/clusterlist/add' q="reset=1""}" class="button">{ts}Add cluster{/ts}</a>
    {foreach from=$clusters key=cluster_id item=cluster}
      <tr id="row_{$cluster.id}" class={$row_class}>
        <td width="5%">{$cluster.id}</td>
        <td width="30%">{$cluster.label}</td>
        <td width="30%">{$cluster.name}</td>
        <td width="25%">{foreach from=$cluster.countries item=country}{$country.name}{/foreach}</td>
        <td width="5%">{if $cluster.is_active eq 1}Yes{/if}{if $cluster.is_active eq 0}No{/if}</td>
        <td width="5%">
            <a href="{crmURL p='civicrm/clusterlist/edit' q="reset=1&id=`$cluster_id`""}">{ts}Edit{/ts}</a>
        </td>
      </tr>
      {if $row_class eq "odd-row"}
        {assign var="row_class" value="even-row"}
      {else}
        {assign var="row_class" value="odd-row"}
      {/if}
    {/foreach}
  </tbody>
</table>