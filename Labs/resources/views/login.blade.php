<style>
    /* Thiết lập font chung */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    /* Phần danh sách người dùng */
    .danhsach {
        flex: 1;
        margin-right: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .danhsach table {
        width: 100%;
        border-collapse: collapse;
    }

    .danhsach th, .danhsach td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .danhsach th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .danhsach td:last-child {
        text-align: center;
    }

    .Detail, .Detail1 {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .Detail {
        background-color: #4CAF50;
        color: white;
    }

    .Detail1 {
        background-color: #f44336;
        color: white;
    }

    .Detail:hover, .Detail1:hover {
        background-color: #3e8e41;
    }

    /* Phần thông tin cá nhân */
    .thongtincanhan {
        flex: 1;
        margin-right: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .thongtincanhan h1 {
        margin-bottom: 10px;
    }

    .thongtincanhan p {
        margin-bottom: 5px;
    }

    /* Phần bài viết */
    .post {
        flex: 1;
        margin-right: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .post h1 {
        margin-bottom: 10px;
    }

    .post p {
        margin-bottom: 5px;
    }

    /* Phần sở thích */
    .fav {
        flex: 1;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .fav h1 {
        margin-bottom: 10px;
    }

    .fav p {
        margin-bottom: 5px;
    }





</style>

<div class="container">
    <div class="header">
        <h1>User Management System</h1>
        <p>{{ session()->get('mess') }}</p>
    </div>

    <div class="content">
        <div class="section danhsach">
            <h2>User List</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $nguoidung)
                    <tr>
                        <td>{{ $nguoidung->id }}</td>
                        <td>{{ $nguoidung->name }}</td>
                        <td>{{ $nguoidung->email }}</td>
                        <td>
                            <form action="{{ route('submit') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $nguoidung->id }}">
                                <button class="button Detail" type="submit">Details</button>
                            </form>
                            <form action="{{ route('submit_delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $nguoidung->id }}">
                                <button class="button button-danger Detail1" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="section thongtincanhan">
            @if(session()->has('profile'))
                <h2>Personal Information</h2>
                <p><strong>ID:</strong> {{ session('profile')->user_profile_id }}</p>
                <p><strong>First Name:</strong> {{ session('profile')->first_name }}</p>
                <p><strong>Last Name:</strong> {{ session('profile')->last_name }}</p>
                <p><strong>Gender:</strong> {{ session('profile')->sex == 0 ? 'Female' : 'Male' }}</p>
                <p><strong>Phone:</strong> {{ session('profile')->phone }}</p>
                <p><strong>Address:</strong> {{ session('profile')->address }}</p>
            @endif
        </div>

        <div class="section post">
            @if(session()->has('result'))
                <h2>Posts</h2>
                @if(!session()->get('result')->isEmpty())
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(session()->get('result') as $post)
                            <tr>
                                <td>{{ $post->post_id }}</td>
                                <td>{{ $post->post_name }}</td>
                                <td>{{ $post->post_description }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>(This user hasn't posted anything yet)</p>
                @endif
            @endif
        </div>

        <div class="section fav">
            @if (session()->has('sothich'))
                <h2>Favorites</h2>
                @php
                    $favorites = json_decode(session()->get('sothich'));
                @endphp
                @if(!empty($favorites))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Fav_ID</th>
                            <th>Fav_Name</th>
                            <th>Fav_Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($favorites as $favorite)
                            <tr>
                                <td>{{ $favorite->favorite_id }}</td>
                                <td>{{ $favorite->favorite_name }}</td>
                                <td>{{ $favorite->favorite_description }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>(This user doesn't have any favorites yet)</p>
                @endif
            @endif
        </div>
    </div>
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
