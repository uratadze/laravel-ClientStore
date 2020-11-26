@extends('layouts.app')
<title>@lang('Orders')</title>

@section('content')

<div class="card-body">  
    <form action="" method="GET" id="form1">       
        <input placeholder=@lang("საწყისი თარიღი") name="from" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" style="margin-left: 20px"/>
        <input placeholder=@lang("საბოლოო თარიღი") name="till" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date1" style="margin-left: 10px"/>
        <button type="submit" class="btn btn-secondary">@lang('ჩვენება')</button>
    </form>
</div>

<table class="table table-striped table-bordered datatable dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" >
    {{-- columns --}}
    <thead>
        <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username: activate to sort column descending">
                <center><p class="size">@lang('დასახელება')</p></center>
            </th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date registered: activate to sort column ascending">
                <center><p class="size">@lang('რაოდენობა') </p></center>
            </th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending">
                <center><p class="size">@lang('ტელეფონის ნომერი')</p></center>
            </th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending">
                <center><p class="size">@lang('მისამართი')</p></center>
            </th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending">
                <center><p class="size">@lang('სტატუსი')</p></center>
            </th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending">
                <center><p class="size">@lang('თარიღი')</p></center>
            </th>
        </tr>
    </thead>   

    {{-- items --}}
    <tbody>
        @forelse ($orders as $order)
            <tr role="row" class="odd">
                <td><center>{{ $order->getProduct->name }}</center></td>
                <td><center>{{ $order->quantity }}</center></td>
                <td><center>{{ $order->getPerson->number }}</center></td>
                <td><center>{{ $order->getPerson->Address }}</center></td>
                <td>
                    <center>
                        @if($order->status == 0)
                            @php $buttonCollor = 'danger' @endphp
                        @elseif($order->status == 1)
                            @php $buttonCollor = 'warning' @endphp
                        @else
                            @php $buttonCollor = 'success' @endphp
                        @endif
                        <span class="badge badge-{{$buttonCollor}}">{{ $order->getStatus() }}</span>
                    </center>
                </td>
                <td><center>{{ $order->created_at }}</center></td>
            </tr>
        @empty
            <td colspan=6><center>@lang('Empty')</center></td>
        @endforelse
    </tbody>
</table>

{{-- paginate --}}
{{ $orders->appends(Request::except('page'))->links() }}

@endsection