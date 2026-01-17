@forelse($users as $user)
<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->mobile }}</td>
    <td>{{ $user->address }}</td>
    <td>
        @if($user->trashed())
            <button class="btn btn-sm btn-warning btn-restore" data-id="{{ $user->id }}">Restore</button>
        @else
            <button class="btn btn-sm btn-info text-white btn-edit" data-id="{{ $user->id }}">Edit</button>
            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">Delete</button>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center">No users found.</td>
</tr>
@endforelse
