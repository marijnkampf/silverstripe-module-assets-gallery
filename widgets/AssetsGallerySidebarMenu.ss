<%--Include AssetsGallerySidebarMenu recursively --%>
<%-- if LinkOrSection = section --%>
	<% loop $ChildFolders  %>
		<li class="$LinkingMode">
			<a href="{$AbsoluteLink}" class="$LinkingMode" title="Go to the $Title.XML gallery page">
				<span class="arrow">&rarr;</span>
				<span class="text">$MenuTitle.XML</span>
			</a>
			<% if $ChildFolders %>
				<ul>
					<% include AssetsGallerySidebarMenu %>
				</ul>
			<% end_if %>
		</li>
	<% end_loop %>
<%-- end_if --%>
