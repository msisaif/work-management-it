<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'regexp', $search)
                        ->orWhere('email', 'regexp', $search);
                });
            })
            ->when(request()->user, function ($query, $user) {
                if($user == 2) {
                    $query->onlyTrashed();
                }
            }, function ($query) {
                $query->withTrashed();
            })
            ->when(request()->from, function ($query, $date_from) {
                $query->whereDate('created_at', '>=', $date_from);
            })
            ->when(request()->to, function ($query, $date_to) {
                $query->whereDate('created_at', '<=', $date_to);
            });

        return Inertia::render('User/Index', [
            'users' => $users->paginate(request()->perpage ?? 100)->onEachSide(1)->appends(request()->input()),
            'filters' => [
                'user' => [
                    1 => 'Active User',
                    2 => 'Trashed User'
                ]
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }
}
