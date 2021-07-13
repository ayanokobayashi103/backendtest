<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use Config;


class CompanyController extends Controller
{
    public function index()
    {
        return view('backend.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $company = new Companies();
        $user->form_action = $this->getRoute() . '.create';
        $user->page_title = 'Company Add Page';
        $user->page_type = 'create';
        return view('backend.users.form', [
            'user' => $user
        ]);
    }

}
