<p class="description">
	Settings for the social icons.
</p>
<form action="themes.php?page=theme-options&tab=social" method="post">
	<table class="form-table">
		{{socialRows}}
		<tr>
			<td style="vertical-align: top;"><b>RSS:</b></td>
			<td>
				Show link to your RSS feed?<br>
				<input type="checkbox" name="MITrss" value="1" class="toggle" id="rss" {{rssChecked}}>
				<label for="rss"></label>
			</td>
		</tr>
	</table>
	<p>
		<button class="button-primary">speichern</button>
	</p>
	<input type="hidden" name="MITprocess" value="social">
</form>