<h1>Liste des serveurs géré par <?php echo $nom_service; ?></h1>
<?php if($status): ?>
<div class="alert alert-success" role="alert">
    <?php echo $status; ?>
</div>
<?php endif; ?>


<div class="btn-group pull-right">
    <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" rel="tooltip" title="Exporter">
        <span class=" glyphicon glyphicon-download-alt"></span> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo base_url("export/csv/".$id_service); ?>">Format CSV</a></li>
        <li><a href="<?php echo base_url("export/xml/".$id_service); ?>">Format XML</a></li>
    </ul>
</div>


<table id="table" class="display">
    <thead>
        <th>Nom</th>
        <th>IP</th>
        <th>Référent 1</th>
        <th class="center">Editer / Voir</th>
        <th class="center">Supprimer</th>
    </thead>
    <tbody>
    <?php
    foreach ($liste_servers->result_array() as $row)
    {
        if(is_role() != 1 && $row['referent'] !== $user) { 
            $logodetail= "glyphicon-info-sign";
        }
        else {
                $logodetail= "glyphicon-pencil";            
        }
    ?>

        <tr>
            <td><?php echo  $row['nom']; ?></td>
            <td><?php echo  $row['ip']; ?></td>
            <td><?php echo  $row['referent']; ?></td>
            
           <td class="center"><a href="<?php echo base_url("server/edit/".$row['ids']); ?>"><span class="glyphicon <?php echo $logodetail; ?>" aria-hidden="true"></span></a></td>
           <td class="center"><a href="?delete=<?php echo $row['ids']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><span class="glyphicon  glyphicon-trash" aria-hidden="true"></span></a></td>
           
        </tr>

    <?php } ?>
    </tbody>
</table>