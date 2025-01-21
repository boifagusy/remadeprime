<?php

namespace App\Http\Controllers;

use App\Mail\Sendmail;
use App\Models\Page;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.index');
    }
    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    /**
     * Show the Custom Pages.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pages($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page == null) {
            abort(404);
        }
        return view('front.page', compact('page'));
    }
    public function terms()
    {
        $page = Page::where('type', 'terms')->first();
        if ($page == null) {
            abort(404);
        }
        return view('front.page', compact('page'));
    }
    public function policy()
    {
        $page = Page::where('type', 'policy')->first();
        if ($page == null) {
            abort(404);
        }
        return view('front.page', compact('page'));
    }
    public function contact_us()
    {
        return view('front.contact');
    }
    function send_contact(Request $request)
    {
        // return $request;
        $data['view'] = 'email.contact';
        $data['subject'] = "Contact Email";
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['name'] = $request->name;
        $data['message'] = $request->message;
        
        try {
            Mail::to(get_setting('email'))->queue(new Sendmail($data));
        } catch (\Exception $e) {
            // dd($e);
            return back()->withError('Email not sent. Please try again');
        }
        return back()->withSuccess('Email sent. We would contact you as soon as we can.');
    }
    // Bills Payment
    public function bills()
    {
        return view('bills.index');
    }
    public function maintenance()
    {
        return view('maintenance');
    }

    public function service_worker()
    {
        return response()->file(public_path('assets/sw.js'));
    }
}
