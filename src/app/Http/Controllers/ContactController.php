<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
  public function index()
  {
    // セッションから前回の入力値を取得
    $oldData = session('contact_form_data', []);

    return view('index', compact('oldData'));
  }

  public function confirm(ContactRequest $request)
  {
    $contact = $request->only([
      'category_id',
      'first_name',
      'last_name',
      'gender',
      'email',
      'tel1',
      'tel2',
      'tel3',
      'address',
      'building',
      'detail'
    ]);

    // セッションにデータを保存（修正時に使用）
    session(['contact_form_data' => $contact]);

    return view('confirm', compact('contact'));
  }

  public function store(ContactRequest $request)
  {
    $contact = $request->only([
      'category_id',
      'first_name',
      'last_name',
      'gender',
      'email',
      'tel1',
      'tel2',
      'tel3',
      'address',
      'building',
      'detail'
    ]);

    // 電話番号を結合
    $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];
    unset($contact['tel1'], $contact['tel2'], $contact['tel3']);

    Contact::create($contact);

    // セッションから入力データをクリア
    session()->forget('contact_form_data');

    return redirect()->route('contact.thanks');
  }

  public function thanks()
  {
    return view('thanks');
  }
}
