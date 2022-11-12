<div class="float-right overflow-hidden">
    @if (Route::has($menu->route))
        <a href="{{ routeHelper($menu->route) }}" class="btn btn-sm btn-outline-purple" data-toggle="tooltip" title="Show Page">
            <i class="fa fa-eye"></i>
        </a>
    @endif

    @if (canUser("menus-edit"))
        <a href="{{ routeHelper('menus.edit', $menu->id) }}" class="btn btn-sm btn-outline-primary show-modal-form" data-toggle="tooltip" title="Edit This Menu">
            <i class="fa fa-edit"></i>
        </a>
    @endif

    @if (canUser("menus-create"))
        <a href="{{ routeHelper('menus.subs.create', $menu->id) }}" class="btn btn-sm btn-outline-info show-modal-form" data-toggle="tooltip" title="Create Sub Menu">
            <i class="fa fa-plus"></i>
        </a>
    @endif

    @if (canUser("menus-destroy"))
        <form action="{{ routeHelper('menus.destroy', $menu->id) }}" method="POST" class="form-destroy d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-outline-danger delete" data-toggle="tooltip" title="Delete This Menu">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endif

    @if ((isset($menu->parent) && $menu->parent->visible) || ! $menu->parent)
        <form action="{{ routeHelper('menus.toggle.visible', $menu->id) }}" method="POST" class="d-inline">
            @csrf
            @if ($menu->visible)
                <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Make Menu Is Hidden">
                    <i class="fa fa-eye-slash"></i>
                </button>
            @else
                <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="Make Menu Is Visible">
                    <i class="fa fa-eye"></i>
                </button>
            @endif
        </form>
    @else
        <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="First Parent Must Be Visible">
            <i class="fa fa-hand"></i>
        </button>
    @endif

</div>
