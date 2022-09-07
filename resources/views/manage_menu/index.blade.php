@extends('backend.layouts.app')

@section('css')

<link rel="stylesheet" href="{{ static_asset('assets/addon/menus/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ static_asset('assets/addon/menus/css1/style.css') }}">

@endsection


@section('content')
    <style>
        .sortable {
            min-height: 0px !important
        }

        ul#menu-group li {
            float: left;
            padding: 10px;
        }
        .modal-backdrop{
            position: relative !important;
        }

    </style>
    <!--begin::Content-->
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Manage Menu</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route("admin.dashboard") }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">eCommerce</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Website Setup</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Manage Menu</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-flush">
                <div id="wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div id="main" class="col-md-9">
                                                <ul id="menu-group">
                                                    <?php foreach ($menus as $menu) : ?>
                                                    <li id="group-<?php echo $menu->id; ?>">
                                                        <a href="<?php echo url('admin/website/menus/manage-menus?id=' . $menu->id); ?>">
                                                            <?php echo $menu->title; ?>
                                                        </a>
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <div class="clear"></div>

                                                <div class="ns-row" id="ns-header">
                                                    <div class="actions">Actions</div>
                                                    <div class="ns-url">URL</div>
                                                    <div class="ns-title">Name</div>
                                                </div>
                                                <form id="form-menu">
                                                    @csrf
                                                    <?php echo $menu_ul; ?>
                                                    <div id="ns-footer">
                                                        <button type="submit" class="btn btn-default btn-success"
                                                            id="btn-save-menu">Update Menu</button>
                                                    </div>
                                                </form>
                                                <br>
                                            </div>

                                            <div class="col-md-3 col-sm-12">
                                                <section class="box">
                                                    <h2>Info</h2>
                                                    <div>
                                                        <p>Drag the menu list to re-order, </p>
                                                        <p>Click <b>Update Menu</b> to save the
                                                            position.
                                                        </p>
                                                        <p>To add item on menu, use form below.</p>
                                                    </div>
                                                </section>

                                                <section class="box">
                                                    <h2>Add To Menu</h2>
                                                    <div>
                                                        <form id="form-add-menu" method="post"
                                                            action="{{ route('menu.store') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="menu-title">Name</label>
                                                                <input style="width: 100% !important;" type="text"
                                                                    name="name" required="" id="name"
                                                                    class="form-control">
                                                                <input type="hidden" type="text" name="menu_id" id="menu_id"
                                                                    value="@if (isset($group_id)){{ $group_id }}@endif">
                                                            </div>

                                                            <p class="buttons">
                                                                <button id="add-menu" type="submit"
                                                                    class="btn btn-success  waves-effect waves-effect waves-light waves-ripple">Add
                                                                    Menu Item
                                                                </button>
                                                            </p>
                                                        </form>
                                                    </div>
                                                </section>
                                            </div>



                                        </div>

                                    </div>
                                </div>
                                <div id="loading">
                                    <img src="<?php echo url('/public/'); ?>/assets/images/preloader.gif" alt="Loading">
                                    Processing...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    @endsection
    @section('script')
        <script>
            $(document).ready(function() {

                var menu_serialized;
                $('#easymm').nestedSortable({
                    listType: 'ul',
                    handle: 'div',
                    items: 'li',
                    placeholder: 'ns-helper',
                    opacity: .8,
                    handle: '.ns-title',
                    toleranceElement: '> div',
                    forcePlaceholderSize: true,
                    tabSize: 15,
                    update: function() {
                        menu_serialized = $('#easymm').nestedSortable('serialize');
                        $('#btn-save-menu').attr('disabled', false);

                    }
                });
                $('.edit-menu').click(function(event) {
                    var menu_id = $(this).data('menu-id');
                    edit_menu_modal(menu_id);
                });

                function edit_menu_modal(id) {
                    csrf = $('[name=_token]').val();
                    $.post('{{ route('menu.edit') }}', {
                        _token: csrf,
                        id: id
                    }, function(data) {
                        $('#menu_modal_edit .modal-content').html(data);
                        $('#menu_modal_edit').modal('show', {
                            backdrop: 'static'
                        });
                    });
                }



                /* update menu / save order Positions
            ------------------------------------------------------------------------- */
                /* update menu / save order Positions
            ------------------------------------------------------------------------- */
                $('#btn-save-menu').attr('disabled', true);
                $('#form-menu').submit(function() {
                    $('#btn-save-menu').attr('disabled', true);
                    csrf = $('[name=_token]').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('updateMenus') }}",
                        data: menu_serialized + '&_token=' + csrf,
                        error: function() {
                            $('#btn-save-menu').attr('disabled', false);
                            AIZ.plugins.notify('error',
                                '<h2>Error</h2>Save menu error. Please try again.');
                        },
                        success: function(data) {
                            AIZ.plugins.notify('success', 'Menu has been updated successfully');
                        }
                    });

                    return false;
                });

                $('#select-all-categories').click(function(event) {
                    if (this.checked) {
                        $('#categories-list :checkbox').each(function() {
                            this.checked = true;
                        });
                    } else {
                        $('#categories-list :checkbox').each(function() {
                            this.checked = false;
                        });
                    }
                });

                $('#select-all-posts').click(function(event) {
                    if (this.checked) {
                        $('#posts-list :checkbox').each(function() {
                            this.checked = true;
                        });
                    } else {
                        $('#posts-list :checkbox').each(function() {
                            this.checked = false;
                        });
                    }
                });
            });
        </script>



        @if ($desiredMenu)
            <script>
                $('#add-categories').click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var n = $('input[name="select-category[]"]:checked').length;
                    var array = $('input[name="select-category[]"]:checked');
                    var ids = [];
                    for (i = 0; i < n; i++) {
                        ids[i] = array.eq(i).val();
                    }
                    if (ids.length == 0) {
                        return false;
                    }
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            ids: ids
                        },
                        url: "{{ url('add-categories-to-menu') }}",
                        success: function(res) {
                            location.reload();
                        }
                    })
                })
                $('#add-posts').click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var n = $('input[name="select-post[]"]:checked').length;
                    var array = $('input[name="select-post[]"]:checked');
                    var ids = [];
                    for (i = 0; i < n; i++) {
                        ids[i] = array.eq(i).val();
                    }
                    if (ids.length == 0) {
                        return false;
                    }
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            ids: ids
                        },
                        url: "{{ url('add-post-to-menu') }}",
                        success: function(res) {
                            location.reload();
                        }
                    })
                })
                $("#add-custom-link").click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var url = $('#url').val();
                    var link = $('#linktext').val();
                    if (url.length > 0 && link.length > 0) {
                        $.ajax({
                            type: "get",
                            data: {
                                menuid: menuid,
                                url: url,
                                link: link
                            },
                            url: "{{ url('add-custom-link') }}",
                            success: function(res) {
                                location.reload();
                            }
                        })
                    }
                })
            </script>
            <script>

            </script>
            <script>
                $('#saveMenu').click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var location = $('input[name="location"]:checked').val();
                    var newText = $("#serialize_output").text();
                    var data = JSON.parse($("#serialize_output").text());
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            data: data,
                            location: location
                        },
                        url: "{{ url('update-menu') }}",
                        success: function(res) {
                            window.location.reload();
                        }
                    })
                })
            </script>

            <!-- delete Modal -->
            <div id="delete-modal" class="modal fade" style="z-index: 1040; display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title h6">Delete Confirmation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="mt-1">Are you sure to delete this?</p>
                            <button type="button" class="btn btn-link mt-2" data-dismiss="modal">Cancel</button>
                            <a href="http://localhost/turkish/products/destroy/6400" id="delete-link"
                                class="btn btn-primary mt-2">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- delete Modal -->



            <div class="modal fade" id="menu_modal_edit" style="z-index: 1040; display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="modal-content">
                        <form action="http://localhost/turkish/admin/your-currency/update" method="POST">
                            <input type="hidden" name="_token" value="BvZv28TKmBErc9JzaIJx5u5ndRfBezXXzUQlAsQa"> <input
                                type="hidden" name="id" value="1">
                            <div class="modal-header">
                                <h5 class="modal-title h6">Update Currency</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label" for="name">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Name" id="name" name="name" value="U.S. Dollar"
                                            class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label" for="symbol">Symbol</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Symbol" id="symbol" name="symbol" value="$"
                                            class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label" for="code">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Code" id="code" name="code" value="USD"
                                            class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label" for="exchange_rate">Exchange Rate</label>
                                    <div class="col-sm-10">
                                        <input type="number" lang="en" step="0.01" min="0" placeholder="Exchange Rate"
                                            id="exchange_rate" name="exchange_rate" value="1" class="form-control"
                                            required="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <script src="{{ static_asset('assets/addon/menus/jquery-ui.js') }}" ></script>
        <script src="{{ static_asset('assets/addon/menus/js1/jquery.mjs.nestedSortable.js') }}"></script>
    @endsection
