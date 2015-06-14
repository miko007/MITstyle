<form action="themes.php?page=theme-options" method="post">
	<table class="form-table">
		<tr>
			<td><b>Logo</b></td>
			<td>
				<b>aktuelles Logo</b><br>
				<p class="MITlogo" id="MITlogo" rel="kein Logo ausgewählt">
					{{logoDisplay}}
				</p>
				<div class="uploader">
					<input id="MITlogoField" name="MITlogoURL" type="text" value="{{logoURL}}" style="display: none;" />
					<button class="button-primary" id="MITuploadButton" name="MITlogo">auswählen</button>
					<button class="button" id="MITremoveLogo">Logo entfernen</button>
				</div>
			</td>
		</tr>
		<tr>
			<td><b>Farbschema</b></td>
			<td>
				<select name="MITcolors">
					{{schemesList}}
				</select>
			</td>
		</tr>
	</table>
	<p>
		<button class="button-primary">speichern</button>
	</p>
	<input type="hidden" name="MITprocess" value="start">
</form>