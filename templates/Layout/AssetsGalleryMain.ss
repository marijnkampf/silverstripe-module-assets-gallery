<% if CurrentFolder.ChildFolders %>
<div class="AssetsGallery_Folders">
<ul>
	<% control CurrentFolder.ChildFolders %>
		<li><a href="{$Top.Link}{$Path}">$getThumbnail.CroppedImage(200,150)<br/>$MenuTitle</a>
			<div class="info">
				<% if ChildFolders %>$ChildFolders.Count folder(s)<br/><% end_if %>
				<% if getFileCount %>$getFileCount item(s)<br/><% end_if %>
			</div>
		</li>
	<% end_control %>
</ul>
</div>
<% end_if %>

<div class="AssetsGallery_Files">
<ul>
	<% if CurrentFolder.Children %><% control CurrentFolder.Children  %><% if isFolder %><% else %>
		<li><a href="{$Link}{$Path}">$CroppedImage(200,150)<br/>$Title</a></li>
	<% end_if %><% end_control %><% end_if %>
</ul>
</div>
