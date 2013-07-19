<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">INPUT BTB OUTGOING</a>
        		<div id="page-stats" class="block-body collapse in">
                
                <p>
                
                <?php echo form_open_multipart('weighing/import_csv/run_import'); ?> 
                
				<div class="row-fluid">
                    <div class="span2">
                        <label>CSV File</label>
                        <input type="file" name="database" size="20" />
                    </div>
                </div>
                
                <div class="row-fluid">
                    <div class="span4">
					    <label></label>
                        <button class="btn btn-large" type="submit">GO</button>
                    </div>
                </div>
                
               
                
                <?php echo form_close(); ?>
                
                </p>
               
                
               
                </div>
            </div>
        </div>
        
	</div>
</div>