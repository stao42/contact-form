<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // 検索機能（名前・メールアドレス）
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 性別フィルター
        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせの種類フィルター
        if ($request->filled('inquiry_type') && $request->inquiry_type !== '') {
            $query->where('inquiry_type', $request->inquiry_type);
        }

        // 日付フィルター
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 7件ごとにページネーション
        $contacts = $query->orderBy('created_at', 'desc')->paginate(7);

        // 検索条件を保持
        $searchParams = $request->only(['search', 'gender', 'inquiry_type', 'date']);

        return view('admin.index', compact('contacts', 'searchParams'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        // モーダル用のHTMLを返す
        $html = view('admin.modal-content', compact('contact'))->render();

        return response($html);
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        // 検索条件を適用してエクスポート
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('inquiry_type') && $request->inquiry_type !== '') {
            $query->where('inquiry_type', $request->inquiry_type);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->get();

        $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');

            // BOMを追加（Excelで文字化けを防ぐ）
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSVヘッダー
            fputcsv($file, [
                'ID', 'お名前', '性別', 'メールアドレス', '電話番号',
                '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容', '作成日'
            ]);

            // データ
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $this->getGenderText($contact->gender),
                    $contact->email,
                    $contact->tel,
                    $contact->address ?? '',
                    $contact->building ?? '',
                    $this->getInquiryTypeText($contact->inquiry_type),
                    $contact->content,
                    $contact->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['success' => true]);
    }

    private function getGenderText($gender)
    {
        $genders = [
            'male' => '男性',
            'female' => '女性',
            'other' => 'その他'
        ];

        return $genders[$gender] ?? $gender;
    }

    private function getInquiryTypeText($type)
    {
        $types = [
            'general' => '一般的なお問い合わせ',
            'support' => 'サポート',
            'business' => 'ビジネス',
            'other' => 'その他'
        ];

        return $types[$type] ?? $type;
    }
}
