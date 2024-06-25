@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->name}}</td>
    <td>{{$record->email}}</td>
    <td>{{$record->phone}}</td>
    <td>{{$record->privileges}}</td>
    <td>{{$record->createdBy ? $record->createdBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a 
        class="btn btn-sm btn-primary" 
        title="Restore" 
        data-toggle="modal" 
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.admin.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a 
            class="btn btn-sm btn-danger" 
            title="Destroy" 
            data-toggle="modal" 
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.admin.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a> 
    @else
        <a 
            href="{{route('admins.admin.edit',$record->id)}}" 
            title="Edit" 
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
        <a 
            class="btn btn-sm btn-primary"
            title="Reset Password"
            data-toggle="modal" 
            data-target="#reset-admin-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.admin.reset.password')}}', 'reset-admin-password-form', 'POST')"
            >
            <i class="fa fa-key" style="color: #fff"></i>
        </a>
        @if($record->id !==1 && $record->id != auth('admin')->user()->id)
            <a 
            class="btn btn-sm btn-danger" 
            title="Remove" 
            data-toggle="modal" 
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.admin.trash')}}', 'confirm-password-form', 'POST')" >
            <i class="fa fa-trash" style="color: #fff"></i>
            </a> 
        @endif
    @endif
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        There are no records match your inputs.
    </td>
</tr>
@endif