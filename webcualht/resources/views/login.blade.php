<style>
    .Detail{
        color: white;
        background-color: green;
        border-radius: 10%;
        border: 0;
    }
    .Detail1{
        color: white;
        background-color: red;
        border-radius: 10%;
        border: 0;
    }
    .danhsach {
        position: fixed;
        top: 38px;
    }
    .thongtincanhan{
        position: fixed;
        left: 350px;
    }
    .post{
        position: absolute;
        left: 750px;
    }
    .fav{
        position: absolute;
        left: 1150px;
    }

</style>

        <p>{{session()->get('mess')}}</p>
<div class="danhsach">
    <table border="1">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Func</th>
        @foreach($users as $nguoidung)
            <tr>
                <td>{{ $nguoidung->id }}</td>
                <td>{{ $nguoidung->name }}</td>
                <td>{{ $nguoidung->email }}</td>
                <td>
                    <form action="{{ route('submit') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value={{ $nguoidung->id }}>
                        <button class="Detail" type="submit">Details</button>
                    </form>
                    <form action="{{ route('submit_delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value={{ $nguoidung->id }}>
                        <button class="Detail1" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<div class="thongtincanhan">
    @if(session()->has('profile'))
        <h1>THÔNG TIN CÁ NHÂN:</h1>
        <p>Mã: {{session('profile')->user_profile_id}}</p>
        <p>Họ: {{session('profile')->first_name}}</p>
        <p>Tên: {{session('profile')->last_name}}</p>
        @if(session('profile')->sex == 0)
            <p>Giới tính: Nữ</p>
        @else
            <p>Giới tính: Nam</p>
        @endif
        <p>Số điện thoại: {{session('profile')->phone}}</p>
        <p>Địa chỉ: {{session('profile')->address}}</p>
    @endif
</div>

<div class="post">
    @if(session()->has('result'))
        <h1>POSTS:</h1>
        @if(!session()->get('result')->isEmpty())
            <table border="1">
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                @foreach(session()->get('result') as $post)
                    <tr>
                        <td>{{$post->post_id}}</td>
                        <td>{{$post->post_name}}</td>
                        <td>{{$post->post_description}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>(Người này chưa đăng)</p>
        @endif
    @endif
</div>

<div class="fav">
    @if (session()->has('sothich'))
        <h1>SỞ THÍCH:</h1>
        @php
            $favorites = json_decode(session()->get('sothich'));
        @endphp
        @if(!empty($favorites))
            <table border="1">
                <th>Fav_ID</th>
                <th>Fav_Name</th>
                <th>Fav_Description</th>
                @foreach($favorites as $favorite)
                    <tr>
                        <td>{{ $favorite->favorite_id }}</td>
                        <td>{{ $favorite->favorite_name }}</td>
                        <td>{{ $favorite->favorite_description }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>(Người này chưa có sở thích)</p>
        @endif
    @endif
</div>





{{--@if(session()->has('result'))--}}
{{--    <p>POST</p>--}}
{{--    <p>Người đăng: {{session()->get('result')}}</p>--}}
{{--    @php--}}
{{--        $result = session()->get('result');--}}
{{--    @endphp--}}
{{--    @if($result->isEmpty())--}}
{{--        <p>(Người này chưa đăng)</p>--}}
{{--    @else--}}
{{--        @foreach($result as $post)--}}
{{--            {{$post->post_name}}--}}
{{--        @endforeach--}}
{{--    @endif--}}
{{--    @else--}}
{{--    <p>cai nay else</p>--}}
{{--@endif--}}
