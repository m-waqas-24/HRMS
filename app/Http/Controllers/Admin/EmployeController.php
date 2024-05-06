<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\Branch;
use App\Models\Company;
use App\Models\CompanyDetail;
use App\Models\Contract;
use App\Models\Designation;
use App\Models\Document;
use App\Models\Employe;
use App\Models\Salary;
use App\Models\SystemSetting;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage employee ')){
            $employes = Employe::where('created_by', \Auth::user()->creatorId())->orderBy('id', 'DESC')->paginate(20);    
            $empID = null;
            $name = null;
            $email = null;
            $companyid = null;

            return view('admin.employee.index', compact('employes', 'empID', 'name', 'email', 'companyid'));
        }
        else
        {
            return back()->withError('Permission Denied');
        }
       
    }

    public function employeTable(){
        if(Auth::user()->can('manage employee ')){
            $employes = Employe::where('created_by', \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();    
            $companies = Company::where('created_by', \Auth::user()->creatorId())->get();

            return view('admin.employee.employe-table', compact('employes', 'companies'));
        }
        else
        {
            return back()->withError('Permission Denied');
        }
    }

    public function searchEmploye(Request $request)
    {
        $companies = Company::where('created_by', \Auth::user()->creatorId())->get();
        $employeeQuery = Employe::query();

        $empID = $request->empID;
        $name = $request->name;
        $email = $request->email;
        $companyid = $request->company;

        if ($request->empID) {
            $employeeQuery->where('empID', $empID);
        }

        if ($request->name) {
            $employeeQuery->where('name', 'like', '%' . $name . '%');
        }

        if ($request->email) {
            $employeeQuery->whereHas('user', function ($query) use ($request) {
                $query->where('email', $request->email);
            });
        }
        
        if($request->company){
            $employeeQuery->whereHas('companyDetail', function($query) use ($request){
                $query->where('company_id', $request->company);
            });
        }

        $employeeQuery->where('created_by', \Auth::user()->creatorId());

        $employes = $employeeQuery->get();


        return view('admin.employee.employe-table', compact('employes', 'companies', 'empID', 'name', 'email', 'companyid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $created_by = \Auth::user()->creatorId();

        if(Auth::user()->can('create employee ')){
            $designations = Designation::where('created_by', $created_by)->get();
            $contracts = Contract::where('created_by', $created_by)->get();
            $companies = Company::where('created_by', $created_by)->get();
            $branches = Branch::where('created_by', $created_by)->get();
            $timeSlots = TimeSlot::where('created_by', $created_by)->get();

            return view('admin.employee.create', compact('timeSlots', 'designations', 'contracts', 'branches', 'companies'));
        }
        else
        {
            return back()->withError('Permission Denied');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "number" => 'required',
            "d_o_b" => 'required',
            'gender' => 'required',
            "address1" => 'required',
            "email" => 'required',
            "designation" => 'required',
            "d_o_join" => 'required',
            "contract" => 'required',
        ]);

        $file = null;
        if ($request->file('img')) {
            $path = $request->file('img');
            $target = 'public/employe_images';
            $file = Storage::putFile($target, $path);
            $file = substr($file, 7, strlen($file) - 7);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $file,
            'password' => Hash::make('password'),
            'created_by' => \Auth::user()->creatorId(),
            'type' => 'employee',
        ]);

        $role = Role::where([ 'name' => 'employee', 'created_by' => \Auth::user()->creatorId() ])->first();
        $user->assignRole($role);

        $employe = Employe::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'number' => $request->number,
            'relation' => $request->father_name,
            'cnic' => $request->cnic,
            'eme_no_1' => $request->eme_no_1,
            'd_o_b' => $request->d_o_b,
            'gender' => $request->gender,
            'marital' => $request->marital,
            'blood' => $request->blood,
            'address' => $request->address1,
            'address_2' => $request->address2,
            'empID' => $this->random(),
            'created_by' => \Auth::user()->creatorId(),
        ]);

        Salary::create([
            'emp_id' => $employe->id,
            'paymentslip_option' => null,
            'salary' => 0,
        ]);

        CompanyDetail::create([
            'emp_id' => $employe->id,
            'company_id' => $request->company,
            'branch_id' => $request->branch,
            'timeslot' => $request->timeslot,
            'designation_id' => $request->designation,
            'contract_id' => $request->contract,
            'd_o_join' => $request->d_o_join,
        ]);

        BankDetail::create([
            'emp_id' => $employe->id,
            'acc_name' => $request->acc_name,
            'acc_number' => $request->acc_no,
            'bank_name' => $request->bank_name,
            'bank_location' => $request->bank_location,
            'bank_code' => $request->bank_code,
        ]);

        $resume = null;
        if ($request->file('resume')) {
            $path = $request->file('resume');
            $target = 'public/employe_resumes';
            $resume = Storage::putFile($target, $path);
            $resume = substr($resume, 7, strlen($resume) - 7);
        }
        $cnic = null;
        if ($request->file('cnic')) {
            $path = $request->file('cnic');
            $target = 'public/employe_cnic';
            $cnic = Storage::putFile($target, $path);
            $cnic = substr($cnic, 7, strlen($cnic) - 7);
        }
        $offer_letter = null;
        if ($request->file('offer_letter')) {
            $path = $request->file('offer_letter');
            $target = 'public/employe_offer_letter';
            $offer_letter = Storage::putFile($target, $path);
            $offer_letter = substr($offer_letter, 7, strlen($offer_letter) - 7);
        }
        $joining_letter = null;
        if ($request->file('joining_letter')) {
            $path = $request->file('joining_letter');
            $target = 'public/employe_joining_letter';
            $joining_letter = Storage::putFile($target, $path);
            $joining_letter = substr($joining_letter, 7, strlen($joining_letter) - 7);
        }
        $agreement_letter = null;
        if ($request->file('agreement_letter')) {
            $path = $request->file('agreement_letter');
            $target = 'public/employe_agreement_letter';
            $agreement_letter = Storage::putFile($target, $path);
            $agreement_letter = substr($agreement_letter, 7, strlen($agreement_letter) - 7);
        }
        $experience_letter = null;
        if ($request->file('experience_letter')) {
            $path = $request->file('experience_letter');
            $target = 'public/employe_experience_letter';
            $experience_letter = Storage::putFile($target, $path);
            $experience_letter = substr($experience_letter, 7, strlen($experience_letter) - 7);
        }

        Document::create([
            'emp_id' => $employe->id,
            'resume' => $resume,
            'cnic' => $cnic,
            'offer_letter' => $offer_letter,
            'joining_letter' => $joining_letter,
            'agreement_letter' => $agreement_letter,
            'experience_letter' => $experience_letter,
        ]);

        
        return redirect()->route('admin.employe-list')->withSuccess('Employee added successfully!');
    }

    private function random()
    {
        $system = SystemSetting::where('created_by', \Auth::user()->creatorId())->first();

        if($system){
            do{
                $next = random_int(1,9999);
                $code = $system->emp_prefix . '-' . $next; 
            }while(Employe::where('empID','=', $code)->first());
    
            return $code;
        }else{
            return 'N\A';
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employee)
    {
        if(Auth::user()->can('show employee ')){
            if( \Auth::user()->creatorId() == $employee->created_by ){
                return view('admin.employee.show', compact('employee'));
            }else{
                auth()->logout();
                abort(403);
            }
        }
        else
        {
            return back()->withError('Permission Denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employee)
    {
        if(Auth::user()->can('edit employee ')){
            
            if ( \Auth::user()->creatorId() == $employee->created_by) {
                $designations = Designation::where('created_by' , \Auth::user()->creatorId())->get();
                $contracts = Contract::where('created_by' , \Auth::user()->creatorId())->get();
                $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
                $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
        
                return view('admin.employee.edit', compact('employee', 'designations', 'contracts', 'companies', 'branches'));
            } else {
                auth()->logout();
                return abort(403); 
            }
        }
        else
        {
            return back()->withError('Permission Denied');
        }
    } 
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employe $employee)
    {
            //   dd($request->all());
              $request->validate([
                "name" => 'required',
                "number" => 'required',
                "d_o_b" => 'required',
                'gender' => 'required',
                "address1" => 'required',
                "email" => 'required',
                "designation" => 'required',
                "d_o_join" => 'required',
                "contract" => 'required',
            ]);

           
            $user = User::where('id', $employee->user_id)->first();

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $file = $employee->img;
            if ($request->file('img')) {
                $path = $request->file('img');
                $target = 'public/employe_images';
                if ($file) {
                    // Unlink existing file if it exists
                    $existingFilePath = public_path('storage/' . $file);
                    if (file_exists($existingFilePath)) {
                        unlink($existingFilePath);
                    }
                }
                $file = Storage::putFile($target, $path);
                $file = substr($file, 7, strlen($file) - 7);
            }

            $employee->update([
                'name' => $request->name,
                'number' => $request->number,
                'relation' => $request->father_name,
                'cnic' => $request->cnic,
                'eme_no_1' => $request->eme_no_1,
                'd_o_b' => $request->d_o_b,
                'gender' => $request->gender,
                'marital' => $request->marital,
                'blood' => $request->blood,
                'address' => $request->address1,
                'address_2' => $request->address2,
                'img' => $file,
            ]);

            $employee->companyDetail->update([
                'company_id' => $request->company,
                'branch_id' => $request->branch,
                'designation_id' => $request->designation,
                'contract_id' => $request->contract,
                'd_o_join' => $request->d_o_join,
            ]);

            $employee->bankDetail->update([
                'acc_name' => $request->acc_name,
                'acc_number' => $request->acc_no,
                'bank_name' => $request->bank_name,
                'bank_location' => $request->bank_location,
                'bank_code' => $request->bank_code,
            ]);

            //for resume update
            $resume = $employee->document->resume;
            if ($request->file('resume')) {
                $path = $request->file('resume');
                $target = 'public/employe_resumes';
                if($resume){
                    $existingFilePath = public_path('storage/'.$resume);
                    if(file_exists('storage/'.$resume)){
                        unlink($existingFilePath);
                    }
                }
                $resume = Storage::putFile($target, $path);
                $resume = substr($resume, 7, strlen($resume) - 7);
            }

            //for cnic update
            $cnic = $employee->document->cnic;
            if ($request->file('cnic')) {
                $path = $request->file('cnic');
                $target = 'public/employe_cnic';

                if($cnic){
                    $existingFilePath = public_path('storage/'.$cnic);
                    if(file_exists('storage/'.$cnic)){
                        unlink($existingFilePath);
                    }
                }

                $cnic = Storage::putFile($target, $path);
                $cnic = substr($cnic, 7, strlen($cnic) - 7);
            }

            //for offer letter update
            $offer_letter = $employee->document->offer_letter;
            if ($request->file('offer_letter')) {
                $path = $request->file('offer_letter');
                $target = 'public/employe_offer_letter';

                if($offer_letter){
                    $existingFilePath = public_path('storage/'.$offer_letter);
                    if(file_exists('storage/'.$offer_letter)){
                        unlink($existingFilePath);
                    }
                }

                $offer_letter = Storage::putFile($target, $path);
                $offer_letter = substr($offer_letter, 7, strlen($offer_letter) - 7);
            }

            //for joining_letter update
            $joining_letter = $employee->document->joining_letter;
            if ($request->file('joining_letter')) {
                $path = $request->file('joining_letter');
                $target = 'public/employe_joining_letter';

                if($joining_letter){
                    $existingFilePath = public_path('storage/'.$joining_letter);
                    if(file_exists('storage/'.$joining_letter)){
                        unlink($existingFilePath);
                    }
                }

                $joining_letter = Storage::putFile($target, $path);
                $joining_letter = substr($joining_letter, 7, strlen($joining_letter) - 7);
            }

            //for update agreement letter
            $agreement_letter = $employee->document->agreement_letter;
            if ($request->file('agreement_letter')) {
                $path = $request->file('agreement_letter');
                $target = 'public/employe_joining_letter';

                if($agreement_letter){
                    $existingFilePath = public_path('storage/'.$agreement_letter);
                    if(file_exists('storage/'.$agreement_letter)){
                        unlink($existingFilePath);
                    }
                }

                $agreement_letter = Storage::putFile($target, $path);
                $agreement_letter = substr($agreement_letter, 7, strlen($agreement_letter) - 7);
            }

            //for updaet experience_letter
            $experience_letter = $employee->document->experience_letter;
            if ($request->file('experience_letter')) {
                $path = $request->file('experience_letter');
                $target = 'public/employe_experience_letter';

                if($experience_letter){
                    $existingFilePath = public_path('storage/'.$experience_letter);
                    if(file_exists('storage/'.$experience_letter)){
                        unlink($existingFilePath);
                    }
                }

                $experience_letter = Storage::putFile($target, $path);
                $experience_letter = substr($experience_letter, 7, strlen($experience_letter) - 7);
            }

            $employee->document->update([
                'resume' => $resume,
                'cnic' => $cnic,
                'offer_letter' => $offer_letter,
                'joining_letter' => $joining_letter,
                'agreement_letter' => $agreement_letter,
                'experience_letter' => $experience_letter,
            ]);

            return redirect()->route('admin.employe-list')->withSuccess('Employee updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employee)
    {
        if(Auth::user()->can('delete employee ')){
            
            if ( \Auth::user()->creatorId() == $employee->created_by) {

                $employee->user->delete();
                $employee->delete();
    
                return back()->withSuccess('Employee deleted successfully!');
            } else {
                auth()->logout();
                return abort(403); 
            }
        }
        else
        {
            return back()->withError('Permission Denied');
        }
    }

}
