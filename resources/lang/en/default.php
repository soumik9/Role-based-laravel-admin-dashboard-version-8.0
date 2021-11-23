<?php
return [

    'table' => [
        'sl'                => 'SL',
        'name'              => 'Name',
        'code'              => 'Code',
        'image'             => 'Image',
        'category'          => 'Category',
        'email'             => 'Email',
        'slug'              => 'Slug',
        'title'             => 'Title',
        'symbol'            => 'Symbol',
        'action'            => 'Action',
        'mobile'            => 'Mobile',
        'role'              => 'Role',
        'roles'             => 'Roles',
        'status'            => 'Status',
        'edit'              => 'Edit',
        'delete'            => 'Delete',
    ],

    'form'  => [
            'id'                => 'ID',
            'nid'               => 'NID',
            'officer_id'        => 'Officer ID',
            'confirm-password'  => 'Confirm Password',
            'image'             => 'Image',
            'code'              => 'Code',
            'title'             => 'Title',
            'category'          => 'Category',
            'description'       => 'Description',
            'upload_image'      => 'Upload Image',
            'change_image'      => 'Change Image',
            'name'              => 'Name',
            'email'             => 'Email',
            'symbol'            => 'Symbol',
            'currency'          => 'Currency',
            'phone'             => 'Phone',
            'slug'              => 'Slug',
            'password'          => 'Password',
            'mobile'            => 'Mobile',
            'division'          => 'Division',
            'district'          => 'District',
            'sub_district'      => 'Upazila',
            'address'           => 'Address',
            'password-confirm'  => 'Confirm Password',
            'role'              => 'Role',
            'status'            => 'Status',
            'role-current'      => 'Current Role',
            'add-button'        => 'Add New User',
            'save-button'       => 'Save',
            'edit-button'       => 'Edit',
            'update-button'     => 'Update',
            'delete-button'     => 'Delete',
            'user-since'        => 'User Since',
            'last-update'       => 'Last Update',
            'action'            => 'Action',
            'edit'              => 'Edit',
            'delete'            => 'Delete',
            'delete-message'    => 'Are you sure?',


            'facebook'    => 'Facebook',
            'twitter'     => 'Twitter',
            'instagram'   => 'Instagram',
            'linkedin'    => 'Linkedin',
            'github'      => 'Github',
           
            'website_title'         => 'Website Title',
            'website_logo_dark'     => 'Website Logo Dark',
            'website_logo_light'    => 'Website Logo Light',
            'website_logo_small'    => 'Website Logo Small',
            'website_favicon'       => 'Website Favicon',
            'meta_title'            => 'Meta Title',
            'meta_description'      => 'Meta Description',
            'meta_keywords'         => 'Meta Keywords',


            'validation'    => [
                'password' => [
                    'required'  => 'The password field is required!',
                    'same'      => 'The password and confirm-password must match.',
                    'min'       => 'Password length must be greater than 5.',
                ],
                'name' => [
                    'required'  => 'The name field is required!',
                    'unique'    => 'Name already exists!',
                ],
                'nid' => [
                    'required'  => 'The NID field is required!',
                    'unique'    => 'NID already exists!',
                ],
                'code' => [
                    'required'  => 'The code field is required!',
                    'unique'    => 'Code already exists!',
                ],
                'slug' => [
                    'required'  => 'The slug field is required!',
                    'unique'    => 'Slug already exists!',
                ],
                'symbol' => [
                    'required'  => 'The symbol field is required!',
                    'unique'    => 'Symbol already exists!',
                ],
                'meta_title' => [
                    'required'  => 'The meta title field is required!',
                ],
                'description' => [
                    'required'  => 'The description field is required!',
                ],
                'meta_description' => [
                    'required'  => 'The meta description field is required!',
                ],
                'meta_keywords' => [
                    'required'  => 'The meta keywords field is required!',
                ],
                'category' => [
                    'required'  => 'The category field is required!',
                ],
                'status' => [
                    'required'  => 'The status field is required!',
                ],
                'permission' => [
                    'required'  => 'The permission field is required!',
                ],
                'email' => [
                    'required'  => 'The email field is required!',
                    'email'     => 'Please your email format!',
                    'unique'    => 'Email already exists!',
                ],
                'roles' => [
                    'required'  => 'The roles field is required!',
                ],
                'mobile' => [
                    'required'  => 'The mobile field is required!',
                ],
                'district' => [
                    'required'  => 'The district field is required!',
                ],
                'sub_district' => [
                    'required'  => 'The sub_district field is required!',
                ],
                'address' => [
                    'required'  => 'The address field is required!',
                ],
                'image' => [
                    'required'  => 'The image field is required!',
                    'image'     => 'The uploaded file must be an image!',
                    'mimes'     => 'Only jpeg,png,jpg formats are supported!',
                    'max'       => 'File size must not be more than 10M!',
                ],
            ],
        ],
];