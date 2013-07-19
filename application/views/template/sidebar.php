 <div class="sidebar-nav">
        <?if(! isset($sidebar)){$sidebar='';}?>
        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-home"></i>Domestic Module</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><?php echo anchor('dashboard', 'Home', 'Home'); ?></li>
            <li><?php echo anchor('dashboard', 'Search BTB', 'Home'); ?></li>
            <li><?php echo anchor('dashboard', 'Search SMU', 'Home'); ?></li>
            
        </ul>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>BTB</a>
        <ul id="accounts-menu" class="nav nav-list collapse">
        	<li ><?php echo anchor('weighing/outgoing/add','Input BTB Outgoing'); ?></li>
            <li ><?php echo anchor('weighing/outgoing/data_today','List Today BTB Outgoing'); ?></li>
            <li ><?php echo anchor('weighing/outgoing/search','Search BTB Outgoing'); ?></li>
            <li class="divider"></li>
            <li ><?php echo anchor('weighing/incoming/add','Input BTB Incoming'); ?></li>
            <li ><?php echo anchor('weighing/incoming/weighing_list_today','List BTB Incoming'); ?></li>
        </ul>
        
        <a href="#outgoing" class="nav-header" data-toggle="collapse"><i class="icon-arrow-up"></i>Outgoing</a>
        <ul id="outgoing" class="nav nav-list collapse">
            <li ><?php echo anchor('incoming/add','Build Up', ''); ?></li>
            <li ><?php echo anchor('incoming/add','Loading'); ?></li>
            <li ><?php echo anchor('incoming/add','Outgoing Manifest'); ?></li>
        </ul>
        
        <a href="#error-menu" class="nav-header <?php if($sidebar == 'kasir'){echo '';} else {echo 'collapsed';}?>" data-toggle="collapse"><i class="icon-th"></i>Cashier</a>
        <ul id="error-menu" class="nav nav-list collapse <?php if($sidebar == 'kasir'){echo 'in';}?>">
            <li ><?php echo anchor('cashier/payment','New Payment Receipt'); ?></li>
            <li ><?php echo anchor('cashier/payment/daily_outgoing_payment_report/'.date('d-m-Y', time()).'/'.date('d-m-Y', time()),'Daily Outgoing Payment Report'); ?></li>
            <li ><?php echo anchor('cashier/payment/daily_incoming_payment_report/'.date('d-m-Y', time()).'/'.date('d-m-Y', time()),'Daily Incoming Payment Report'); ?></li>
            <li ><?php echo anchor('incoming/add','My Payment Report'); ?></li>
            <li ><?php echo anchor('incoming/add','No Faktur Pajak'); ?></li>
        </ul>
        
         <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-arrow-down"></i>Incoming</a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><?php echo anchor('incoming/add','Incoming Manifest'); ?></li>
            <li ><?php echo anchor('incoming/add','Unloading'); ?></li>
            <li ><?php echo anchor('incoming/add','Break Down'); ?></li>
        </ul>
        
         <a href="#supervisor" class="nav-header" data-toggle="collapse"><i class="icon-eye-open"></i>Supervisor</a>
        <ul id="supervisor" class="nav nav-list collapse">
            <li ><?php echo anchor('incoming/add','Edit Request'); ?></li>
            <li ><?php echo anchor('incoming/add','Void Request'); ?></li>
            <li ><?php echo anchor('incoming/add','Temporary Supervisor Mode'); ?></li>
        </ul>
        
        
        
        <a href="#setting-menu" class="nav-header" data-toggle="collapse"><i class="icon-tasks"></i>Setting</a>
        <ul id="setting-menu" class="nav nav-list collapse">
            <li ><?php echo anchor('admin/setting/agent','Agent'); ?></li>
            <li ><?php echo anchor('admin/setting/airline','Airline'); ?></li>
            <li ><?php echo anchor('admin/setting/station','Station'); ?></li>
            <li ><?php echo anchor('admin/setting/payment','Jenis Pembayaran'); ?></li>
            <li ><?php echo anchor('admin/setting/commodity','Komoditi'); ?></li>
            <li ><?php echo anchor('admin/setting/goods','Jenis Barang'); ?></li>
            <li ><?php echo anchor('admin/setting/tax_invoice_number','No Faktur Pajak'); ?></li>
            <li ><?php echo anchor('admin/setting/warehouse_rental_rates','Harga Sewa Gudang'); ?></li>
        </ul>

		
        <a href="#information-menu" class="nav-header" data-toggle="collapse"><i class="icon-info-sign"></i>Information</a>
        <ul id="information-menu" class="nav nav-list collapse">
            <li><?php echo anchor('dashboard', 'Login', 'Home'); ?></li>
            <li><?php echo anchor('dashboard', 'PIN Verification', 'Home'); ?></li>
            <li><?php echo anchor('dashboard', 'Profile', 'Home'); ?></li>
            <li><?php echo anchor('dashboard', 'Logout', 'Home'); ?></li>
            <li><?php echo anchor('privacy_policy', 'Privacy Policy', 'Privacy Policy'); ?></li>
            <li><?php echo anchor('team_sigap', 'Help Desk', 'Help Desk'); ?></li>
        </ul>
		
       
        
              
    </div>