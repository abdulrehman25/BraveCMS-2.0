<div class="sidebar card shadow-sm">
	<div class="card-header px-2">{{ __('Sidebar') }}</div>
	<div class="card-body p-0">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<a class="{{ request()->routeIs('dashboard.articles*') ? 'active' : '' }}" href="{{ route('dashboard.articles') }}">
					Articles
					<span class="badge">2</span>
				</a>
			</li>
			<li class="list-group-item">
				<a class="{{ request()->routeIs('dashboard.categories*') ? 'active' : '' }}" href="{{ route('dashboard.categories') }}">
					Categories
					<span class="badge">3</span>
				</a>
			</li>
			<li class="list-group-item">
				<a href="#">
					Comments
					<span class="badge">5</span>
				</a>
			</li>
		</ul>
	</div>
</div>