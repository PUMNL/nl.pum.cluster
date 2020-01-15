# nl.pum.cluster

This CiviCRM-extension adds a cluster field on cases so cases can be categorized by cluster.
Clusters can be added in the configuration screen.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

![Screenshot](https://raw.github.com/PUMNL/nl.pum.cluster/master/images/screenshot.png)

## Requirements

* PHP 5.6 (Tested, might work with other version, but not tested)
* CiviCRM 4.4.8 (Tested, might work with other version, but not tested)

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl nl.pum.cluster@https://github.com/PUMNL/nl.pum.cluster/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/PUMNL/nl.pum.cluster.git
cv en cluster
```

## Configuration after installation

After installation you need to create a cluster list.
Due to PUM's requirements a list was already known, so the initial list is already loaded

To configure the clusters, goto Administer --> PUM Clusterlist -->
Here you can see the list of cluster or add a new cluster with the button 'Add cluster'

## Usage

On the case you can find a new field 'Cluster'. With this field you can label the case with a cluster using one of the clusters from the cluster list.

## To do

## Documentation

This extension introduces to new API's: Cluster & EntityCluster
These API's are used to:
- Create a new cluster using the clusterlist
- Assign a entity to a cluster

Currently there is only one entity case, but this can be extended later on for other purposes (f.e. contacts).