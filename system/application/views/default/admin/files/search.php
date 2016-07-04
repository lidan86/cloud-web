<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/documents_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('files_search_headertitle'); ?></h2>
<form action="<?=site_url('admin/files/search')?>" onsubmit="submitSearch(); return false;"  method="get">
	<p>
		<label><?php echo $this->lang->line('files_search_searchlabel'); ?></label>
		<input type="text" name="query" id="search" value="" /><br /><br />
		
		<?=generateLinkButton($this->lang->line('files_search_searchbutton'), 'javascript:;', base_url().'img/icons/search_16.png', NULL, array('onclick' => 'submitSearch();'))?><br />
	</p>
</form>
<script>
function submitSearch()
{
	if($('#search').val() != '')
	{
		window.location = '<?=site_url('admin/files/search')?>/'+escape($('#search').val());
	}
}
</script>