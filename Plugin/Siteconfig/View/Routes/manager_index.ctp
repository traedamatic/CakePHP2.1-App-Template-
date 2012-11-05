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
									array(__('Number'),__('Route'),__('Plugin'),__('Controller'),__('Action'),__('Slug'),__('Action'))	
									);
				?>
			</thead>
			<tbody>
				<?php
					$routesArray = array();
					
					foreach($siteRoutes as $index => $currentRoute) {						
						
						$plugin = isset($currentRoute['url']['plugin']) ? $currentRoute['url']['plugin'] : "-";
						$slug = isset($currentRoute['url'][0]) ? $currentRoute['url'][0] : "-";
						
						array_push($routesArray,
									  array(
												$index,
												$currentRoute['route'],
												$plugin,
												$currentRoute['url']['controller'],
												$currentRoute['url']['action'],
												$slug,
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
			echo $this->Form->input('Route.url.controller',array('type' => 'text', 'label' => 'Controller'));
			echo $this->Form->input('Route.url.action',array('type' => 'text', 'label' => 'Action'));
			echo $this->Form->input('Route.url.slug',array('type' => 'text', 'label' => 'Slug'));
			echo $this->Form->input('Route.url.plugin',array('type' => 'text', 'label' => 'Plugin'));
			echo $this->Form->button('Routen speichern',array('type' => 'submit'));
			echo $this->Form->end();
		?>
	</div>
	
	<div id="route-form" class="new">
		<h2><?php echo __("Add new Route")?></h2>
		<?php
			echo $this->Form->create('Siteroutes',array('url' => array('controller' => 'routes', 'action' => 'add', 'manager' => true ),'model' => false,'id' => 'RouteNewForm'));
			echo $this->Form->input('Route.route',array('type' => 'text', 'label' => 'Route'));
			echo $this->Form->input('Route.url.controller',array('type' => 'text', 'label' => 'Controller'));
			echo $this->Form->input('Route.url.action',array('type' => 'text', 'label' => 'Action'));
			echo $this->Form->input('Route.url.slug',array('type' => 'text', 'label' => 'Slug'));
			echo $this->Form->input('Route.url.plugin',array('type' => 'text', 'label' => 'Plugin'));
			echo $this->Form->button('Routen speichern',array('type' => 'submit'));
			echo $this->Form->end();
		?>
	</div>	
</div>
<?php $this->Js->buffer("
		
	$('#site-routes').on('click','a.btn-edit-route',function(){
		window._parentTr = $(this).parents('tr');
		var _number = _parentTr.find('td:eq(0)').text(),
			 _route = _parentTr.find('td:eq(1)').text(),
			 _plugin = _parentTr.find('td:eq(2)').text(),
			 _controller = _parentTr.find('td:eq(3)').text(),
			 _action = _parentTr.find('td:eq(4)').text(),
			 _slug = _parentTr.find('td:eq(5)').text();
			
		$('div#route-form-edit input#RouteRoute').val(_route);
		
		if(_plugin != '-')
			$('div#route-form-edit input#RouteUrlPlugin').val(_plugin);
		
		$('div#route-form-edit input#RouteUrlController').val(_controller);
		$('div#route-form-edit input#RouteUrlAction').val(_action);
		
		if(_slug != '-')
			$('div#route-form-edit input#RouteUrlSlug').val(_slug);
		
		$('div#route-form-edit').fadeIn('fast');
		
		return false;
	});
	
	$('form#RouteEditForm').on('submit',function(){
			var _number = _parentTr.find('td:eq(0)').text(),
				 _url = $(this).attr('action')+'/'+_number+'.json';
			
			
			var _data = $(this).serialize();
			
			$.post(_url,_data,function(response){
				if(response.result == 'okay') {
					_parentTr.find('td:eq(1)').text($('div#route-form-edit input#RouteRoute').val());
					_parentTr.find('td:eq(2)').text($('div#route-form-edit input#RouteUrlPlugin').val());
					_parentTr.find('td:eq(3)').text($('div#route-form-edit input#RouteUrlController').val());
					_parentTr.find('td:eq(4)').text($('div#route-form-edit input#RouteUrlAction').val());
					_parentTr.find('td:eq(5)').text($('div#route-form-edit input#RouteUrlSlug').val());					
					$('div#route-form-edit').fadeOut('fast');
				} else {
					$('div#route-form-edit').html('<p>Error - Bitte neuladen</p>');	
				}
				
			});
			return false;
	});
	

");
?>

