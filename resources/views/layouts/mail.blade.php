<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ $subject }}</title>
</head>
<body>
	<p>Hi {{ $full_name }},</p>

	@yield('content')

	<p>Terima kasih.</p>

</body>
</html>