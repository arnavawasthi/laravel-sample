<?php

class DataController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'layouts.master';
	private $data = array("url"=>"/laravel/public/index.php");
	
	public function all()
	{
		$networks = Data::all(); //DB::collection('networks')->get();
		$this->data['networks'] = $networks; 
		return View::make('networks.all', $this->data);
	}
	
	public function get($id){
		$network = Data::find($id);
		//print_r($network);exit;
		if(!isset($network["hostnames"])) 
		{
			$hostnames = array();
			$hostnames[] = array();
			$network["hostnames"] = $hostnames;
				
		}
		if(!isset($network["networks"]))
		{
			$networks = array();
			$networks[] = array();
			$network["networks"] = $networks;
		}
		if(!isset($network["_id"]))
		{
			$network["_id"] = 0;
		}
		

		//print_r($network);exit;
		$this->data['network'] = $network;
		return View::make('networks.one', $this->data);
	}
	
	public function update($id)
	{
		if($id == 0)
		{
			$network = new Data();
		}
		else 
		{
			$network = Data::find($id);
		}
		//print_r(Input::all());exit;
		
		$networks = array();
		$nNames = Input::get('n_name');
		$nIps = Input::get('n_ip');
		$nStatus = Input::get('n_status');
		foreach(Input::get('nid') as $i => $nid)
		{
			if(!$nid) continue;
			$n = (object)array();
			$n->nid = $nid;
			$n->n_name = $nNames[$i];
			$n->n_ip = $nIps[$i];
			$n->n_status = (isset($nStatus[$i]) && $nStatus[$i] == 1)?1:0;
			
			$networks[] = $n;
		}
		
		//print_r($networks);exit;
		
		$network->networks = $networks;
		
		$hostnames = array();
		$blocks = Input::get('block');
		foreach(Input::get('hostname') as $i => $hostname)
		{
			if(!$hostname) continue;
			$h = (object)array();
			$h->hostname = $hostname;
			$h->block = (isset($blocks[$i]) && $blocks[$i] == 1)?1:0;
			
			$hostnames[] = $h;
		}
		//print_r($hostnames);exit;
		$network->hostnames = $hostnames;
		$network->uid = Input::get("uid");
		//$network->networks = Input::get("networks");
		
		$network->save();
		
		return Redirect::to('/');
	}
	
	public function delete($id)
	{
		Data::destroy($id);
		return Redirect::to('/');
	}
	

}