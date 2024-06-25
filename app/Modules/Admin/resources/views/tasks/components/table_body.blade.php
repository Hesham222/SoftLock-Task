@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->name}}</td>
    <td>{{$record->status == 1 ? "Encrypted":"Decrypted"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        <div>

            <a
                href="{{route('admins.task.download',$record->id)}}"
                id="button" class="btn btn-sm btn-primary">
                <i class="fa fa-download" style="color: #fff"></i>
            </a>

        </div>
    </td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="Restore"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.task.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.task.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
{{--            <a--}}
{{--                href="{{route('admins.task.decrypt',$record->id)}}"--}}
{{--                id="button"--}}
{{--                @if($record->status==1) title="Decrypt" class="btn btn-sm btn-accent" @else title="Encrypt" class="btn btn-sm btn-primary" @endif>--}}
{{--                <i class="fa fa-fire" style="color: #fff"></i>--}}
{{--            </a>--}}
            <form action="{{ route('admins.task.decrypt',$record ->id) }}" method="post" style="display: inline-block">
                @csrf
                <button type="submit"   @if($record->status==1) title="Decrypt" class="btn btn-sm btn-accent" @else disabled  title="Decrypted" class="btn btn-sm btn-dark" @endif ><i class="fa fa-fire" style="color: #fff"></i></button>
            </form>
            <a
            class="btn btn-sm btn-danger"
            title="Remove"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.task.trash')}}', 'confirm-password-form', 'POST')" >
            <i class="fa fa-trash" style="color: #fff"></i>
            </a>
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
