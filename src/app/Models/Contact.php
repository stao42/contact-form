<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name', 
        'email', 
        'tel', 
        'gender',
        'address',
        'building',
        'detail'
    ];

    // リレーションシップ
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // アクセサ（性別の文字列表現）
    public function getGenderTextAttribute()
    {
        $genders = [
            1 => '男性',
            2 => '女性', 
            3 => 'その他'
        ];
        return $genders[$this->gender] ?? '不明';
    }

    // アクセサ（フルネーム）
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
