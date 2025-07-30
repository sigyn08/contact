<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
  public function index()
  {
    return view('index');
  }

  public function admin(Request $request)
  {
    $contacts = Contact::query();

    // 検索条件がある場合にフィルター
    if ($request->filled('keyword')) {
      $contacts->where(function ($query) use ($request) {
        $query->where('last_name', 'like', "%{$request->keyword}%")
          ->orWhere('first_name', 'like', "%{$request->keyword}%");
      });
    }

    if ($request->filled('email')) {
      $contacts->where('email', 'like', "%{$request->email}%");
    }

    if ($request->filled('gender')) {
      $contacts->where('gender', $request->gender);
    }

    if ($request->filled('category')) {
      $contacts->where('contact_sort', $request->category);
    }

    if ($request->filled('date')) {
      $contacts->whereDate('created_at', $request->date);
    }

    $contacts = $contacts->paginate(10);

    return view('admin', compact('contacts'));
  }

  public function confirm(Request $request)
  {
    $contact = $request->only([
      'last_name',
      'first_name',
      'gender',
      'email',
      'tel',
      'address',
      'building',
      'contact_sort',
      'contact_content'
    ]);
    return view('confirm', compact('contact'));
  }

  public function store(Request $request)
  {
    $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'contact_sort', 'contact_content']);
    Contact::create($contact);
    return redirect('thanks');
  }

  public function thanks()
  {
    return view('thanks');
  }

  public function showRegisterForm()
  {
    return view('register');
  }

  public function register(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
    ]);
    User::create([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
    ]);

    return redirect('/login');
  }

  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('/admin');
    }

    return back()->withErrors([
      'email' => 'メールアドレスまたはパスワードが正しくありません。',
    ]);
  }

  public function show($id)
  {
    $contact = Contact::findOrFail($id);
    return view('admin_detail', compact('contact'));
  }

  public function destroy($id)
  {
    Contact::findOrFail($id)->delete();
    return redirect()->route('admin')->with('success', '削除しました。');
  }
}
