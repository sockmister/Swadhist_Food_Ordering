
<table class="display" id="collectiontable"> 
	<thead> 
<tr>
			<th class="ui-state-default" style="width: 114px;">
				<div class="DataTables_sort_wrapper">
					Date
					<span class="css_right ui-icon ui-icon-triangle-1-n"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 85px;">
				<div class="DataTables_sort_wrapper">
					Time
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 130px;">
				<div class="DataTables_sort_wrapper">
					Dish
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 102px;">
				<div class="DataTables_sort_wrapper">
					Quantity
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 70px;">
				<div class="DataTables_sort_wrapper">
					Price
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 111px;">
				<div class="DataTables_sort_wrapper">
					Customer
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 191px;">
				<div class="DataTables_sort_wrapper">
					Collected
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
			<th class="ui-state-default" style="width: 191px;">
				<div class="DataTables_sort_wrapper">
					Incomplete
					<span class="css_right ui-icon ui-icon-carat-2-n-s"></span>
				</div>
			</th>
		</tr>
	</thead> 
	<tbody> 
		
		<?php 
		foreach ($ReadyToCollect as $dataitem){?>
		
		
		<tr class="gradeA even"> 
			<td class=" sorting_1"><?=$dataitem->order_date?></td> 
			<td><?=$dataitem->order_time?></td> 
			<td><?=$dataitem->name?></td> 
			<td class="center"><?=$dataitem->quantity?></td> 
			<td class="center">$<?=$dataitem->price?></td>
			<td class="center"><?=$dataitem->user_id?></td> 
			<td class="center"><input type="button" value="order collected" onclick="sendToOrderCompleted('<?=$dataitem->id?>')"></td>
			<td class="center"><input type="button" value="incomplete" onclick="sendToOrderIncomplete('<?=$dataitem->id?>')"></td> 				
		</tr>
		
		<? } ?>

	</tbody> 
</table> 

