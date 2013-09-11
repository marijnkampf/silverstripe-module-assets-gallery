<% if $RootFolder.ChildFolders %>
<aside class="sidebar unit size1of4">
	<nav class="secondary">
		<ul>
			<% control $RootFolder %>
				<% include AssetsGallerySidebarMenu %>
			<% end_control %>
		</ul>
	</nav>
</aside>
<% end_if %>
