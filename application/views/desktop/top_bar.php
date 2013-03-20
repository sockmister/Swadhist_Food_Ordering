			<div class="grid_8">
                <h1>Swadhist</h1>
                <nav>
                    <ul class="sf-menu clearfix">
                        <li id="tb_manage_queue">
							<a href="<?=site_url("stall_owner/getStallOrder")?>">Manage Queue</a>
						</li>
                        <li id="tb_menu_manage">
							<a href="<?=site_url("stall_owner/manageMenu")?>">Menu</a>
						</li>
                        <li id="tb_sales">
							<a href="<?=site_url("stall_owner/manageSales")?>">Sales</a>
						</li>
                        <li id="tb_queue_slot">
							<a href="<?=site_url("stall_owner/manageQueueSlot")?>">Queue Slot</a>
						</li>
						<li id="tb_stall_info">
							<a href="<?=site_url("stall_owner/updateStallInfo")?>">Stall Info</a>
						</li>
                        <li class="fr"><a href="#" class="arrow-down">Account</a>
                            <ul>
                                <li><a href="<?=site_url("stall_owner/update_details")?>">Update Details</a></li>
                                <li><a href="<?=site_url("stall_owner/change_password")?>">Change Password</a></li>
                                <li><a href="<?=site_url("stall_owner_auth/logout")?>">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>