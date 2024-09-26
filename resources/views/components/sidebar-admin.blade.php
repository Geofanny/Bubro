<div class="sidebar pe-4 pb-3">
	<nav class="navbar bg-light navbar-light">
		<a href="index.html" class="navbar-brand mx-4 mb-3">
			<h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
		</a>
		<div class="d-flex align-items-center ms-4 mb-4">
			<div class="position-relative">
				<img class="rounded-circle" src="{{asset('img')}}/user.jpg" alt="" style="width: 40px; height: 40px;">
				<div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
			</div>
			<div class="ms-3">
				<h6 class="mb-0">Jhon Doe</h6>
				<span>Admin</span>
			</div>
		</div>
		<div class="navbar-nav w-100">
			<div class="navbar-nav w-100">
				<a href="/dashboard-admin" class="nav-item nav-link">
					<i class="fa fa-tachometer-alt me-2"></i>Dashboard
				</a>
				<div class="nav-item dropdown <?= request()->is('product-admin') || request()->is('category-admin') ? 'show' : '' ?>">
					<a href="#" class="nav-link dropdown-toggle <?= request()->is('product-admin') || request()->is('category-admin') ? 'active' : '' ?>" data-bs-toggle="dropdown" aria-expanded="<?= request()->is('product-admin') || request()->is('category-admin') ? 'true' : 'false' ?>">
						<i class="fa fa-warehouse me-2"></i>Inventory
					</a>
					<div class="dropdown-menu bg-light border-0 m-0 <?= request()->is('product-admin') || request()->is('category-admin') ? 'show' : '' ?>">
						<a href="/product-admin" class="dropdown-item <?= request()->is('product-admin') ? 'active' : '' ?>">
							<i class="fa fa-box me-2"></i>Product
						</a>
						<a href="/category-admin" class="dropdown-item <?= request()->is('category-admin') ? 'active' : '' ?>">
							<i class="fa fa-tags me-2"></i>Category
						</a>
					</div>
				</div>
				<div class="nav-item dropdown <?= request()->is('gallery-admin') || request()->is('event-admin') ? 'show' : '' ?>">
					<a href="#" class="nav-link dropdown-toggle <?= request()->is('gallery-admin') || request()->is('event-admin') ? 'active' : '' ?>" data-bs-toggle="dropdown" aria-expanded="<?= request()->is('gallery-admin') || request()->is('event-admin') ? 'true' : 'false' ?>">
						<i class="fa fa-th me-2"></i>Media
					</a>
					<div class="dropdown-menu bg-light border-0 m-0 <?= request()->is('gallery-admin') || request()->is('event-admin') ? 'show' : '' ?>">
						<a href="/gallery-admin" class="dropdown-item <?= request()->is('gallery-admin') ? 'active' : '' ?>">
							<i class="fa fa-image me-2"></i>Gallery
						</a>
						<a href="/event-admin" class="dropdown-item <?= request()->is('event-admin') ? 'active' : '' ?>">
							<i class="fa fa-calendar me-2"></i>Event
						</a>
					</div>
				</div>
			</div>

		</div>
	</nav>
</div>