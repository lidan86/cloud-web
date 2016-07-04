		<!-- main ends -->	
		</div>
		
		<!-- sidebar starts -->
		<div id="sidebar">
			<?php
			if(stristr($this->uri->uri_string(),'/admin'))
			{
				$this->load->view($skin.'/admin/menu');
			}
			else
			{
				$this->load->view($skin.'/menu');
			}
			?>		
		<!-- sidebar ends -->		
		</div>
		
	<!-- content-wrap ends-->	
	</div>
		
	<!-- footer starts here -->	
	<div id="footer-wrap"><div id="footer-content">
	
		<div class="col float-left space-sep">
			<? if($this->startup->site_config['show_recent_uploads']){?>
			<h3><?php echo $this->lang->line('global_recently_uploaded_files')?></h3>
			<ul class="col-list">
			<?php 
			$query = $this->files_db->getRecentFiles(5);
			foreach($query->result() as $file)
			{
				$links = $this->files_db->getLinks('', $file);
				?>	<li>
						<a href="<?php echo $links['down'];?>">
							<img src="<?php echo base_url().'img/files/'.$this->functions->getFileTypeIcon($file->type);?>" class="nb" alt="" />
							<?php echo $this->functions->elipsis($file->o_filename, 10);?>
						</a>
					</li>
				<?php
			}
			?>
			</ul>
			<? }?>
		</div>
		
		<div class="col float-left">
			
		</div>		
	
		<div class="col2 float-right">
		
			<h3><?php echo $this->lang->line('global_footer_about')?></h3>			
			
			<p>
			<a href="http://xtrafile.com"><img src="<?=$base_url?>images/thumb.gif" width="50" height="50" alt="icon" class="float-left" /></a>
			<a href="http://xtrafile.com/products/xtraupload-v2/"><?php echo $this->lang->line('global_xtraupload_v2')?></a> 
			<?php echo $this->lang->line('global_footer_about_text1')?> <a href="http://xtrafile.com/products/xtraupload-v2/"><?php echo $this->lang->line('global_xtraupload_v2')?></a> <?php echo $this->lang->line('global_footer_about_text2')?> <a href="http://www.codeigniter.com"><?php echo $this->lang->line('global_codeigniter')?></a> <?php echo $this->lang->line('global_footer_about_text3')?></p>
			
			<p>
			<?php echo $this->lang->line('global_copyright')?> 2006 - <?=date('Y')?> <a href="http://xtrafile.com"><strong><?php echo $this->lang->line('global_xtrafile')?></strong></a><br /> 
			
			
			<?php echo $this->lang->line('global_design')?> <a href="http://styleshout.com">styleshout</a><br />
			
			<a href="<?=site_url('legal/tos')?>">Terms Of Service</a> | 
			<a href="<?=site_url('legal/privacy')?>">Privacy Policy</a><br />
			
			<?php echo $this->lang->line('global_valid')?> <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | 
		   	   <a href="http://validator.w3.org/check/referer">XHTML</a> - 
			   <a href="javascript:;" onclick="$('#debug').toggle('fast')"><?php echo $this->lang->line('global_debug')?></a> 
			   <span style="color:#FF0000; display:none" id="debug">
			       <?php echo $this->lang->line('global_execution')?> <?=$this->benchmark->elapsed_time()?><br />
				   <?php echo $this->lang->line('global_memory')?> <?=round(memory_get_usage() / 1024)?>KB
			   </span>
			</p> 
		</div>		
			
	</div></div>
	<div class="clearer"></div>
	<!-- footer ends here -->

<!-- wrap ends here -->
</div>
<script type="text/javascript">
$(document).ready(function()
{
	$('input, textarea').bind('focus', function()
	{
		$(this).animate({backgroundColor:"#101010"}, "fast");
	});
	$('input, textarea').bind('blur', function()
	{
		$(this).animate({backgroundColor:"#070707"}, "fast");
	});
	$("a[@rel='external']").attr('target', '_blank');
	if($.browser.opera)
	{
		$(".pasteButton").remove();
	}
});
</script>
<? $this->load->view('_protected/global_footer');?>
</body>
</html>