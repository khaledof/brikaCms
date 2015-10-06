<?php


    Breadcrumbs::register('contacts.index', function (\DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs) {
        $breadcrumbs->push(trans('dashboard::global.name'),url('/admin'));
        $breadcrumbs->push(trans('contacts::global.name'));
    });

    Breadcrumbs::register('contacts.edit', function (\DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs) {
        $breadcrumbs->push(trans('dashboard::global.name'),url('/admin'));
        $breadcrumbs->push(trans('contacts::global.name'),url('/admin/contacts'));
        $breadcrumbs->push(trans('contacts::global.Edit'));
    });

    Breadcrumbs::register('contacts.create', function (\DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs) {
        $breadcrumbs->push(trans('dashboard::global.name'),url('/admin'));
        $breadcrumbs->push(trans('contacts::global.name'),url('/admin/contacts'));
        $breadcrumbs->push(trans('contacts::global.New'));
    });