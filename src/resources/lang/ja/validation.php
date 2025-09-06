<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute を承認してください。',
    'accepted_if' => ':other が :value の場合、:attribute を承認してください。',
    'active_url' => ':attribute は有効なURLではありません。',
    'after' => ':attribute は :date より後の日付にしてください。',
    'after_or_equal' => ':attribute は :date 以降の日付にしてください。',
    'alpha' => ':attribute は英字のみで入力してください。',
    'alpha_dash' => ':attribute は英数字、ハイフン、アンダースコアのみで入力してください。',
    'alpha_num' => ':attribute は英数字のみで入力してください。',
    'array' => ':attribute は配列にしてください。',
    'before' => ':attribute は :date より前の日付にしてください。',
    'before_or_equal' => ':attribute は :date 以前の日付にしてください。',
    'between' => [
        'numeric' => ':attribute は :min から :max の間で入力してください。',
        'file' => ':attribute は :min から :max キロバイトの間で入力してください。',
        'string' => ':attribute は :min から :max 文字の間で入力してください。',
        'array' => ':attribute は :min から :max 個の間で入力してください。',
    ],
    'boolean' => ':attribute は true または false にしてください。',
    'confirmed' => ':attribute の確認が一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute は有効な日付ではありません。',
    'date_equals' => ':attribute は :date と同じ日付にしてください。',
    'date_format' => ':attribute は :format 形式で入力してください。',
    'declined' => ':attribute を拒否してください。',
    'declined_if' => ':other が :value の場合、:attribute を拒否してください。',
    'different' => ':attribute は :other と異なるものにしてください。',
    'digits' => ':attribute は :digits 桁で入力してください。',
    'digits_between' => ':attribute は :min から :max 桁の間で入力してください。',
    'dimensions' => ':attribute の画像サイズが正しくありません。',
    'distinct' => ':attribute に重複した値があります。',
    'email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください。',
    'ends_with' => ':attribute は :values のいずれかで終わる必要があります。',
    'enum' => '選択された :attribute は無効です。',
    'exists' => '選択された :attribute は無効です。',
    'file' => ':attribute はファイルにしてください。',
    'filled' => ':attribute は必須です。',
    'gt' => [
        'numeric' => ':attribute は :value より大きくなければなりません。',
        'file' => ':attribute は :value キロバイトより大きくなければなりません。',
        'string' => ':attribute は :value 文字より大きくなければなりません。',
        'array' => ':attribute は :value 個より大きくなければなりません。',
    ],
    'gte' => [
        'numeric' => ':attribute は :value 以上でなければなりません。',
        'file' => ':attribute は :value キロバイト以上でなければなりません。',
        'string' => ':attribute は :value 文字以上でなければなりません。',
        'array' => ':attribute は :value 個以上でなければなりません。',
    ],
    'image' => ':attribute は画像にしてください。',
    'in' => '選択された :attribute は無効です。',
    'in_array' => ':attribute は :other に存在しません。',
    'integer' => ':attribute は整数にしてください。',
    'ip' => ':attribute は有効なIPアドレスにしてください。',
    'ipv4' => ':attribute は有効なIPv4アドレスにしてください。',
    'ipv6' => ':attribute は有効なIPv6アドレスにしてください。',
    'json' => ':attribute は有効なJSON文字列にしてください。',
    'lt' => [
        'numeric' => ':attribute は :value より小さくなければなりません。',
        'file' => ':attribute は :value キロバイトより小さくなければなりません。',
        'string' => ':attribute は :value 文字より小さくなければなりません。',
        'array' => ':attribute は :value 個より小さくなければなりません。',
    ],
    'lte' => [
        'numeric' => ':attribute は :value 以下でなければなりません。',
        'file' => ':attribute は :value キロバイト以下でなければなりません。',
        'string' => ':attribute は :value 文字以下でなければなりません。',
        'array' => ':attribute は :value 個以下でなければなりません。',
    ],
    'mac_address' => ':attribute は有効なMACアドレスにしてください。',
    'max' => [
        'numeric' => ':attribute は :max 以下で入力してください。',
        'file' => ':attribute は :max キロバイト以下で入力してください。',
        'string' => ':attribute は :max 文字以下で入力してください。',
        'array' => ':attribute は :max 個以下で入力してください。',
    ],
    'mimes' => ':attribute は :values タイプのファイルにしてください。',
    'mimetypes' => ':attribute は :values タイプのファイルにしてください。',
    'min' => [
        'numeric' => ':attribute は :min 以上で入力してください。',
        'file' => ':attribute は :min キロバイト以上で入力してください。',
        'string' => ':attribute は :min 文字以上で入力してください。',
        'array' => ':attribute は :min 個以上で入力してください。',
    ],
    'multiple_of' => ':attribute は :value の倍数にしてください。',
    'not_in' => '選択された :attribute は無効です。',
    'not_regex' => ':attribute の形式が正しくありません。',
    'numeric' => ':attribute は数値にしてください。',
    'password' => 'パスワードが正しくありません。',
    'present' => ':attribute は存在しなければなりません。',
    'prohibited' => ':attribute フィールドは禁止されています。',
    'prohibited_if' => ':other が :value の場合、:attribute フィールドは禁止されています。',
    'prohibited_unless' => ':other が :values にない場合、:attribute フィールドは禁止されています。',
    'prohibits' => ':attribute フィールドは :other の存在を禁止します。',
    'regex' => ':attribute の形式が正しくありません。',
    'required' => ':attribute は必須です。',
    'required_array_keys' => ':attribute フィールドには :values のエントリが必要です。',
    'required_if' => ':other が :value の場合、:attribute は必須です。',
    'required_unless' => ':other が :values にない場合、:attribute は必須です。',
    'required_with' => ':values が存在する場合、:attribute は必須です。',
    'required_with_all' => ':values が存在する場合、:attribute は必須です。',
    'required_without' => ':values が存在しない場合、:attribute は必須です。',
    'required_without_all' => ':values が存在しない場合、:attribute は必須です。',
    'same' => ':attribute と :other が一致しません。',
    'size' => [
        'numeric' => ':attribute は :size にしてください。',
        'file' => ':attribute は :size キロバイトにしてください。',
        'string' => ':attribute は :size 文字にしてください。',
        'array' => ':attribute は :size 個にしてください。',
    ],
    'starts_with' => ':attribute は :values のいずれかで始まる必要があります。',
    'string' => ':attribute は文字列にしてください。',
    'timezone' => ':attribute は有効なタイムゾーンにしてください。',
    'unique' => ':attribute は既に使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'url' => ':attribute は有効なURLにしてください。',
    'uuid' => ':attribute は有効なUUIDにしてください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "rule.attribute" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
    ],

];
