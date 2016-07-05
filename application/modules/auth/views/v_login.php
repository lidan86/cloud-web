<div id="loginPage">
	<?php
		echo $template['partials']['message'];
		//echo(!empty($message) ? "<div class='alert alert-danger center'>$message</div>" : '');
		echo form_open('login', 'id="login-form"');
	?>
        <p class="text-primary">Username</p>
	<div class="input-group">
		<span class="input-group-addon">
			<span class="icon-user"></span>
		</span>
	<?php
		echo form_input('identity', set_value('identity'), 'class="form-control" placeholder= "' . t('usernamePH') . '"');
	?>
	</div>

	<?php
//		echo form_label(t('password'), 'password');
	?>
        <p class="text-primary">Password</p>
	<div class="input-group">
		<span class="input-group-addon">
			<span class="icon-key"></span>
		</span>
	<?php
		echo form_password('password', set_value('password'), 'class="form-control" placeholder= "' . t('passwordPH') . '"');
	?>
	</div>

	<div class="text-right margin-top-10">
		<a href="/icore/auth/forgot_password">
                    <p class="text-primary">Lost Password </p>
                    <?php // echo t('lostpass'); ?></a>
		<button type="submit" class="btn btn-success btn-sm" style="font-weight: bold"><?php echo t('login') ?></button>
	</div>
	<?php
		echo form_close();
	?>
        
            <div>
<!--                <p class="text-primary">For Demo Only</p>-->
<!--                <p class="text-primary">|UserName|Password|</p>-->
<!--                <p class="text-primary">|requester|requester|</p>-->
<!--                <p class="text-primary">|cmdb|cmdb01|</p>-->
<!--                <p class="text-primary">|prodev|prodev|</p>-->
<!--                <p class="text-primary">|capacity|capacity|</p>-->
<!--                <p class="text-primary">|dcm|dcmdcm|</p>-->
<!---->
<!--				<p class="text-primary">For CVP Demo Only</p>-->
<!--				<p class="text-primary">|UserName|Password|</p>-->
<!--				<p class="text-primary">|cmdb|cmdb01|</p>-->
<!--				<p class="text-primary">|capacity|capacity|</p>-->
<!--				<p class="text-primary">|itplan|itplan|</p>-->
<!--				<p class="text-primary">|networkengineer|networkengineer|</p>-->
<!--				<p class="text-primary">|brmbrm|brmbrm|</p>-->
<!--				<p class="text-primary">|netplan|netplan|</p>-->
<!--				<p class="text-primary">|prodev|prodev|</p>-->
            </div>
</div>



