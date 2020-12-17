<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Họ tên</th>
        <th scope="col">Địa chỉ email</th>
        <th scope="col">Xác thực tài khoản</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->getFullName() }}</td>
        <td>{{ $user->email }}</td>
        <td><a href="{{ route('user.detail', ['id' => $user->id]) }}">Xác thực</a></td>
    </tr>
    </tbody>
</table>
