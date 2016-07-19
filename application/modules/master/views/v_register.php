<div id="loginPage">
	<div class="row bs-reset">
		<div class="col-md-6 bs-reset">
			<div class="login-bg" style="background-image:url(<?php echo base_url().'_assets/assets/pages/img/login/bg1.jpg';?>)">
			</div>
		</div>

		<div class="col-md-6 login-container bs-reset">

			<div class="login-content">
				<?php if(empty($template['partials']['message'])){
					redirect("master/register");
				}
				echo $template['partials']['message'];

				?>
				<h1>Capacity Management Tools Sign Up</h1>
				<form method="post" action="<?php echo base_url().'index.php/master/register/signup'; ?> ">

				<div class="row">
					<div class="form-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Email LDAP</label>
							<div class="col-sm-9">
								<div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-envelope "></i>
                                                            </span>
									<input type="text" id="email" name="email" class="form-control" /> </div>
								<p class="help-block"> Email LDAP user</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 pull-right">
								<a class="btn red" href="<?php echo base_url().'login'; ?>">Login</a>
								<button class="btn blue" type="submit">Save</button>
							</div>
						</div>
				</div>

			</form>


			</div>
		</div>
<!---->
<!--		--><?php
//
//$x = rand(1,9);
//$queryx = $this->db->query("select * from ion_groups where id> 5");
//$sqlx = $queryx->result();
//?>
<!--<div class=container>-->
<!--	<div class=registration-block>-->
<!--		<div class="block block-white">-->
<!--			<div class="head tac">-->
<!--				<a href='--><?php //echo base_url();?><!--'><img src="--><?php //echo base_url() ?><!--_assets/images/logo.png"/></a>-->
<!--			</div>-->
<!--			<div class="content controls npt">-->
<!--				--><?php
//				if(empty($template['partials']['message'])){
//					redirect("master/register");
//				}
//				echo $template['partials']['message'];
//
//				?>
<!--				<form method="post" action="--><?php //echo base_url().'index.php/master/register/daftar'; ?><!-- ">-->
<!--				<div class=form-row>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class=icon-user></span>-->
<!--							</div>-->
<!--							<input type=text class=form-control required="required" name="first_name" placeholder="First Name"/>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class=icon-user></span>-->
<!--							</div>-->
<!--							<input type=text class=form-control required="required" name="last_name" placeholder="Second Name"/>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!---->
<!--				<div class=form-row style=margin-top:10px>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class=icon-key></span>-->
<!--							</div>-->
<!--							<input type=text class=form-control required="required" name="username" placeholder="Username"/>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class=icon-envelope></span>-->
<!--							</div>-->
<!--							<input type=email class="form-control" name="email" placeholder="E-mail"/>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class=form-row>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class=icon-lock></span>-->
<!--							</div>-->
<!--							<input type=password class=form-control required="required" name="password" placeholder="Password"/>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class=icon-unlock-alt></span>-->
<!--							</div>-->
<!--							<input type=password class=form-control required="required"  name="password_confirm" placeholder="Re-Password"/>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class=form-row>-->
<!--					<div class=col-md-6>-->
<!---->
<!--							<select class="form-control" name="group_id" >-->
<!--								--><?php
//								foreach ($sqlx as $row) {
//									echo("<option value='".$row->id."'>".$row->description." </option>");
//								}
//
//								?>
<!--							</select>-->
<!---->
<!--					</div>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class=icon-phone></span>-->
<!--							</div>-->
<!--							<input type="number" class=form-control required="required" name="mobile" placeholder="Handphone"/>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class=form-row>-->
<!--					<div class="col-md-6 ">-->
<!---->
<!--							<div class="pull-right"><img src="--><?php //echo base_url();?><!--_assets/images/cap.png"> <font style="color: #ff0000; font-size: 20px;"> --><?php //echo $x;?><!--</font> </div>-->
<!---->
<!--					</div>-->
<!--					<div class=col-md-6>-->
<!--						<div class=input-group>-->
<!--							<div class=input-group-addon>-->
<!--								<span class="icon-pencil"></span>-->
<!--							</div>-->
<!--							<input type="text" class=form-control name="cap" required="required" placeholder="Captcha"/>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--					<input type="hidden" name="cap1" value="--><?php //echo $x;?><!--">-->
<!---->
<!--				<div class=form-row>-->
<!--					<div class=col-md-6>-->
<!--						<button type="submit" class="btn btn-default btn-block btn-clean">Sign Up</button>-->
<!--					</div>-->
<!--					<div class=col-md-6>-->
<!--						<a href='--><?php //echo base_url()?><!--' class="btn btn-default btn-block btn-clean">Login</a>-->
<!--					</div>-->
<!--				</div>-->
<!--				</form>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
