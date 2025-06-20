<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PayrollRequest;

class PageController extends Controller
{
    public function dashboard(){
        $payrollRequests = PayrollRequest::with(['payroll.user','user'])->where('status','processed')->get();

        $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $notRead = $notifications->where('is_read', false)->count();

        return view('dashboard', compact('payrollRequests', 'notRead', 'notifications'));
    }
    public function payroll_request(){
        $user = auth()->user();
        if($user->role == 'manager'){
            $data = PayrollRequest::with(['payroll.user','user'])->get();
        }else{
            $data = PayrollRequest::with(['payroll.user','user'])->where('created_by',auth()->user()->id)->get();
        }
        $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $notRead = $notifications->where('is_read', false)->count();

        $users = User::with('payroll')->select('users.id','users.name')
            ->where('users.is_active', true)
            ->get();
        return view('pages.payroll_request',compact('data','users', 'notRead', 'notifications'));
    }

    public function add_payroll_request(Request $request){
        $request->validate([
            'payroll_id' => 'required',
            'bonus' => 'numeric',
        ]);

        $tax = 0;
        $payroll = $request->payroll_id ? Payroll::find($request->payroll_id) : null;
        if($payroll){
            $basicSalary = $payroll->basic_salary;
            if($basicSalary < 5000000){
                $tax = 0.05;
            } elseif($basicSalary >= 5000000 && $basicSalary < 20000000){
                $tax = 0.1;
            } elseif($basicSalary >= 20000000){
                $tax = 0.15;
            }
        }
        $totalSalary = $payroll->basic_salary + $request->bonus;

        $payrollRequest = new PayrollRequest();
        $payrollRequest->payroll_id = $request->payroll_id;
        $payrollRequest->bonus = $request->bonus ?? 0;
        $payrollRequest->tax = $tax;
        $payrollRequest->net_pay = $payroll ? ($totalSalary) - (($totalSalary)  * $tax) : 0;
        $payrollRequest->status = 'pending';
        $payrollRequest->created_by = auth()->user()->id;

        if($request->hasFile('payment_slip')){
            $file = $request->file('payment_slip');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('payment_slips', $filename, 'public');
            $payrollRequest->payment_slip = $filename;
        }

        $payrollRequest->save();

        $managers = User::where('role', 'manager')->get()->pluck('id');
        foreach($managers as $manager){
            Notification::insert([
                'user_id' => $manager,
                'title'   => 'New Payroll Request',
                'message' => 'A new payroll request has been submitted',
                'is_read' => false
            ]);
        }

        return redirect()->back()->with('success', 'Payroll request added successfully.');
    }

    public function approve_payroll_request($id){
        $payrollRequest = PayrollRequest::findOrFail($id);
        $payrollRequest->status = 'approved';
        $payrollRequest->processed_by = auth()->user()->id;
        $payrollRequest->save();

        $finances = User::where('role', 'finance')->get()->pluck('id');
        foreach($finances as $finance){
            Notification::insert([
                'user_id' => $finance,
                'title'   => 'Approved Payroll Request',
                'message' => 'A new payroll request has been approved',
                'is_read' => false
            ]);
        }

        return redirect()->back()->with('success', 'Payroll request approved successfully.');
    }

    public function reject_payroll_request($id){
        $payrollRequest = PayrollRequest::findOrFail($id);
        $payrollRequest->status = 'rejected';
        $payrollRequest->processed_by = auth()->user()->id;
        $payrollRequest->save();

        $finances = User::where('role', 'finance')->get()->pluck('id');
        foreach($finances as $finance){
            Notification::insert([
                'user_id' => $finance,
                'title'   => 'Rejected Payroll Request',
                'message' => 'A new payroll request has been rejected',
                'is_read' => false
            ]);
        }

        return redirect()->back()->with('success', 'Payroll request rejected successfully.');
    }

    public function process_payroll_request(Request $request,$id){
        if($request->hasFile('payment_slip')){
            $file = $request->file('payment_slip');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('payment_slips', $filename, 'public');
        }else{
            return redirect()->back()->with('error', 'Payment slip is required for processing payroll request.');
        }
        $payrollRequest = PayrollRequest::findOrFail($id);
        $payrollRequest->status = 'processed';
        $payrollRequest->payment_slip = $filename;
        $payrollRequest->processed_by = auth()->user()->id;
        $payrollRequest->save();

        $directors = User::where('role', 'director')->get()->pluck('id');
        foreach($directors as $director){
            Notification::insert([
                'user_id' => $director,
                'title'   => 'Processed Payroll Request',
                'message' => 'A new payroll request has been processed',
                'is_read' => false
            ]);
        }

        return redirect()->back()->with('success', 'Payroll request processed successfully.');
    }

    public function markAsRead(Request $request){
        $notification = Notification::findOrFail($request->id);
        $notification->is_read = true;
        $notification->save();

        return redirect()->back();
    }
}
