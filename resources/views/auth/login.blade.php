@extends('layouts.base')

@section('content')
	<div class="container">
		<div class="row">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">Login</div>
					<div class="panel-body">
						{!! Form::open(['route' => 'auth/login', 'class' => 'form']) !!}
						<div class="form-group">
							<label>Email</label>
							{!! Form::email('email', '', ['class'=> 'form-control']) !!}
						</div>
						<div class="form-group">
							<label>Password</label>
							{!! Form::password('password', ['class'=> 'form-control']) !!}
						</div>
						<div class="checkbox">
							<label><input name="remember" type="checkbox"> Remember me</label>
						</div>
						<div>
							{!! Form::submit('login',['class' => 'btn btn-primary']) !!}
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
