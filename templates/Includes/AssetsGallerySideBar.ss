<nav class="secondary">
	<h3><a href="$Link">$Title</a></h3>
	<ul>
		<% with $Root %>
		<%--Include SidebarMenu recursively --%>
		<% include AssetsGallerySideBarMenu %>
		<% end_with %>
	</ul>
</nav>
