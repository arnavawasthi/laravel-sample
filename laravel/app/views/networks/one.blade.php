@extends('layouts.master')

@section('content')
	<div>
		<form action="{{$url}}/update/{{$network['_id']}}" method="post">
			<table class="table">
				<tr>
					<td>uid:</td>
					<td><div><input type="text" name="uid" value="{{$network['uid']}}"/></div></td>
						
				</tr>
				<tr>
					<td>networks:</td>
					<td>
						<div>
							<div id="networks"> 
							@foreach ($network['networks'] as $i => $n) 
								<div class="network">id: <input class="nid" name="nid[{{$i}}]" value="{{$n['nid']}}">, name: <input class="nname" name="n_name[{{$i}}]" value="{{$n['n_name']}}">, ip: <input class="nip" name="n_ip[{{$i}}]" value="{{$n['n_ip']}}">, status: <input class="nstatus" type="checkbox" @if ($n['n_status'] == 1) checked='checked' @endif name="n_status[{{$i}}]" value="1"></div>			
							@endforeach
							</div>
							<a href="javascript:void(0);" id="addNetwork">Add network</a>
						</div>
					
					</td>
						
				</tr>
				<tr>
					<td>hostnames:</td>
					<td><div>
							<div id="hosts">
								@foreach ($network['hostnames'] as $i => $host) 
									<div class="host">name: <input class="hostname" name="hostname[{{$i}}]" value="{{$host['hostname']}}">, block: <input class="block" type="checkbox" @if ($host['block'] == 1) checked='checked' @endif name="block[{{$i}}]" value="1"></div>			
								@endforeach
							</div>
							<a href="javascript:void(0);" id="addHost">Add host</a>
						</div>
					</td>
						
				</tr>
			</table>
			
			
			
			<input class="btn btn-primary btn-lg active" type="submit">
		</form>
	</div>
	<script>
		$(document).ready(function(){
			$("#addNetwork").click(function(){
				var clone = $('.network:first').clone();
				var count = $('.network').length;
				clone.find('.nid').attr('name', 'nid['+count+']'); 
				clone.find('.nname').attr('name', 'n_name['+count+']'); 
				clone.find('.nip').attr('name', 'n_ip['+count+']'); 
				clone.find('.nstatus').attr('name', 'n_status['+count+']'); 
				$("#networks").append(clone);
			})
	
			$("#addHost").click(function(){
				var clone = $('.host:first').clone();
				var count = $('.host').length;
				clone.find('.hostname').attr('name', 'hostname['+count+']');
				clone.find('.block').attr('name', 'block['+count+']');
				$("#hosts").append(clone);
			})
		})
	</script>

@stop
