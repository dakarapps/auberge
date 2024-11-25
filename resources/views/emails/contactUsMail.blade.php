<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME', 'CodexEco')}}</title>
</head>
<body>
    <p>Hello, Contact Message from <strong>{{ $mailData['name'] }}</strong></p>
    <table border="1">
    	<tr>
    		<th>Email:</th>
    		<td>{{ $mailData['email'] }}</td>
    	</tr>
    	<tr>
    		<th>Subject:</th>
    		<td>{{ $mailData['subject'] }}</td>
    	</tr>
    	<tr>
    		<th>Message:</th>
    		<td>{!! $mailData['body'] !!}</td>
    	</tr>
    </table>
</body>
</html>