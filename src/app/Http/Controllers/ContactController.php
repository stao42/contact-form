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
      'first_name',
      'last_name',
      'gender',
      'email',
      'tel1',
      'tel2',
      'tel3',
      'address',
      'building',
      'inquiry_type',
      'content'
    ]);

    // セッションにデータを保存（修正時に使用）
    session(['contact_form_data' => $contact]);

    return view('confirm', compact('contact'));
  }

  public function store(ContactRequest $request)
  {
    $contact = $request->only([
      'first_name',
      'last_name',
      'gender',
      'email',
      'tel1',
      'tel2',
      'tel3',
      'address',
      'building',
      'inquiry_type',
      'content'
    ]);

    // 既存のテーブル構造に合わせてデータを整形
    $contact['name'] = $contact['first_name'] . ' ' . $contact['last_name'];
    $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3']; // ハイフンなし

    Contact::create($contact);
    return view('thanks');
  }
}
