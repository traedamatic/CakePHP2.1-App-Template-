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
					
					foreach($settings as $key => $value):
						$tableRow = array();
						if(is_array($value)) {
							foreach($value as $name => $setting):
								$actions = $this->Html->link(__('Edit'),'#edit', array('class' => 'btn-edit-setting')).' | '.$this->Html->link(__('Delete'),array('action' => 'delete', 'manager' => true,$key.'.'.$name), array('class' => 'btn-delete-setting'));
								$tableRow = array();								
								$tableRow[] = $name;
								$tableRow[] = $key;
								$tableRow[] = $setting;
								$tableRow[] = $actions;
								array_push($tableRows,$tableRow);
							endforeach;
						} else {
							$actions = $this->Html->link(__('Edit'),'#edit', array('class' => 'btn-edit-setting')).' | '.$this->Html->link(__('Delete'),array('action' => 'delete', 'manager' => true,$key), array('class' => 'btn-delete-setting'));
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
	
	
	<div id="edit-setting-form" style="display: none;">
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

<hr />
<div id="howto">
	<h2>Usage in your CakePHP App</h2>
	<p>The use of the Settings in your app is simple!</p>
	<p>You have just to call the static read function of the Configure Class</p>
	<p>Example:</p>
	<!-- Code PHP -->
	<pre class="php">		
			Configure::read('SiteSettings.title');
			
			//or for settings with namespace			
			Configure::read('SiteSettings.meta.author');
	</pre>
</div>

<?php

$this->Js->buffer("
		$('#site-settings').on('click','a.btn-edit-setting',function(){
			window._parentTr = $(this).parents('tr');
			var _key = _parentTr.find('td:eq(0)').text(),
				 _namespace = _parentTr.find('td:eq(1)').text(),
				 _value = _parentTr.find('td:eq(2)').text();
				
			$('div#edit-setting-form input#SettingKey').val(_key);
			$('div#edit-setting-form input#SettingValue').val(_value);
			$('div#edit-setting-form input#SettingNamespace').val(_namespace);
			$('p#setting-key').text(_namespace+'.'+_key);
			
			$('div#edit-setting-form').fadeIn('fast');
			
			return false;
		});
		
		$('form#EditSettingForm').on('submit',function(){
			var _url = $(this).attr('action')+'.json';
			console.log(_url);
			var _data = $(this).serialize();
			
			$.post(_url,_data,function(response){
				if(response.result == 'okay') {					
					_parentTr.find('td:eq(2)').text($('div#edit-setting-form input#SettingValue').val());
					$('div#route-form-edit').fadeOut('fast');
				} else {
					$('div#route-form-edit').html('<p>Error - Bitte neuladen</p>');	
				}
				
			});
			return false;
		});
		
			");