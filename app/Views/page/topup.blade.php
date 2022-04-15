@extends('main-page')
@section('content')
	<form action="{{ base_url }}check-user" method="post">
		<input type="hidden" name="game-id" value="{{ $game_id }}">
		<input type="text" name="user-id">
		<input type="text" name="zone-id">
		<button>Check user anjay</button>
	</form>

	@foreach($pricelist as $p)
		{{ $p->pulsa_code }} <br>
		{{ $p->pulsa_op }} <br>
		{{ $p->pulsa_nominal }} <br>
		{{ $p->pulsa_price }} <br>
		{{ $p->pulsa_type }} <br>
		{{ $p->masaaktif }} <br>
		{{ $p->status }} <br><br>
	@endforeach
@endsection