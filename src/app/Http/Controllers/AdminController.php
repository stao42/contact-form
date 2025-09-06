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
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 性別フィルター
        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        // カテゴリフィルター
        if ($request->filled('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        // 日付フィルター
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 7件ごとにページネーション（リレーションシップも読み込み）
        $contacts = $query->with('category')->orderBy('created_at', 'desc')->paginate(7);

        // 検索条件を保持
        $searchParams = $request->only(['search', 'gender', 'category_id', 'date']);

        return view('admin.index', compact('contacts', 'searchParams'));
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

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
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->orderBy('created_at', 'desc')->get();

        // デバッグ: エクスポートされるレコード数をログに記録
        \Log::info('Export Debug', [
            'search' => $request->search ?? 'none',
            'gender' => $request->gender ?? 'none', 
            'inquiry_type' => $request->inquiry_type ?? 'none',
            'date' => $request->date ?? 'none',
            'total_records' => $contacts->count()
        ]);

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
                'ID', 'カテゴリ', '姓', '名', '性別', 'メールアドレス', '電話番号',
                '住所', '建物名', 'お問い合わせ内容', '作成日'
            ]);

            // データ
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->category->content ?? '',
                    $contact->last_name,
                    $contact->first_name,
                    $this->getGenderText($contact->gender),
                    $contact->email,
                    $contact->tel,
                    $contact->address ?? '',
                    $contact->building ?? '',
                    $contact->detail,
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
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        return $genders[$gender] ?? '不明';
    }

}
