@extends('layouts.master')

@section('content')
	<div class="welcome">
		<table class='table'>
		<tr>
			<th>UID</th>
			<th>Networks</th>
			<th>Hostnames</th>
			<th></th>
		</tr>
		@foreach ($networks as $network)
			<tr>
				<td>{{$network["uid"]}}</td>
				<td>
					@foreach ($network["networks"] as $i => $n)
						<div>{{$i+1}} - Name: {{$n["n_name"]}}, IP: {{$n["n_ip"]}}, Status: {{$n["n_status"]}}</div>
					@endforeach
				</td>
				<td>
					@foreach ($network["hostnames"] as $i => $h)
						<div>{{$i+1}} - Name: {{$h["hostname"]}}, Block: {{$h["block"]}}</div>
					@endforeach
				</td>
				<td><a href="{{$url}}/get/{{$network['_id']}}">Update</a> | <a href="{{$url}}/delete/{{$network['_id']}}">Delete</a></td>
			</tr>
			
			
		@endforeach
		</table>
		<a href="{{$url}}/get/0" class="btn btn-primary btn-lg active" role="button">Add</a>
	</div>

@stop
