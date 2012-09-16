<div class="view manager form" id="site-settings">
	<h1><?php echo __('Website - Settings'); ?></h1>
	
	<div id="settings-table">
		<table>
			<thead>
				<?php
					echo $this->Html->tableHeaders(
									array(__('Name'),__('Namespace'),__('Value'),__('Action'))	
									);
				?>
			</thead>
			<tbody>
				<?php
					$tableRows = array();										
					$actions = $this->Html->link(__('Edit'),'#edit', array('class' => 'btn-edit-setting')).' | '.$this->Html->link(__('Delete'),'#delete', array('class' => 'btn-delete-setting'));
					foreach($settings as $key => $value):
						$tableRow = array();
						if(is_array($value)) {
							foreach($value as $name => $setting):
								$tableRow = array();								
								$tableRow[] = $name;
								$tableRow[] = $key;
								$tableRow[] = $setting;
								$tableRow[] = $actions;
								array_push($tableRows,$tableRow);
							endforeach;
						} else {
							$tableRow[] = $key;
							$tableRow[] = '';
							$tableRow[] = $value;
							$tableRow[] = $actions;
							array_push($tableRows,$tableRow);
						}							
					endforeach;					
					echo $this->Html->tableCells($tableRows);
				?>
			</tbody>
		</table>
	</div>
	
	
	<div id="edit-setting-form">
		<h2><?php echo __('Edit Setting') ?></h2>
		<p id="setting-key"></p>
		<?php
			
			echo $this->Form->create('SiteSettings',array('url' => array('controller' => 'settings', 'action' => 'edit', 'manager' => true),'id' => 'EditSettingForm'));
			echo $this->Form->input('Setting.namespace',array('type' => 'hidden', 'label' => __('Namespace')));
			echo $this->Form->input('Setting.key',array('type' => 'hidden', 'label' => __('Key')));
			echo $this->Form->input('Setting.value',array('type' => 'text','label' => __('Value')));
			echo $this->Form->button(__('Save setting'));
			echo $this->Form->end();
		?>
		<hr class="alt"/>
	</div>
	
	<div id="new-setting-form">
		<h2><?php echo __('Create new Setting') ?></h2>
		<?php
			echo $this->Form->create('SiteSettings',array('url' => array('controller' => 'settings', 'action' => 'add', 'manager' => true)));
			echo $this->Form->input('Setting.namespace',array('type' => 'text', 'label' => __('Namespace')));
			echo $this->Form->input('Setting.key',array('type' => 'text', 'label' => __('Key')));
			echo $this->Form->input('Setting.value',array('type' => 'text','label' => __('Value')));
			echo $this->Form->button(__('Save setting'));
			echo $this->Form->end();
		?>
	</div>
</div>

<?php

$this->Js->buffer("
		$('#site-settings').on('click','a.btn-edit-setting',function(){
		var _parentTr = $(this).parents('tr'),
			 _key = _parentTr.find('td:eq(0)').text(),
			 _namespace = _parentTr.find('td:eq(1)').text(),
			 _value = _parentTr.find('td:eq(2)').text();
			
		$('div#edit-setting-form input#SettingKey').val(_key);
		$('div#edit-setting-form input#SettingValue').val(_value);
		$('div#edit-setting-form input#SettingNamespace').val(_namespace);
		$('p#setting-key').text(_key+'.'+_namespace);
		
		$('div#edit-setting-form').fadeIn('fast');
		
		$('form#EditSettingForm').on('submit',function(){
			var _url = $(this).attr('action')+'.json';
			console.log(_url);
			var _data = $(this).serialize();
			return false;
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