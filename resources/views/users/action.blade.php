<div class="btn-group">
    <button class="btn btn-secondary" type="button">{{ __('Action') }}</button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle
            Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i></a>
        @can('edit-user')
            <a href="{{ route('users.edit', $user->id) }}" class=" dropdown-item"> <i class="cil-pencil action-btn"></i>
                {{ __('Edit') }}</a>
        @endcan
        <div class="dropdown-divider"></div>
        @can('delete-user')
            <a href="{{ route('users.index') }}" class="dropdown-item  text-danger " data-toggle="tooltip"
                data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $user->id }}')"><i
                    class="cil-trash action-btn"></i>{{ __('Delete') }}</a>
            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'id' => 'delete-form-' . $user->id]) !!}
            {!! Form::close() !!}
        @endcan
    </div>
</div>
