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


    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other هو :value.',
    'active_url' => 'الرابط :attribute غير صالح.',
    'after' => 'يجب أن يكون :attribute تاريخًا بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخًا بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'ascii' => 'يجب أن يحتوي :attribute على أحرف فقط من الأحرف الأبجدية الأساسية للبايت والرموز.',
    'before' => 'يجب أن يكون :attribute تاريخًا قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي :date.',
    'between' => [
        'array' => 'يجب أن يكون عدد عناصر :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'string' => 'يجب أن يكون عدد الأحرف في :attribute بين :min و :max.',
    ],
    'boolean' => 'يجب أن يكون حقل :attribute صحيحًا أو خطأ.',
    'confirmed' => 'عنصر التأكيد :attribute لا يتطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'الحقل :attribute ليس تاريخًا صالحًا.',
    'date_equals' => 'يجب أن يكون :attribute تاريخًا مساويًا ل :date.',
    'date_format' => 'الحقل :attribute لا يتطابق مع التنسيق :format.',
    'decimal' => 'يجب أن يحتوي الحقل :attribute على :decimal أماكن عشرية.',
    'declined' => 'يجب رفض الحقل :attribute.',
    'declined_if' => 'يجب رفض الحقل :attribute عندما يكون :other هو :value.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يتكون الحقل :attribute من :digits أرقام.',
    'digits_between' => 'يجب أن يتكون الحقل :attribute من :min إلى :max أرقام.',
    'dimensions' => 'الحقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'يحتوي حقل :attribute على قيمة مكررة.',
    'doesnt_end_with' => 'قد لا ينتهي :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'قد لا يبدأ :attribute بأحد القيم التالية: :values.',
    'email' => 'يجب أن يكون حقل البريد الإلكتروني :attribute صالحًا.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'enum' => 'ال :attribute المحدد غير صالح.',
    'exists' => 'ال :attribute المحدد غير صالح.',
    'file' => 'يجب أن يكون الحقل :attribute ملفًا.',
    'filled' => 'يجب توفير قيمة في الحقل :attribute.',
    'gt' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم الحقل :attribute أكبر من :value كيلو بايت.',
        'numeric' => 'يجب أن يكون الحقل :attribute أكبر من :value.',
        'string' => 'يجب أن يكون طول الحقل :attribute أكبر من :value حروف.',
    ],
    'gte' => [
        'array' => ':attribute يجب أن يحتوي على :value عناصر أو أكثر.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'string' => ':attribute يجب أن يكون أكبر من أو يساوي :value حروف.',
    ],
    'image' => ':attribute يجب أن يكون صورة.',
    'in' => 'الخيار المحدد :attribute غير صحيح.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => ':attribute يجب أن يكون عدد صحيح.',
    'ip' => ':attribute يجب أن يكون عنوان IP صحيح.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صحيح.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صحيح.',
    'json' => ':attribute يجب أن يكون سلسلة JSON صحيحة.',
    'lowercase' => ':attribute يجب أن يكون بحروف صغيرة.',
    'lt' => [
        'array' => ':attribute يجب أن يحتوي على أقل من :value عناصر.',
        'file' => ':attribute يجب أن يكون أصغر من :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أصغر من :value.',
        'string' => ':attribute يجب أن يكون أصغر من :value حروف.',
    ],
    'lte' => [
        'array' => 'الخاصية :attribute لا يجب أن تحتوي على أكثر من :value عناصر.',
        'file' => 'الخاصية :attribute يجب أن تكون أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'الخاصية :attribute يجب أن تكون أقل من أو يساوي :value.',
        'string' => 'الخاصية :attribute يجب أن تكون أقل من أو يساوي :value حروف.',
    ],
    'mac_address' => 'الخاصية :attribute يجب أن تكون عنوان MAC صحيح.',
    'max' => [
        'array' => 'الخاصية :attribute لا يجب أن تحتوي على أكثر من :max عناصر.',
        'file' => 'الخاصية :attribute لا يجب أن تكون أكبر من :max كيلوبايت.',
        'numeric' => 'الخاصية :attribute لا يجب أن تكون أكبر من :max.',
        'string' => 'الخاصية :attribute لا يجب أن تكون أكبر من :max حروف.',
    ],
    'max_digits' => 'الخاصية :attribute لا يجب أن تحتوي على أكثر من :max أرقام.',
    'mimes' => 'الخاصية :attribute يجب أن تكون ملف من النوع: :values.',
    'mimetypes' => 'الخاصية :attribute يجب أن تكون ملف من النوع: :values.',
    'min' => [
        'array' => 'الخاصية :attribute يجب أن تحتوي على الأقل :min عناصر.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'The :attribute must be uppercase.',
    'url' => 'The :attribute must be a valid URL.',
    'ulid' => 'The :attribute must be a valid ULID.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
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

    'attributes' => [],

];
