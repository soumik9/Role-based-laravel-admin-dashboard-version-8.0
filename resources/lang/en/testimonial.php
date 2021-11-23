<?php

return [

    'index' => [
        'title' => 'Testimonials',
    ],

    'create' => [
        'title' => 'Testimonial Create',
    ],

    'edit' => [
        'title' => 'Testimonial Edit',
    ],

    'delete' => [
        'title' => 'Delete',
    ],


    'breadcrumb' => [
        'index' => 'Testimonials',
        'create' => 'Create',
        'edit' => 'Edit',
    ],


    'form'  => [
        'id'                => 'ID',
        'officer_id'        => 'Officer ID',
        'image'             => 'Image',
        'upload_image'      => 'Upload Image',
        'change_image'      => 'Change Image',
        'name'              => 'Name',
        'email'             => 'Email',
        'role'              => 'Role',
        'position'          => 'Position',
        'status'            => 'Status',
        'role-current'      => 'Current Role',
        'add-button'        => 'Add New Testimonial',
        'description'       => 'Description',
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

        'validation'    => [

            'name' => [
                'required'  => 'The name field is required!',
            ],
            'image' => [
                'required'  => 'The image field is required!',
                'image'     => 'The uploaded file must be an image!',
                'mimes'     => 'Only jpeg,png,jpg formats are supported!',
                'max'       => 'File size must not be more than 10M!',
            ],

        ],

    ],

    'message' => [

        'store' => [
            'success'   => 'Testimonial added successfully!',
            'error'     => 'There is an error! Please try later!',
        ],

        'update' => [
            'success'   => 'Testimonial updated successfully!',
            'error'     => 'There is an error! Please try later!',
        ],

        'destroy' => [
            'success'   => 'Testimonial deleted successfully!',
            'error'     => 'There is an error! Please try later!',
            'warning_last_Testimonial' => 'Last Testimonial can not be deleted!',
        ],
    ]

];
