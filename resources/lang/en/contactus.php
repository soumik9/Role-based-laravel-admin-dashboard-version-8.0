<?php

return [

    'index' => [
        'title' => 'Contact Us',
    ],

    'create' => [
        'title' => 'Contact Us Create',
    ],

    'edit' => [
        'title' => 'Contact Us Edit',
    ],

    'delete' => [
        'title' => 'Delete',
    ],

    'breadcrumb' => [
        'index' => 'Contact Us',
        'create' => 'Create',
        'edit' => 'Edit',
    ],

    'form'  => [
        'id' => 'ID',
        'name' => 'Name',

        'image'         => 'Images',
        'amenities'     => 'Amenities',
        'price'         => 'Price',
        'title'         => 'Title',
        'description'   => 'Description',

        'email'     => 'Email',
        'subject'   => 'Subject',
        'content'   => 'Content',

        'status' => 'Status',
        'permission' => 'Permission',
        'add-button' => 'Add New Contact Us',
        'save-button' => 'Save',
        'edit-button' => 'Edit',
        'update-button' => 'Update',
        'delete-button' => 'Delete',
        'action' => 'Action',
        'edit'              => 'Edit',
        'delete'            => 'Delete',
        'delete-message' => 'Are you sure?',


        'validation'    => [
            'name' => [
                'required'  => 'The name field is required!',
                'unique'  => 'Name already exists!',
            ],
            'email' => [
                'required'  => 'The email field is required!',
            ],
            'phone' => [
                'required'  => 'The phone field is required!',
            ],
            'subject' => [
                'required'  => 'The subject field is required!',
            ],
            'content' => [
                'required'  => 'The content field is required!',
            ],

        ],

    ],

    'message' => [

        'store' => [
            'success' => 'Contact Us send successfully!',
            'error' => 'Contact Us Send Failed! Please try later!',
        ],

        'update' => [
            'success' => 'Contact Us updated successfully!',
            'error' => 'There is an error! Please try later!',
        ],

        'destroy' => [
            'success' => 'Contact Us deleted successfully!',
            'error' => 'There is an error! Please try later!',
            'warning_last_Email' => 'Last Contact Us Can not be deleted!',
        ],
    ]

];
