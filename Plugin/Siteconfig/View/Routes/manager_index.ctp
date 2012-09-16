<div id="site-routes" class="manager site form">
	<h1><?php echo __("Website - Routes") ?></h1>
	<p class="info">
	Achtung! Jegliche Änderungen hier können die Funktionsweise der
	Internetseite <b>stark</b> beeinträchtigen. Wenn Sie nicht genau wissen, wie
	Seitenrouten funktionieren fragen Sie bitte Ihren Administrator.
	</p>
	
	<div id="routes-table">
		<table>
			<thead>
				<?php
					echo $this->Html->tableHeaders(
									array(__('Number'),__('Route'),__('Controller'),__('Action'))	
									);
				?>
			</thead>
			<tbody>
				<?php
					$routesArray = array();
					
					foreach($siteRoutes as $index => $currentRoute) {
						array_push($routesArray,
									  array(
												$index,
												$currentRoute['route'],
												implode(':',$currentRoute['url']),
												$this->Html->link(__('Edit'),'#edit',array('class' => 'btn-edit-route')).' | '.$this->Html->link(__('Delete'),array('action' => 'delete', 'manager' => true,$index),array('class' => 'btn-delete-route'))
											)
									  );
					}
				
					echo $this->Html->tableCells($routesArray);
				?>
			</tbody>
		</table>
	</div>
	
	<div id="route-form-edit" style="display: none">
		<h2><?php echo __("Edit Route")?></h2>
		<?php
			echo $this->Form->create('Siteroutes',array('url' => array('controller' => 'routes', 'action' => 'edit', 'manager' => true ),'model' => false,'id' => 'RouteEditForm'));
			echo $this->Form->input('Route.route',array('type' => 'text', 'label' => 'Route'));
			echo $this->Form->input('Route.url',array('type' => 'text', 'label' => 'Controller'));
			echo $this->Form->button('Routen speichern',array('type' => 'submit'));
			echo $this->Form->end();
		?>
	</div>
	
	<div id="route-form" class="new">
		<h2><?php echo __("Add new Route")?></h2>
		<?php
			echo $this->Form->create('Siteroutes',array('url' => array('controller' => 'routes', 'action' => 'add', 'manager' => true ),'model' => false,'id' => 'RouteNewForm'));
			echo $this->Form->input('Route.route',array('type' => 'text', 'label' => 'Route'));
			echo $this->Form->input('Route.url',array('type' => 'text', 'label' => 'Controller'));
			echo $this->Form->button('Routen speichern',array('type' => 'submit'));
			echo $this->Form->end();
		?>
	</div>	
</div>
<?php $this->Js->buffer("
		
	$('#site-routes').on('click','a.btn-edit-route',function(){
		var _parentTr = $(this).parents('tr'),
			 _number = _parentTr.find('td:eq(0)').text(),
			 _route = _parentTr.find('td:eq(1)').text(),
			 _url = _parentTr.find('td:eq(2)').text();
			
		$('div#route-form-edit input#RouteRoute').val(_route);
		$('div#route-form-edit input#RouteUrl').val(_url);
		
		$('div#route-form-edit').fadeIn('fast');
		
		$('form#RouteEditForm').on('submit',function(){
			var _url = $(this).attr('action')+'/'+_number+'.json';
			console.log(_url);
			var _data = $(this).serialize();
			
			$.post(_url,_data,function(response){
				if(response.result == 'okay') {
					_parentTr.find('td:eq(1)').text($('div#route-form-edit input#RouteRoute').val());
					_parentTr.find('td:eq(2)').text($('div#route-form-edit input#RouteUrl').val());
					$('div#route-form-edit').fadeOut('fast');
				} else {
					$('div#route-form-edit').html('<p>Error - Bitte neuladen</p>');	
				}
				
			});
			return false;
		});
		
		return false;
	});
	

");
?>
