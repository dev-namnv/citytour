<h2>Thông tin khách hàng</h2>
@foreach($users as $user)
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Họ tên</th>
            <th scope="col">Địa chỉ email</th>
            <th scope="col">Số điện thoại</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $user['first_name'] }} {{ $user['last_name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['phone'] }}</td>
        </tr>
        </tbody>
    </table>
@endforeach
<hr>
<h2>Thông tin tour</h2>
<p><strong>Tên tour: </strong>{{$tour->name}}</p>
<p><strong>Địa điểm khởi hành: </strong>{{$tour->origin}}</p>
@foreach($tour->batches as $batch)
    @if(\Carbon\Carbon::parse($batch->batch) >= \Carbon\Carbon::now() && \Carbon\Carbon::parse($batch->batch) < \Carbon\Carbon::now()->addDays(2) )
        <p><strong>Thời gian khởi hành: </strong>{{\Carbon\Carbon::parse($batch->batch)->format('d-m-Y')}}</p>
        @break
    @endif
@endforeach
