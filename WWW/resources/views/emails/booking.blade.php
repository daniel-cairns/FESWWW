<body>
	<p>Hi there {{ $firstName }} {{ $lastName }}! </p>

	<p>We are please to confirm that your booking has been submitted and and an account has been setup with username of {{ $firstName }}{{ $lastName }}.</p>

	<p>Your Package {{ $subbrand }} {{ $package }} on {{ $date }} at {{ $address }} is currently being handled. We will be in touch as soon as we can to confirm availability for this day.</p>
	
	<p>You can access your new account <a href="http://faredgestudios.co.nz/main.htm">here<a></p>

	<p>Your password is {{ $password }}</p>

	<p>Your comments:</p>

	<p>{{ $comments }}</p>
	
</body>
