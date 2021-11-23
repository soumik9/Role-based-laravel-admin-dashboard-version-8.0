<?php

return [

    'index' => [
        'title' => 'CMS Pages',
    ],

    'create' => [
        'title' => 'CMS Pages Create',
    ],

    'edit' => [
        'title' => 'CMS Pages Edit',
    ],

    'delete' => [
        'title' => 'Delete',
    ],

    'breadcrumb' => [
        'index' => 'CMS Pages',
        'create' => 'Create',
        'edit' => 'Edit',
    ],

    'form'  => [
        'id' => 'ID',
        'title' => 'Title',
        'slug' => 'Slug',
        'category' => 'Category',
        'description' => 'Description',
        'status' => 'Status',
        'permission' => 'Permission',
        'add-button' => 'Add New CMS Pages',
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
            'code' => [
                'required'  => 'The Code field is required!',
                'unique'  => 'Code already exists!',
            ],
            'symbol' => [
                'required'  => 'The Code field is required!',
            ],
            'permission' => [
                'required'  => 'Please select atleast one option!',
            ],

        ],

    ],

    'message' => [

        'store' => [
            'success' => 'CMS Pages added successfully!',
            'error' => 'There is an error! Please try later!',
        ],

        'update' => [
            'success' => 'CMS Pages updated successfully!',
            'error' => 'There is an error! Please try later!',
        ],

        'destroy' => [
            'success' => 'CMS Pages deleted successfully!',
            'error' => 'There is an error! Please try later!',
            'warning_last_CMS Pages' => 'Last CMS Pages Can not be deleted!',
        ],
    ]

];