<x-html.select name='role_id' :list="$roles"
                :selected="old('role_id')"
                :label="trans('inputs.select-data', ['data' => trans('menu.roles')])" />