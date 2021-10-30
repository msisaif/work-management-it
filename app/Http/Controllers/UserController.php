<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\DateFilter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    use DateFilter;

    public function index()
    {
        $users = $this->setQuery(User::query())
            ->search()->filter()->dateFilter()
            ->getQuery();

        return Inertia::render('User/Index', [
            'users' => $users->paginate(request()->perpage ?? 100)->onEachSide(1)->appends(request()->input()),
            'filters' => $this->getFilterProperty(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return Inertia::render('User/Show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    protected function search()
    {
        $this->getQuery()
            ->when(request()->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'regexp', $search)
                        ->orWhere('email', 'regexp', $search);
                });
            });

        return $this;
    }

    protected function filter()
    {
        $this->getQuery()
            ->when(isset(request()->email_verified_status), function ($query) {
                if (request()->email_verified_status == 1) {
                    $query->whereNotNull('email_verified_at');
                } 
                
                if (request()->email_verified_status == 0) {
                    $query->whereNull('email_verified_at');
                }
            });

        return $this;
    }

    protected function getFilterProperty()
    {
        return [
            'email_verified_status' => [
                1 => 'Email Verified',
                0 => 'Email Not Verified',
            ]
        ];
    }
}
