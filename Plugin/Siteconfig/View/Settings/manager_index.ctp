<div class="view manager form" id="site-settings">
	<h1>Seiteneinstellungen</h1>
	
	<?php
		echo $this->Form->create('SiteSettings',array('url' => array('controller' => 'settings', 'action' => 'add', 'manager' => true)));
	?>
	
	<div class="main-settings">
		<h2>Haupteinstellungen - </h2>
		<?php
			foreach( $settings as $key => $value):
				if(is_array($value)) continue;
		?>		<div class="setting">
				<a href="#delete-setting" class="delete-setting" data-settingkey="<?php echo $key?>">Einstellung löschen</a>
		<?php
				echo $this->Form->input($key,array('type' => 'text', 'default' => $value,'label' => $key));
		?>
				</div>
		<?php
			endforeach;
		?>
		<a href="#einstellung" id="add-setting">Neue Einstellung anlegen</a>
	</div>
	
	<div class="meta-data">
		<h2>Meta-Daten</h2>
		<?php
			foreach($settings['meta'] as $metakey => $metafield) {
				echo '<div class="setting">';
				echo '<a href="#delete-setting" class="delete-setting" data-settingkey="meta.'.$metakey.'">Einstellung löschen</a>';
				echo $this->Form->input('SiteSettings.meta.'.$metakey,array('type' => 'text', 'default' => $metafield,'label' => $metakey));
				echo '</div>';
			}
		?>
		<a href="#addmeta" id="add-meta">Neue Meta - Einstellung anlegen</a>
	</div>
	
	<?php
		echo $this->Form->button('Einstellungen speichern');
		echo $this->Form->end();
	?>
	
</div>

<?php

$this->Js->buffer("
			
	$('#site-settings').on('click','a.delete-setting',function(){
			var _settingKey = $(this).attr('data-settingkey'),
				 _parent = $(this).parent();
				 
			$.get('/manager/siteconfig/settings/delete/'+_settingKey,function(data){
			
				_parent.fadeOut(function(){
					_parent.remove();
					});		
			});
		
			
			return false;
	});
	
	$('#add-setting').on('click',function(){
			var _newHTML = '".$this->Form->input('NewSetting.key',array('type' => 'text', 'label' => 'Einstellungname'))."'
								+'".$this->Form->input('NewSetting.value',array('type' => 'text', 'label' => 'Einstellungwert'))."';
								
			$(this).before(_newHTML);
								
	});
	
	$('#add-meta').on('click',function(){
			var _newHTML = '".$this->Form->input('NewMetaSetting.key',array('type' => 'text', 'label' => 'Meta-Name'))."'
								+'".$this->Form->input('NewMetaSetting.value',array('type' => 'text', 'label' => 'Meta-Wert'))."';
								
			$(this).before(_newHTML);
								
	});
						
				");