<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Base\Prefecture;
use App\Models\Company;
use Config;


class CompanyController extends Controller
{
    /**
     * Get named route
     *
     */
    private function getRoute()
    {
        return 'admin.company';
    }

    /**
     * Validator for user
     *
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data, $type)
    {
        // Determine if password validation is required depending on the calling
        return Validator::make($data, [
            // 'username' => 'required|string|max:255|unique:users,username,' . $data['id'],
            // 'display_name' => 'required|string|max:100',
            // (update: not required, create: required)
            // 'email' => 'required|string|min:6|max:255',
            // 'phone' => 'required|string|min:6|max:255',
            // 'postcode' => 'required|string|min:6|max:255',
            // 'city' => 'required|string|min:6|max:255',
            // 'local' => 'required|string|min:6|max:255',
            // 'street_address' => 'string|min:6|max:255',
            // 'business_hour' => 'string|min:6|max:255',
            // 'regular_holiday' => 'string|min:6|max:255',
            // 'image' => 'string|min:6|max:255',
            // 'fax' => 'string|min:6|max:255',
            // 'url' => 'string|min:6|max:255',
            // 'license_number' => 'string|min:6|max:255',
            // 'regular_holiday' => 'string|min:6|max:255',
        ]);
    }

    public function index() {
        return view('backend.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $company = new Company();
        $company->form_action = $this->getRoute() . '.create';
        $company->page_title = 'Company Add Page';
        $company->page_type = 'create';
        return view('backend.companies.form', [
            'company' => $company
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $newCompany = $request->all();
        $prefecture = new Prefecture();
        $prefecture = $prefecture::where('display_name', $newCompany['prefecture'])->first(['id']);
        $newCompany['prefecture_id'] = $prefecture['id'];
        // dd($newCompany);
        // Validate input, indicate this is 'create' function
        $this->validator($newCompany, 'create')->validate();

        try {
            $company = Company::create($newCompany);
            if ($company) {
                // Create is successful, back to list
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_CREATE_MESSAGE'));
            } else {
                // Create is failed
                return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
            }
        } catch (Exception $e) {
            // Create is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
        }
    }

    public function delete(Request $request)
    {
        try {
            // Get company by id
            $company = Company::find($request->get('id'));
            // dd($company);
            $company->delete();
        } catch (Exception $e) {
            // If delete is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_DELETE_MESSAGE'));
        }
    }

    // 郵便番号を検索する処理
    public function search(Request $request)
    {
        return \App\Models\Postcode::WhereSearch($request->postcode)->first();
    }

}
