<h1><?php echo $titre; ?></h1>
<?php if(is_role() == 1 || is_role() == 4): ?>
<div class="btn-group pull-right">
    <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" rel="tooltip" title="Exporter">
        <span class=" glyphicon glyphicon-download-alt"></span> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo base_url("export/csv/"); ?>?nom=<?php echo $this->input->get('nom'); ?>&distrib=<?php echo $this->input->get('distrib'); ?>&ip=<?php echo $this->input->get('ip'); ?>&referent=<?php echo $this->input->get('referent'); ?>">Format CSV</a></li>
        <li><a href="<?php echo base_url("export/xml/"); ?>?nom=<?php echo $this->input->get('nom'); ?>&distrib=<?php echo $this->input->get('distrib'); ?>&ip=<?php echo $this->input->get('ip'); ?>&referent=<?php echo $this->input->get('referent'); ?>">Format XML</a></li>
    </ul>
</div>
<?php endif; ?>
<table id="table" class="display">
    <thead>
        <th>Nom</th>
        <th>IP</th>
        <th>Referent1</th>
        <th class="center">Editer</th>
        <th class="center">Supprimer</th>
    </thead>
    <tbody>
    <?php
    foreach ($results as $row)
    {
        if($row['referent'] !== $user) { 
            $logodetail= "glyphicon-info-sign";
        }
        else {
                $logodetail= "glyphicon-pencil";            
        }        
    ?>

        <tr>
            <td><?php echo  $row['nom']; ?></td>
            <td><?php echo  $row['ip']; ?></td>
            <td><?php echo  $row['referent']; ?></a></td>
           <td class="center"><a href="<?php echo base_url("server/edit/".$row['ids']); ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
           <td class="center"><a href="?delete=<?php echo $row['ids']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
        </tr>

    <?php } ?>
    </tbody>
</table>
