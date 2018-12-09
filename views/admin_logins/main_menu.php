<ul>
	<li class="submenu">
		<a <?php if (strtolower($this->uri->segment(1)) == 'dashboard') {
			echo 'class="active"';
		} ?> href="<?php echo base_url(); ?>dashboard/index"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span>
		</a>
	</li>

	<li class="submenu">
		<a <?php if (array_search(strtolower($this->uri->segment(1)), array("a" => "brick_categorys", "b" => "sardars", "c" => "vendors", "d" => "machine_types", "e" => "sardar_types")) != '') {
			echo 'class="active"';
		} ?> href="#"><i class="fa fa-fw fa-table"></i> <span> Configuration </span> <span
				class="menu-arrow"></span></a>
		<ul class="list-unstyled">
			<li <?php if (strtolower($this->uri->segment(1)) == 'brick_categorys') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>brick_categorys/index">Brick Category</a></li>
			
			<li <?php if (strtolower($this->uri->segment(1)) == 'machine_types') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>machine_types/index">Machine</a></li>
			
			<li <?php if (strtolower($this->uri->segment(1)) == 'sardar_types') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>sardar_types/index">Sardar Type</a></li>
			
			<li <?php if (strtolower($this->uri->segment(1)) == 'sardars') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>sardars/index">Sardars Information</a></li>

			<li <?php if (strtolower($this->uri->segment(1)) == 'vendors') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>vendors/index">Vendor Information</a></li>
		</ul>
	</li>


	<li class="submenu">
		<a <?php if (array_search(strtolower($this->uri->segment(1)), array("a" => "purchases","b" => "expenses","c" => "rawbricks", "d" => "advance_payments")) != '') {
			echo 'class="active"';
		} ?> href="#"><i class="fa fa-fw fa-th"></i> <span> Process </span> <span class="menu-arrow"></span></a>
		<ul class="list-unstyled">
			<li <?php if (strtolower($this->uri->segment(1)) == 'purchases') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>purchases/index">Purchase</a></li>

			<li <?php if (strtolower($this->uri->segment(1)) == 'rawbricks') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>rawbricks/index">Raw Bricks</a></li>
			
			<li <?php if (strtolower($this->uri->segment(1)) == 'advance_payments') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>advance_payments/index">Advance Payment</a></li>
			
			<li <?php if (strtolower($this->uri->segment(1)) == 'expenses') {
				echo 'class="active"';
			} ?>><a href="<?php echo base_url(); ?>expenses/index">Expense</a></li>
		</ul>
	</li>


	,<!--<li class="submenu">
		<a href="#"><i class="fa fa-fw fa-tv"></i> <span> User Interface </span> <span class="menu-arrow"></span></a>
		<ul class="list-unstyled">
			<li><a href="ui-alerts.html">Alerts</a></li>
			<li><a href="ui-buttons.html">Buttons</a></li>
			<li><a href="ui-cards.html">Cards</a></li>
			<li><a href="ui-carousel.html">Carousel</a></li>
			<li><a href="ui-collapse.html">Collapse</a></li>
			<li><a href="ui-icons.html">Icons</a></li>
			<li><a href="ui-modals.html">Modals</a></li>
			<li><a href="ui-tooltips.html">Tooltips and Popovers</a></li>
		</ul>
	</li>

	<li class="submenu">
		<a href="#"><i class="fa fa-fw fa-file-text-o"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
		<ul class="list-unstyled">
			<li><a href="forms-general.html">General Elements</a></li>
			<li><a href="forms-select2.html">Select2</a></li>
			<li><a href="forms-validation.html">Form Validation</a></li>
			<li><a href="forms-text-editor.html">Text Editors</a></li>
			<li><a href="forms-upload.html">Multiple File Upload</a></li>
			<li><a href="forms-datetime-picker.html">Date and Time Picker</a></li>
			<li><a href="forms-color-picker.html">Color Picker</a></li>
		</ul>
	</li>



	<li class="submenu">
		<a href="#"><i class="fa fa-fw fa-image"></i> <span> Images and Galleries </span> <span
				class="menu-arrow"></span></a>
		<ul class="list-unstyled">
			<li><a href="media-fancybox.html"><span class="label radius-circle bg-danger float-right">cool</span>
					Fancybox </a></li>
			<li><a href="media-masonry.html">Masonry</a></li>
			<li><a href="media-lightbox.html">Lightbox</a></li>
			<li><a href="media-owl-carousel.html">Owl Carousel</a></li>
			<li><a href="media-image-magnifier.html">Image Magnifier</a></li>

		</ul>
	</li>

	<li class="submenu">
		<a href="#"><span class="label radius-circle bg-danger float-right">20</span><i
				class="fa fa-fw fa-copy"></i><span> Example Pages </span></a>
		<ul class="list-unstyled">
			<li><a href="page-pricing-tables.html">Pricing Tables</a></li>
			<li><a target="_blank" href="page-coming-soon.html">Countdown</a></li>
			<li><a href="page-invoice.html">Invoice</a></li>
			<li><a href="page-login.html">Login / Register</a></li>
			<li><a href="page-blank.html">Blank Page</a></li>
		</ul>
	</li>

	<li class="submenu">
		<a href="#"><span class="label radius-circle bg-primary float-right">9</span><i
				class="fa fa-fw fa-indent"></i><span> Menu Levels </span></a>
		<ul>
			<li>
				<a href="#"><span>Second Level</span></a>
			</li>
			<li class="submenu">
				<a href="#"><span>Third Level</span> <span class="menu-arrow"></span> </a>
				<ul style="">
					<li><a href="#"><span>Third Level Item</span></a></li>
					<li><a href="#"><span>Third Level Item</span></a></li>
				</ul>
			</li>
		</ul>
	</li>!-->
</ul>
