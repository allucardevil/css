<div class="content">
        
        <div class="header">
            <div class="stats">
            	<p class="stat"><span class="number">53 pcs</span>incoming</p>
                <p class="stat"><span class="number">27 pcs</span>outgoing(paid)</p>
                <p class="stat"><span class="number">15 pcs</span>outgoing(unpaid)</p>
			</div>

            <h1 class="page-title"><?php echo ucwords($this->config->item('airport_name')); ?></h1>
        </div>
        
                <ul class="breadcrumb">
                	<li><a href="javascript:window.history.go(-1);"><i class="icon-backward"></i></a></li>
                    <span class="divider">|</span>
                    <li><?php echo anchor('dashboard','<i class="icon-home"></i>', ''); ?></li>
                    <span class="divider">|</span>
                    <li class="active">Dashboard</li>
        		</ul>

        <div class="container-fluid">
            <div class="row-fluid">