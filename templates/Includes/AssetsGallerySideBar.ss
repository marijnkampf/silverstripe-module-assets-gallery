<nav class="secondary">
	<h3><a href="$Link">$Title</a></h3>
	<ul>
		<% control RootFolder.ChildFolders %>
		<li class="$LinkingMode">
			<a href="$AbsoluteLink" class="$LinkingMode" title="Go to the $MenuTitle page">
				<span class="text">$MenuTitle</span>
			</a>
			<% if ChildFolders %>
				<ul>
				<% control ChildFolders %>
					<li class="$LinkingMode">
						<a href="$AbsoluteLink" class="$LinkingMode" title="Go to the $MenuTitle page">
							<span class="text">$MenuTitle</span>
						</a>
						<% if ChildFolders %>
							<ul>
							<% control ChildFolders %>
								<li class="$LinkingMode">
									<a href="$AbsoluteLink" class="$LinkingMode" title="Go to the $MenuTitle page">
										<span class="text">$MenuTitle</span>
									</a>
									<% if ChildFolders %>
										<ul>
										<% control ChildFolders %>
											<li class="$LinkingMode">
												<a href="$AbsoluteLink" class="$LinkingMode" title="Go to the $MenuTitle page">
													<span class="text">$MenuTitle</span>
												</a>
												<% if ChildFolders %>
													<ul>
													<% control ChildFolders %>
														<li class="$LinkingMode">
															<a href="$AbsoluteLink" class="$LinkingMode" title="Go to the $MenuTitle page">
																<span class="text">$MenuTitle</span>
															</a>
															<% if ChildFolders %>
																<ul>
																	Add more levels to template
																</ul>
															<% end_if %>
														</li>
													<% end_control  %>
													</ul>
												<% end_if %>
											</li>
										<% end_control  %>
										</ul>
									<% end_if %>
								</li>
							<% end_control  %>
							</ul>
						<% end_if %>
					</li>
				<% end_control  %>
				</ul>
			<% end_if %>
		</li>
		<% end_control %>
	</ul>
</nav>
