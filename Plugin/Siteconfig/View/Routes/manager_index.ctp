<div id="site-routes" class="manager site form">
	<h1>Seitenrouten bearbeiten</h1>
	<p class="info">
	Achtung! Jegliche Änderungen hier können die Funktionsweise der
	Internetseite <b>stark</b> beeinträchtigen. Wenn Sie nicht genau wissen, wie
	Seitenrouten funktionieren fragen Sie bitte Ihren Administrator.
	</p>	
	<div id="routes">
		<?php echo $this->Form->create('Siteroutes',array('url' => array('controller' => 'routes', 'action' => 'add', 'manager' => true ))); ?>
		<h2>Aktuelle Routen</h2>
		<?php
		$countRoutes = 0 ;			
			foreach($siteRoutes as $currentRoute) {
				
				echo '<div class="route">';
				echo '<a href="#" class="delete-route" data-routenumber="'.$countRoutes.'">Route löschen</a>';
				echo $this->Form->input('Route.'.$countRoutes.'.route',array('type' => 'text', 'label' => 'Route', 'default' => $currentRoute['route']));
				echo $this->Form->input('Route.'.$countRoutes.'.url',array('type' => 'text', 'label' => 'Url', 'default' => implode(':',$currentRoute['url'])));
				echo "</div>";
				$countRoutes++;
			}
		?>
		<a id="add-new-route">Neue Route anlegen</a>
		
		<div id="routetemplate" style="display:none;" data-route-count="<?php echo $countRoutes; ?>" class="new-route">		
			<?php
				echo '<div class="route">';				
				echo $this->Form->input('Route.##number##.route',array('type' => 'text', 'label' => 'Route'));
				echo $this->Form->input('Route.##number##.url',array('type' => 'text', 'label' => 'Url'));				
				echo "</div>";
			?>
		</div>
		<?php
		echo $this->Form->button('Routen speichern',array('type' => 'submit'));
		echo $this->Form->end();
		?>
	</div>
	
	<div id="pages">
		<h2>Mögliche Seiten</h2>
	<?php
		foreach($pages as $pagealias => $pagetitle) {
			echo "<p>Titel: $pagetitle - Alias: $pagealias</p>";
		}
	?>
	</div>	
	<?php
	//debug($siteRoutes);
	//debug($pages);
	//
	?>
	
</div>
<?php $this->Js->buffer("
	
	$('a#add-new-route').click(function(){
		
		var _routecount = $('#routetemplate').attr('data-route-count'),
			_html = $('#routetemplate').html();
		
		_html = _html.replace(/##number##/g,_routecount);
		
		$(this).before(_html);
		
		_routecount = parseInt(_routecount);
		_routecount++;
		$('#routetemplate').attr('data-route-count',_routecount);
		return false;
	});
	
		
	$('#site-routes').on('click','a.delete-route',function(){
		var _routeCount = $(this).attr('data-routenumber'),
			 _parent = $(this).parent();
			 
		$.get('/manager/siteconfig/routes/delete/'+_routeCount,function(data){
		
			_parent.fadeOut(function(){
				_parent.remove();
				});		
		});
	
		return false;
	});
	

");
?>
