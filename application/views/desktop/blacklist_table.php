
<table class="display" id="blacklisttable"> 
	<thead> 
<tr>
			<th class="ui-state-default" style="width: 114px;">
				<div class="DataTables_sort_wrapper">
					ID
					<span class="css_right ui-icon ui-icon-triangle-1-n"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 85px;">
				<div class="DataTables_sort_wrapper">
					Name
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 130px;">
				<div class="DataTables_sort_wrapper">
					Phone Number
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 102px;">
				<div class="DataTables_sort_wrapper">
					Email
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 70px;">
				<div class="DataTables_sort_wrapper">
					Action
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>


		</tr>
	</thead> 
	<tbody> 
		
		<?php 
		foreach ($Blacklisted as $dataitem){?>
		
		
		<tr class="gradeA even"> 
			<td class=" sorting_1"><?=$dataitem->NUSID?></td> 
			<td><?=$dataitem->name?></td> 
			<td class="center"><?=$dataitem->phone_number?></td> 
			<td class="center"><?=$dataitem->email?></td>
			<td class="center"><input type="button" value="Remove from blacklist" onclick="removeFromBlacklist('<?=$dataitem->NUSID?>')"></td>			
		</tr>
		
		<? } ?>

	</tbody> 
</table> 

