<?php

return [

    'index' => [
        'title' => 'Room Categories',
    ],

    'create' => [
        'title' => 'Category Create',
    ],

    'edit' => [
        'title' => 'Category Edit',
    ],

    'delete' => [
        'title' => 'Delete',
    ],

    'breadcrumb' => [
        'index' => 'Room Categories',
        'create' => 'Create',
        'edit' => 'Edit',
    ],

    'form'  => [
        'id' => 'ID',
        'name' => 'Name',
        'icon' => 'Icon',
        'status' => 'Status',
        'slug' => 'Slug',
        'permission' => 'Permission',
        'add-button' => 'Add New Category',
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
            'permission' => [
                'required'  => 'Please select atleast one option!',
            ],

        ],

    ],

    'message' => [

        'store' => [
            'success' => 'Category added successfully!',
            'error' => 'There is an error! Please try later!',
        ],

        'update' => [
            'success' => 'Category updated successfully!',
            'error' => 'There is an error! Please try later!',
        ],

        'destroy' => [
            'success' => 'Category deleted successfully!',
            'error' => 'There is an error! Please try later!',
            'warning_last_Category' => 'Last Category Can not be deleted!',
        ],
    ]

];
