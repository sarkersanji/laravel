<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sessionCheck($req){
        if($req->session()->has('username')){
            return true;
        }else{
            return false;
        }
    }

    public function index(Request $req){

        if($this->sessionCheck($req)){
            return view('home.index');
        }else{
            return redirect()->route('login.index');
        }

    }

    public function details(Request $req, $pname){

        if($this->sessionCheck($req)){
            $prodctList = $this->prodctList();
            $p = "";
            foreach ($prodctList as $prodct) {
                
                if($prodct[0] == $pname){
                    $p = $prodct;
                    break; 
                }
            }
            return view('home.details', ['prodct'=> $p]);
        }else{
            return redirect()->route('login.index');
        }
    }

    public function add(){
    	return view('home.add');
    }
	
	public function create(Request $req){
    	
    	$prodctlist = $this->prodctList();
    	$newProdct = [$req->pname, $req->pquantity,$req->price];
    	
    	array_push($prodctlist, $newProdct);
    	return view('home.show', ['prodctlist'=>$prodctlist]);
    	//return redirect('/stdList');
    }

    public function show(){

    	$prodct = $this->prodctList();
    	return view('home.show', ['prodctlist'=>$prodct]);
    }

    public function edit($pname){

    	$prodctList = $this->prodctList();
    	$p = "";
    	foreach ($prodctList as $prodct) {
    		
    		if($prodct[0] == $pname){
    			$p = $prodct;
    			break; 
    		}
    	}
    	return view('home.edit', ['prodct'=> $p]);
    }

    public function update(Request $req, $pname){

    	$prodctlist = $this->prodctList();
    	$newProdct = [$req->pname, $req->pquantity,$req->price];
    	
    	foreach ($prodctlist as &$prodct) {
    		
    		if($prodct[0] == $pname){
    			$prodct = $newProdct;
    			break; 
    		}
    	}

    	return view('home.show', ['prodctlist'=>$prodctlist]);
	    
    }

    public function delete($pname){
    	$prodctList = $this->prodctList();
    	$p = "";
    	foreach ($prodctList as $prodct) {
    		
    		if($prodct[0] == $pname){
    			$p = $prodct;
    			break; 
    		}
    	}
    	return view('home.delete', ['prodct'=> $p]);
    }

    public function destroy(Request $req, $pname){
    	
    	$prodctlist = $this->prodctList();
    	$i=0;
    	foreach ($prodctlist as $prodct) {
    		if($prodct[0] == $pname){
    			unset($prodctlist[$i]);
    			//break; 
    		}
    		$i++;
    	}

    	return view('home.show', ['prodctlist'=> $prodctlist]);
    }

    public function prodctList(){
    	return [
    		[ 'ABC', 25, '1000'],
    		[ 'XYZ', 24, '500'],
    		[ 'PQR', 23, '100'],
    		[ 'RTY', 22, '800'],
    		[ 'SVC', 21, '600']
    	];
    }
}








