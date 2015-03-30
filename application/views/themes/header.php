<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <title>Administrative Management Serveur (AMS) - <?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo base_url("plugins/bootstrap/bootstrap.min.css"); ?>" />

    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo base_url("plugins/bootstrap/bootstrap-theme.min.css"); ?>" />

    <link rel="stylesheet" href="<?php echo base_url("css/style.css"); ?>" />
    <script src="<?php echo base_url("plugins/jquery/js/jquery-1.11.2.min.js"); ?>"></script>
    <script src="<?php echo base_url("plugins/bootstrap/bootstrap.min.js"); ?>"></script>
    
    <!--datatables-->
    <link rel='stylesheet' href="<?php echo base_url("plugins/dataTables/css/jquery.dataTables.css"); ?>" />
    <script src="<?php echo base_url("plugins/dataTables/js/jquery.dataTables.min.js"); ?>"></script>
    <!--datatables responsive-->
    <link rel='stylesheet' href="<?php echo base_url("plugins/dataTables/css/dataTables.responsive.css"); ?>" />
    <script src="<?php echo base_url("plugins/dataTables/js/dataTables.responsive.js"); ?>"></script>    
    
<!-- Jquery ui-->
    <link rel="stylesheet" href="<?php echo base_url("plugins/jquery/css/jquery-ui.css"); ?>">
    <script src="<?php echo base_url("plugins/jquery/js/jquery-ui.js"); ?>"></script>
<!-- Ams -->    
    <script src="<?php echo base_url("plugins/ams/js/common.js"); ?>"></script>

    
<!-- Noty -->
<link rel="stylesheet" href="<?php echo base_url("css/noty.css"); ?>" />
<script type="text/javascript" src="<?php echo base_url("plugins/noty/jquery.noty.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("plugins/noty/layouts/topCenter.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("plugins/noty/themes/default.js"); ?>"></script>
    
    <link rel="shortcut icon" type="image/x-icon" href="http://www.univ-lille1.fr/digitalAssets/37/37567_favicon.ico" />
    <script>
        $(document).ready(function(){
            $("[rel=tooltip]").tooltip({ placement: 'right'});  
            $('#table').DataTable( { responsive: true, searching: false });
                        
//            var oTable = $('#table').dataTable({                                                    
//                            "bJQueryUI": true,                         
//                            }).makeEditable({                              
//                                    sDeleteURL: "CRUD/DepDelete.php",
//                                    fnOnDeleted: function() {
//                                        oTable.fnDraw(true)
//                                    },     
//                                    oDeleteRowButtonOptions:{
//                                        label: "Remove",                                       
//                                    },
//                                    fnShowError: function (message, action){
//                                        switch (action) {                                          
//                                            case "delete":
//                                                jAlert(message, "Delete");
//                                                break;                                         
//                                        }
//                                    },
//                                   
//                            });
                            
            $('.btnNext').click(function(){
                $('.nav-tabs > .active').next('li').find('a').trigger('click');
            });
            $('.btnPrevious').click(function(){
                $('.nav-tabs > .active').prev('li').find('a').trigger('click');
            });
            $('#getdistrib').autocomplete({
                minLength: 2,
                source: "<?php echo base_url("jsons/distributionlist"); ?>"
            });
            $('.getreferent').autocomplete({
                minLength: 2,
                source: "<?php echo base_url("jsons/referentlist"); ?>"
            });           
             
        });
 $(function() {
function split( val ) {
return val.split( /,\s*/ );
}
function extractLast( term ) {
return split( term ).pop();
}
$( "#getservername" )
// don't navigate away from the field on tab when selecting an item
.bind( "keydown", function( event ) {
if ( event.keyCode === $.ui.keyCode.TAB &&
$( this ).autocomplete( "instance" ).menu.active ) {
event.preventDefault();
}
})
.autocomplete({
source: function( request, response ) {
$.getJSON( "<?php echo base_url("jsons/servernamelist"); ?>", {
term: extractLast( request.term )
}, response );
},
search: function() {
// custom minLength
var term = extractLast( this.value );
if ( term.length < 2 ) {
return false;
}
},
focus: function() {
// prevent value inserted on focus
return false;
},
select: function( event, ui ) {
var terms = split( this.value );
// remove the current input
terms.pop();
// add the selected item
terms.push( ui.item.value );
// add placeholder to get the comma-and-space at the end
terms.push( "" );
this.value = terms.join( ", " );
return false;
}
});
});

    </script>
</head>

<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url("css/logo.png"); ?>" alt="Logo"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if(is_admin() || is_role() == 4): ?><li class="<?php if($this->uri->segment(2)=="add"){echo "active";}?>" ><a href="<?php echo base_url("server/add"); ?>">Ajout</a></li><?php endif; ?>
            
            <li class="dropdown <?php if($this->uri->segment(2)=="liste"){echo "active";}?>">
              <?php if(is_groupe() != NULL) : ?><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Liste des serveurs <span class="caret"></span></a><?php endif; ?>
              <ul class="dropdown-menu" role="menu">
                <?php if(is_admin()): ?><li><a href="<?php echo base_url("server/liste"); ?>">Tous les serveurs</a></li><?php endif; ?>
                
                <?php 
                $services=$this->Ams->get_groupes();
                
                foreach($services->result_array() as $service):
                ?>
                <?php if(is_groupe() == $service['id_service'] || is_admin() || is_role() == 3): ?>
                    <li><a href="<?php echo base_url("server/liste/".$service['id_service']); ?>"> <?php echo $service['service']; ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            </li>
            <?php if(is_groupe() != NULL): ?>
                <li class="<?php if($this->uri->segment(2)=="advanced"){echo "active";}?>" ><a href="<?php echo base_url('search/advanced'); ?>">Recherche avancé</a></li>
            <?php endif; ?>            
            <?php if(is_admin() || is_role() == 4): ?><li class="dropdown <?php if($this->uri->segment(2)=="config"){echo "active";}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Paramètre <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url("config/users"); ?>">Edition des droits</a></li>
                <li><a href="<?php echo base_url("config/groupes"); ?>">Edition des groupes</a></li>
              </ul>
            </li><?php endif; ?>
            <li><a href="https://projets-webent.univ-lille1.fr/projects/administrative-management-server/wiki">Aide</a></li>
          </ul>
            <?php if(is_groupe() != NULL): ?>
                    
                        <div class="form-group">
                            <form action="<?php echo base_url("search/result"); ?>" method="get" accept-charset="utf-8" class="navbar-form navbar-right" name="search">  
                                <?php $data = array(
                                   'name'        => 's',
                                   'class'          => 'form-control',
                                   'placeholder'  => 'recherche',
                                    'value'       => $this->input->get('s') 
                                 );

                                 echo form_input($data);
                                 ?>
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                 
                            </form>
                        </div>
                    
                    
            <?php endif; ?>
          <?php if($this->cas->is_authenticated()): ?>
            <div id="infologin">
                Bienvenue <?php echo $user; ?> | 
                <a href="<?php echo base_url("logout"); ?>">Déconnexion</a> 
            </div>
                <?php endif; ?>
        </div><!--/.nav-collapse -->   
      </div>
    </nav>
    <div id="wrapper">