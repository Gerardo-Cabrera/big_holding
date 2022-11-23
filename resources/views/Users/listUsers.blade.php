<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 CRUD Application - ItSolutionStuff.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    
<div class="container">
    <h1 class="text-center">List Users</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($data))
                @foreach($data['result'] as $key => $value)
                    <tr>
                        <td>{{ $value['user_id'] }}</td>
                        <td>{{ $value['created_at'] }}</td>
                        <td>{{ $value['updated_at'] }}</td>
                        <td>
                            <button class="btn btn-info"><a style="text-decoration: none; color:white" href="{{ route('userTransactions', ['token' => $data['token'], 'client_id' => $value["user_id"]]) }}">View Info</a></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>
         
    {!! $data['meta']['page'] !!}
</div>
     
</body>
</html>