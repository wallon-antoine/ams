<h1>Recherche avancée multicritères</h1>
<form action="<?php echo base_url("search/advanced"); ?>" method="get" accept-charset="utf-8" role="form" class="form-horizontal">
    <div class="col-md-8">
        <div id="detailserveur" class="tab-pane fade in active">
            <div class="form-group tab-content">

                <label class="col-md-4 control-label">
                        Nom du serveur :
                </label>
                <div class="col-xs-8">
                        <?php echo form_input('nom', '', "class='form-control'"); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">
                        Distribution :    
                </label>
                <div class="col-xs-8">
                        <?php echo form_input('distrib', '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">
                        IP :
                </label>
                <div class="col-xs-8">
                        <?php echo form_input('ip', '', "class='form-control' "); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">
                        Nom du référent :
                </label>
                <div class="col-xs-8">
                        <?php echo form_input('referent', '', 'class="form-control" '); ?>
                </div>
            </div>        
        </div>
        <div class="form-group">
                <label class="col-md-4 control-label">
                        &nbsp;
                </label>            
            <div class="col-md-6">    
        <?php echo form_submit('submit', 'Recherche','class="btn btn-primary"'); ?>
            </div>
        </div>
    </div>
</form>      