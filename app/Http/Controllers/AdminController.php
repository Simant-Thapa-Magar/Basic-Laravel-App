<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Customer;
use App\Http\Controllers\CustomerController;
use Hash;

class AdminController extends Controller
{
    /**
     * Return Login View
     *
     */
    public function showLoginForm(){
        return view('login');
    }

    /**
     * Return Admin Dashboard with data
     *
     */    
    public function showAdminDashboard(){
        $obj = new CustomerController();
        $request = new \Illuminate\Http\Request();
        $request['raw'] = true;
        $allCustomers = $obj->index($request);
        return view('admin-dashboard')->with('data',[
            'ViewName' => 'admin-dashboard-main',
            'Customers'=> $allCustomers
        ]);
    }

     /**
     * Perform login validation
     *
     * @param  Request  $request
     */
    public function validateLogin(Request $request){
        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $admin = Administrator::get()->where('username','=',$request['username'])->first();

        if(!$admin) return back()->withErrors(['loginError' => "No admin found with the username. Try 'admin'"]);

        if(Hash::check($request['password'],$admin->password)){
        $request->session()->put(config("global.ADMIN_SESSION_KEY"),$admin->username);
         return redirect('/dashboard');
        }

        return back()->withErrors(['loginError' => "Password didn't match. Try 'password'"]);
        }

    /**
     * Return Customer Creation Form for Admin
     *
     */
    public function showAdminCustomerForm(){
        $action = route('admin-create-customer');
        return view('admin-dashboard')->with('data',[
            'ViewName' => 'admin-customer-form',
            'action' => $action
        ]);
    }

    /**
     * Return Customer Edit Form for Admin
     *
     */
    public function showAdminCustomerEditForm($id){
        $obj = new CustomerController();
        $request = new \Illuminate\Http\Request();
        $request['raw'] = true;
        $customer = $obj->show($id,$request);

        if(!$customer) return redirect('/dashboard')->withErrors(['adminError' => 'Invalid Link']);;

        $action = route('admin-update-customer',$customer->id);
        return view('admin-dashboard')->with('data',[
                'ViewName' => 'admin-customer-form',
                'action' => $action,
                'customer' => $customer 
            ]);
    }

    /**
     * Create the customer.
     *
     * @param  Request  $request
     */

    public function createCustomer(Request $request){
        $obj = new CustomerController();
        $request->request->add(['raw' => true]);
       
        $customer = $obj->store($request);

        if(!$customer) return back()->withErrors(['adminError' => 'Couldnot Create Customer']);

        return redirect('/dashboard')->with('adminMessage','New Customer Created');
    }

    /**
     * Update the customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */

    public function updateCustomer(Request $request,$id){
        $obj = new CustomerController();
        $request->request->add(['raw' => true]);
        $customer = $obj->update($request,$id);

        if(!$customer) return back()->withErrors(['adminError' => 'Couldnot update Customer']);

        return redirect('/dashboard')->with('adminMessage','Customer Data Updated');
    }

    /**
     * Remove customer
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     * */
    public function removeCustomer($id,Request $request){
        
        $obj = new CustomerController();
        $request->request->add(['raw' => true]);
        $customer = $obj->destroy($id,$request);

        if(!$customer) return back()->withErrors(['adminError' => 'Couldnot remove Customer']);

        return redirect('/dashboard')->with('adminMessage','Customer Data Removed');
    }

     /**
     * Logs out current admin
     *
     * @param \Illuminate\Http\Request $request
     * */
    public function logoutAdmin(Request $request){
        $request->session()->pull(config("global.ADMIN_SESSION_KEY"));
        return redirect('/login');
    }

}
