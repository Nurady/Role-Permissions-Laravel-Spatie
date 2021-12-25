<div>
    @can('create post')
        <div class="mb-4">
            <small class="d-block text-secondary mb-2 text-uppercase">Posts</small>
            <div class="list-group">
                <a href="{{ route('posts.create') }}" class="list-group-item list-group-item-action">
                    Create Post
                </a>
                <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action">All Posts</a>
            </div>
        </div>        
    @endcan

    @can('create category')
        <div class="mb-4">
            <small class="d-block text-secondary mb-2 text-uppercase">Categories</small>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    Create Category
                </a>
                <a href="#" class="list-group-item list-group-item-action">All Category</a>
            </div>
        </div>        
    @endcan

    @can('show users')
        <div class="mb-4">
            <small class="d-block text-secondary mb-2 text-uppercase">Users</small>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    Create User
                </a>
                <a href="#" class="list-group-item list-group-item-action">All Users</a>
            </div>
        </div>        
    @endcan

    @can('assign permission')
        <div class="mb-4">
            <small class="d-block text-secondary mb-2 text-uppercase">Role & Permission</small>
            <div class="list-group">
                <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action">Roles</a>
                <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action">Permissions</a>
                <a href="{{ route('assign.create') }}" class="list-group-item list-group-item-action">Assign Permission</a>
                <a href="{{ route('assign.user.create') }}" class="list-group-item list-group-item-action">Permission to User</a>
            </div>
        </div>        
    @endcan

    <div class="mb-4">
        <div class="list-group">
            <a class="list-group-item list-group-item-action" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>            
        </div>
    </div> 
</div>