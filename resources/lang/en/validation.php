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

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'gt'                   => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        'string'  => 'The :attribute must be greater than :value characters.',
        'array'   => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        'string'  => 'The :attribute must be greater than or equal :value characters.',
        'array'   => 'The :attribute must have :value items or more.',
    ],
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'lt'                   => [
        'numeric' => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'string'  => 'The :attribute must be less than :value characters.',
        'array'   => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        'string'  => 'The :attribute must be less than or equal :value characters.',
        'array'   => 'The :attribute must not have more than :value items.',
    ],
    'max'                  => [
        'numeric' => ':attribute باید بیشتر از :max باشد.',
        'file'    => ':attribute نمی تواند بیشتر از :max کیلوبایت باشد.',
        'string'  => ' :attribute نمی تواند بیشتر از :max کاراکتر باشد.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => ':attribute باید یکی از فرمت های: :values باشد.',
    'mimetypes'            => ':attribute باید یکی از فرمت های: :values باشد.',
    'min'                  => [
        'numeric' => ' :attribute حداقل باید :min باشد.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute حداقل باید :min کارکتر باشد.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'فرمت :attribute غیر قابل قبول است.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'فرمت :attribute غیر قابل قبول است.',
    'required'             => 'فیلد :attribute  ضروری است.',
    'required_if'          => 'فیلد :attribute  ضروری است وقتی :other  :value هست.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'فیلد :attribute ضروری است وقتی :values انتخاب شده باشد.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'فیلد :attribute ضروری است وقتی :values خالی است.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => ':attribute و :other باید مشابه باشند.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => ':attribute باید :size کاراکتر باشد.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'این :attribute قبلا استفاده شده است.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'فرمت :attribute غیرقابل قبول است.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => 'ایمیل',
        'name' => 'نام' ,
        'description' => 'توضحیات' ,
        'login_name' => 'نام کاربری' ,
        'password' => 'کلمه عبور',
        'email-log' => 'ایمیل',
        'password-log' => 'کلمه عبور',
        'body'=>'مطلب',
        'to_date'=>'تاریخ',
        'from_time'=>'ساعت شروع ',
        'to_time'=>'ساعت پایان ',
        'vacation_1'=>'روز اول',
        'request_title'=>'عنوان درخواست',
        'request_text'=>'توضحیات درخواست',
        'display_name'=>'نام نمایشی',
        'mobile' => 'شماره تلفن همراه',
        'phone' => 'شماره تلفن ثابت',
        'roles' => 'نقش',
        'insurance_number' => 'شماره بیمه',
        'number_type' => 'نوع حساب',
        'address' => 'آدرس',
        'gender' => 'جنسیت',
        'decision country id' => 'کشور مورد نظر مورد نظر',
        'decision_grade_id' => 'مقطع تحصیلی مورد نظر',
        'decision_visa_id' => 'روش مورد نظر',
        'offer_country_id.0' => 'کشور پیشنهادی 1',
        'offer_country_id.1' => 'کشور پیشنهادی 2',
        'offer_visa_id.0' => 'روش پیشنهادی 1',
        'offer_grade_id.0' => 'مقطع تحصیلی پیشنهادی 1',
        'offer_visa_id.1' => 'روش پیشنهادی 2',
        'offer_grade_id.1' => 'مقطع تحصیلی پیشنهادی 2',
        'customer_id' => 'مشتری',
        'employee_created_id' => 'کارمند',
        'title' => 'عنوان',
        'step' => 'مرحله',
        'duration' => 'مدت زمان',
        'service_id' => ' سرویس',
        'expiration' => 'تاریخ انقضا',
        'avatar' => 'آواتار',
        'confirm-password' => 'تکرار کلمه عبور',
        'base_url' => 'لینک پایه',
        'title_filter' => 'مسیر تیتر',
        'content_filter' => 'مسیر عنوان خبر',
        'task_url' => 'لینک صفحه اخبار جدید',
        'task_filter' => 'مسیر لینک ها',
    ],

];
