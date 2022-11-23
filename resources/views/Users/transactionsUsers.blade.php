<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 CRUD Application - ItSolutionStuff.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    
<div class="container">
    <h1 class="text-center">Transactions Client: {{ $data['clientId'] }}</h1>
    <button class="btn btn-primary"><a style="text-decoration: none; color:white" href="javascript:history.back()">Back</a></button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction Type ID</th>
                <th>Transacion Status ID</th>
                <th>Transaction Currency ID</th>
                <th>Transaction Source ID</th>
                <th>Transaction Detail</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @if($data['result'] != null)
                @foreach($data['result'] as $key => $value)
                    <tr>
                        <td>{{ $value['transaction_type_id'] }}</td>
                        <td>{{ $value['transaction_status_id'] }}</td>
                        <td>{{ $value['transaction_currency_id'] }}</td>
                        <td>{{ $value['transaction_source_id'] }}</td>
                        <td>{{ $value['transaction_detail'] }}</td>
                        <td>{{ $value['created_at'] }}</td>
                        <td>{{ $value['updated_at'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="text-center">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if($data['result'] != null)
        {!! $data['meta']['page'] !!}
    @endif
</div>
     
</body>
</html>