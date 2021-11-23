<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push(__('dashboard.title'), route('dashboard'));
});

//Home > Home > Testimonials
Breadcrumbs::for('testimonials.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('testimonial.breadcrumb.index'), route('testimonials.index'));
});

Breadcrumbs::for('testimonials.create', function ($trail) {
    $trail->parent('testimonials.index');
    $trail->push(__('testimonial.breadcrumb.create'), route('testimonials.create'));
});

Breadcrumbs::for('testimonials.edit', function ($trail) {
    $trail->parent('testimonials.index');
    $trail->push(__('testimonial.breadcrumb.edit'), route('testimonials.edit', '$testimonial->id'));
});

//Home > cms category
Breadcrumbs::for('cmscategory.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('cmscategory.breadcrumb.index'), route('cmscategory.index'));
});

Breadcrumbs::for('cmscategory.create', function ($trail) {
    $trail->parent('cmscategory.index');
    $trail->push(__('cmscategory.breadcrumb.create'), route('cmscategory.create'));
});

Breadcrumbs::for('cmscategory.edit', function ($trail) {
    $trail->parent('cmscategory.index');
    $trail->push(__('cmscategory.breadcrumb.edit'), route('cmscategory.edit', '$category->id'));
});

// Home > User
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('user.breadcrumb.index'), route('users.index'));
});

Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push(__('user.breadcrumb.create'), route('users.create'));
});

Breadcrumbs::for('users.edit', function ($trail) {
    $trail->parent('users.index');
    $trail->push(__('user.breadcrumb.edit'), route('users.edit', '$user->id'));
});

Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('user.profile'), route('profile'));
});

// Home > Role
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('role.breadcrumb.index'), route('roles.index'));
});

Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push(__('role.breadcrumb.create'), route('roles.create'));
});

Breadcrumbs::for('roles.edit', function ($trail) {
    $trail->parent('roles.index');
    $trail->push(__('role.breadcrumb.edit'), route('roles.edit', '$role->id'));
});

// Home > Permission
Breadcrumbs::for('permissions.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('permission.breadcrumb.index'), route('permissions.index'));
});

Breadcrumbs::for('permissions.create', function ($trail) {
    $trail->parent('permissions.index');
    $trail->push(__('permission.breadcrumb.create'), route('permissions.create'));
});

Breadcrumbs::for('permissions.edit', function ($trail) {
    $trail->parent('permissions.index');
    $trail->push(__('permission.breadcrumb.edit'), route('permissions.edit', '$permission->id'));
});

// Home > File Manager
Breadcrumbs::for('filemanager.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('filemanager.breadcrumb.index'), route('filemanager.index'));
});








// Home > Currency
Breadcrumbs::for('currencies.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('currency.breadcrumb.index'), route('currencies.index'));
});

Breadcrumbs::for('currencies.create', function ($trail) {
    $trail->parent('currencies.index');
    $trail->push(__('currency.breadcrumb.create'), route('currencies.create'));
});

Breadcrumbs::for('currencies.edit', function ($trail) {
    $trail->parent('currencies.index');
    $trail->push(__('currency.breadcrumb.edit'), route('currencies.edit', '$currency->id'));
});







// Home > CMS Pages
Breadcrumbs::for('cmspages.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(__('cmspage.breadcrumb.index'), route('cmspages.index'));
});

Breadcrumbs::for('cmspages.create', function ($trail) {
    $trail->parent('cmspages.index');
    $trail->push(__('cmspage.breadcrumb.create'), route('cmspages.create'));
});

Breadcrumbs::for('cmspages.edit', function ($trail) {
    $trail->parent('cmspages.index');
    $trail->push(__('cmspage.breadcrumb.edit'), route('cmspages.edit', '$cmspage->id'));
});
