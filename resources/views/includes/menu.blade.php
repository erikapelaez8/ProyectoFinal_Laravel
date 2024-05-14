<div class="card">
    <div class="card-header">{{ __('Menu') }}</div>

    <div class="card-body">
        <!-- Menú -->
        <ul class="nav flex-column">
            @if (auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link active" href="#">Bienvenido</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categorías</a>
                </li>
            @endif
        </ul>
    </div>
</div>
