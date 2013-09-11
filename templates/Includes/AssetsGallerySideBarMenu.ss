<%--Include SidebarMenu recursively --%>
<% if $ChildFolders %>
	<% loop $ChildFolders %>
		<li class="$LinkingMode">
			<a href="$AbsoluteLink" class="$LinkingMode" title="Go to the $MenuTitle.XML page">
				<span class="text">$MenuTitle.XML</span>
			</a>
			<% if $ChildFolders %>
				<ul>
					<% include AssetsGallerySideBarMenu %>
				</ul>
			<% end_if %>

		</li>
	<% end_loop %>
<% end_if %>


