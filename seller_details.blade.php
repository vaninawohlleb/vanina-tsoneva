@section('page_title', 'Seller Details')
@section('page_action')
    @extends('layouts.default')
@section('content')
@php
    $tracking_date = date_create($company_info_arr['tracking_since']);
    $last_violation = date_create($company_info_arr['last_violation']);
@endphp
<div class="seller-details">
    <div class="row company">
        <div class="company__status">
            <h2>{{ $company_info_arr['amazon_seller_name'] ?? '' }}</h2>
            <div class="status__labels">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="_seller_id" id="_seller_id" value="{{ $seller_id }}">
                @if ($company_info_arr['on_notice_status'] == true)
                    <span class="btn kt-subheader__btn-secondary active" id="on_notice" onclick="toggleStatus(this, 'on notice')">on notice</span>
                @elseif ($company_info_arr['on_notice_status'] == false)
                    <span class="btn kt-subheader__btn-secondary" onclick="toggleStatus(this, 'on notice')" id="on_notice">on notice</span>
                @endif
                @if ($company_info_arr['neutral_status'] == true)
                        <span class="btn kt-subheader__btn-secondary active" onclick="toggleStatus(this, 'neutral')" id="neutral">neutral</span>
                @elseif ($company_info_arr['neutral_status'] == false)
                        <span class="btn kt-subheader__btn-secondary" onclick="toggleStatus(this, 'neutral')" id="neutral">neutral</span>
                @endif
                @if ($company_info_arr['resolved_status'] == true)
                        <span class="btn kt-subheader__btn-secondary active" onclick="toggleStatus(this, 'resolved')" id="resolved">resolved</span>
                @elseif ($company_info_arr['resolved_status'] == false)
                    <span class="btn kt-subheader__btn-secondary" onclick="toggleStatus(this, 'resolved')" id="resolved">resolved</span>
                @endif
            </div>
        </div>
        <script type="text/javascript">
            function toggleStatus(elem, status){
                $(elem).addClass('active').siblings().removeClass('active');
                $.ajax({
                    url: "/update_company_status",
                    type: "PUT",
                    data: { "_token": $('#token').val(), "seller_id":  $('#_seller_id').val(), "status": status },
                    success: function(response) {

                    }
                });
            }
        </script>

        <div class="company__details">
            @if($company_info_arr['company_name'])
                <span class="company-name">
                    <i class="flaticon-home-2"></i>
                    {{ $company_info_arr['company_name'] }}
                </span>
            @endif
            @if($company_info_arr['main_contact_email'])
                <span class="email">
                    <i class="flaticon2-mail"></i>
                    {{ $company_info_arr['main_contact_email'] }}
                </span>
            @endif
            @if($company_info_arr['main_contact_phone'])
                <span class="phone">
                    <i class="flaticon2-chat-1"></i>
                    {{ $company_info_arr['main_contact_phone'] }}
                </span>
            @endif
            @if($company_info_arr['city_1'])
                <span class="address">
                    <i class="flaticon2-open-text-book"></i>
                    {{ $company_info_arr['city_1'] }},  {{ $company_info_arr['state_1'] }}
                </span>
            @endif

            <span class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="">
            <a href="javascript:void(0);" class="modal-button">more info</a>
          </span>

            <div id="kt_demo_panel" class="kt-demo-panel">
                <a href="javascript:void(0);" class="kt-demo-panel__close" id="kt_demo_panel_close"><i class="flaticon-close"></i></a>

                <div class="kt-demo-panel__head" kt-hidden-height="49">
                    <i class="flaticon2-avatar"></i>
                    <h2 class="kt-demo-panel__title">
                        Company Profile
                    </h2>
                </div>

                <div class="kt-demo-panel__body kt-scroll ps ps--active-y">
                    <form class="panel-form" method="POST" action="/update-seller-company-info/{{ $company_info_arr['id'] }}" id="edit_seller_company_info">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="seller_company_id" id="seller_company_id" value="{{ $company_info_arr['id'] }}" />
                        <ul class="kt-demo-panel__item kt-demo-panel__item--active">
                            <li>
                                <p class="item-header">
                                    <i class="flaticon2-open-text-book"></i>
                                    Entity Info
                                </p>
                                <input type="text" name="company_name" disabled value="{{ $company_info_arr['company_name'] ? $company_info_arr['company_name'] : '' }}" placeholder="Company Name"/>
                                <input type="text" name="street_1" disabled value="{{ $company_info_arr['street_1'] ? $company_info_arr['street_1'] : '' }}" placeholder="Street"/>
                                <input type="text" name="city_1" disabled value="{{ $company_info_arr['city_1'] ? $company_info_arr['city_1'] : '' }}" placeholder="City" />
                                <input type="text" name="state_1" disabled value="{{ $company_info_arr['state_1'] ? $company_info_arr['state_1'] : '' }}" placeholder="State"/>
                                <input type="text" name="zip_1" disabled value="{{ $company_info_arr['zip_1'] ? $company_info_arr['zip_1'] : '' }}" placeholder="ZIP"/>
                                <input type="text" name="company_phone" disabled value="{{ $company_info_arr['company_phone'] ? $company_info_arr['company_phone'] : '' }}" placeholder="Companys Phone"/>
                                <input type="text" name="website" disabled value="{{ $company_info_arr['website'] ? $company_info_arr['website'] : '' }}" placeholder="Companys Website"/>
                            </li>

                            <li>
                                <p class="item-header">
                                    <i class="flaticon2-chat"></i>
                                    Primary Contact
                                </p>
                                <input type="text" name="main_contact" disabled value="{{ $company_info_arr['main_contact'] ? $company_info_arr['main_contact'] : '' }}" placeholder="Main Contact"/>
                                <input type="text" name="main_contact_title" disabled value="{{ $company_info_arr['main_contact_title'] ? $company_info_arr['main_contact_title'] : '' }}" placeholder="Contact Title"/>
                                <input type="text" name="main_contact_email" disabled value="{{ $company_info_arr['main_contact_email'] ? $company_info_arr['main_contact_email'] : '' }}" placeholder="Contact Email"/>
                                <input type="text" name="main_contact_phone" disabled value="{{ $company_info_arr['main_contact_phone'] ? $company_info_arr['main_contact_phone'] : '' }}" placeholder="Contact Phone"/>
                            </li>

                            <li>
                                <p class="item-header">
                                    <i class="flaticon2-talk"></i>
                                    Secondary Contact
                                </p>
                                <input type="text" name="secondary_contact" disabled value="{{ $company_info_arr['secondary_contact'] ? $company_info_arr['secondary_contact'] : '' }}" placeholder="Secondary Contact"/>
                                <input type="text" name="secondary_contact_title" disabled value="{{ $company_info_arr['secondary_contact_title'] ? $company_info_arr['secondary_contact_title'] : '' }}" placeholder="Secondary Contact Title"/>
                                <input type="text" name="secondary_contact_email" disabled value="{{ $company_info_arr['secondary_contact_email'] ? $company_info_arr['secondary_contact_email'] : '' }}" placeholder="Secondary Contact Email"/>
                                <input type="text" name="secondary_contact_phone" disabled value="{{ $company_info_arr['secondary_contact_phone'] ? $company_info_arr['secondary_contact_phone'] : '' }}" placeholder="Secondary Contact Phone"/>
                            </li>

                            <li>
                                <p class="item-header">
                                    <i class="flaticon2-calendar"></i>
                                    Tracking Since
                                </p>
                                <p>{{ date_format($tracking_date, "d-M-Y") }}</p>
                            </li>

                            <li>
                                <p class="item-header">
                                    <i class="flaticon2-hourglass"></i>
                                    Last Violation Date
                                </p>
                                <p>{{ date_format($last_violation, "d-M-Y")  }}</p>
                            </li>

                            <li>
                                <p class="item-header">
                                    <i class="flaticon2-settings"></i>
                                    Amazon Seller ID
                                </p>
                                <p>{{ $company_info_arr['id'] }}</p>
                            </li>
                        </ul>
                        <div class="save-buttons">
                            <button type="button" class="btn btn-icon-md btn-light-grey edit-button">
                                <i class="la la-edit"></i>
                            </button>
                            <button type="button" class="btn btn-icon-md btn-label-success save-button" onclick="saveSellerCompanyInfo();">
                                <i class="la la-save"></i>
                            </button>
                        </div>
                    </form>
                    <script type="text/javascript">
                        function saveSellerCompanyInfo(){
                            var sellerCompanyID = $('#seller_company_id').val();
                            var formData = $('#edit_seller_company_info').serialize();
                            $.ajax({
                                url: "/update-seller-company-info/" + sellerCompanyID,
                                type: "POST",
                                data: formData,
                                success: function(response) {

                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="row status">
        <div class="kt-portlet first">
            <div class="notices">
                <div class="active">
                    <h5>1st notice</h5>
                    <span>
            <i class="flaticon2-calendar"></i>
            13 March
          </span>
                </div>
                <div class="active">
                    <h5>2nd notice</h5>
                    <span>
            <i class="flaticon2-calendar"></i>
            22 March
          </span>
                </div>
                <div>
                    <h5>3rd notice</h5>
                </div>
                <div>
                    <h5>4th notice</h5>
                </div>
            </div>

            <div class="charts">
                <div>
                    <div class="chart__heading">
                        <h2>{{ $data['total_offers'] }}</h2>
                        <h5>Total Offers</h5>
                    </div>
                    <i class="flaticon2-pie-chart"></i>
                </div>

                <div>
                    <div class="chart__heading">
                        <h2>{{ $data['total_violations'] }}</h2>
                        <h5>Total Violations</h5>
                    </div>
                    <i class="flaticon2-pie-chart"></i>
                </div>

                <div class="total-stock">
                    <div class="chart__heading">
                        <h2>{{ $data['total_inventory'] }}</h2>
                        <h5>Total Stock</h5>
                    </div>
                    <i class="flaticon2-pie-chart"></i>
                </div>

                <div class="buyboxes">
                    <div class="chart__heading">
                        <h2>{{ $data['total_buy_boxes'] }}</h2>
                        <h5>Total Buyboxes</h5>
                    </div>
                    <i class="flaticon2-pie-chart"></i>
                    <div class="progress-stats">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $data['buy_box_percent'] }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action">
                            <span class="kt-widget24__change">Percent of Buy Boxes</span>
                            <span class="kt-widget24__number">{{ $data['buy_box_percent'] }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet last timeline">
            <div class="kt-portlet__head">
                <h4 class="kt-portlet__head-title">Notes</h4>
                <button type="button" class="btn btn-icon-md btn-label-success" data-toggle="modal" data-target="#addNoteModal">
                    <i class="la la-plus"></i>
                    <span>Add a note</span>
                </button>
            </div>

            <!--begin::Add note modal -->
            <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Adding a note</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="add_note" id="add_note" method="POST" action="">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" id="new_note_id" value="0">
                            <input type="hidden" name="seller_id" id="new_note_seller_id" value="{{ $seller_id }}">
                            <input type="hidden" name="client_id" id="new_note_client_id" value="{{ $client_id }}">
                            <div class="modal-body">
                                <textarea name="note_content" id="new_note_content"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-success" data-dismiss="modal" onclick="addNewNote();">Add note</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end::Add Note Modal -->

            <!-- being::Add Note JS-->
            <script type="text/javascript">

                function addNewNote(){
                    // Get the form data serialized
                    var dataSerialized = $( "#add_note" ).serialize();
                    $.ajax({
                        url: "/seller-notes/create",
                        type: "GET",
                        data: dataSerialized,
                        success: function(response) {
                            // Success
                            const noteHtmlTemplate = '\
                            <div class="kt-timeline-v2__item">\
                            <span class="kt-timeline-v2__item-time">{{ date("d M", time()) }}</span>\
                            <div class="kt-timeline-v2__item-cricle">\
                                <i class="fa fa-genderless kt-font-danger"></i>\
                            </div>\
                            <div class="kt-timeline-v2__item-text">\
                                <span id="note_content_[[ID]]">[[CONTENT]]</span>\
                            </div>\
                            <div class="dropdown dropdown-inline show">\
                                <a class="btn btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                                    <i class="flaticon-more-1"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-150px, -68px, 0px);">\
                                    <ul class="kt-nav">\
                                        <li class="kt-nav__item">\
                                            <a class="kt-nav__link" data-toggle="modal" data-target="#editNoteModal" onclick="editNote([ID]]);">\
                                                <i class="kt-nav__link-icon la la-edit"></i>\
                                                <span class="kt-nav__link-text">Edit</span>\
                                            </a>\
                                        </li>\
                                        <li class="kt-nav__item">\
                                            <a class="kt-nav__link" data-toggle="modal" data-target="#deleteNoteModal" onclick="setIdToDeleteNote([ID]]);">\
                                                <i class="kt-nav__link-icon la la-gear"></i>\
                                                <span class="kt-nav__link-text">Delete</span>\
                                            </a>\
                                        </li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>'

                        const id = response;
                        if (id != 0 || id != false || id != 'false') {
                            const noteHtml = noteHtmlTemplate.replace("[[CONTENT]]", $("#new_note_content").val()).replace(/[[ID]]/g, id)
                            $(".kt-timeline-v2__items").append(noteHtml)
                        }
                        $("#new_note_content").val("")
                        }
                    });
                }
            </script>
            <!-- end::Add Note JS-->

            <!--begin::Notes -->
            <div class="kt-timeline-v2">
                <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                    <!--being::Note Item-->
                    @foreach ($seller_notes as $note)
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">{{ date("d M", strtotime($note->updated_at)) }}</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-success"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text">
                                <span id="note_content_{{ $note->id }}">{{ $note->note_content }}</span>
                            </div>

                            <div class="dropdown dropdown-inline show">
                                <a class="btn btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-150px, -68px, 0px);">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link" data-toggle="modal" data-target="#editNoteModal" onclick="editNote({{ $note->id }});">
                                                <i class="kt-nav__link-icon la la-edit"></i>
                                                <span class="kt-nav__link-text">Edit</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link" data-toggle="modal" data-target="#deleteNoteModal" onclick="setIdToDeleteNote({{ $note->id }});">
                                                <i class="kt-nav__link-icon la la-gear"></i>
                                                <span class="kt-nav__link-text">Delete</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                @endforeach
                <!--end::Note Item-->
                </div>
            </div>
            <!--end::Notes -->

            <!-- being::Edit note modal -->
            <div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog" aria-labelledby="editNoteModalLabel" aria-hidden="true">
                <form name="edit_note" id="edit_note" method="POST" action="">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="note_id" value="0">
                    <input type="hidden" name="seller_id" id="note_seller_id" value="{{ $seller_id }}">
                    <input type="hidden" name="client_id" id="note_client_id" value="{{ $client_id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editing a note</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea name="note_content" id="note_content"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-success" data-dismiss="modal" onclick="saveEditedNote();">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end::Edit note modal -->

            <!-- being::Edit Note JS-->
            <script type="text/javascript">

                function editNote(note_id){
                    // Get contents of note
                    var noteContent = $('#note_content_' + note_id).html();
                    // Change contents of note to text area in edit modal box to the current contents of the note being edited
                    $('#note_content').val(noteContent);
                    // Change note ID value in edit modal box form for updating the note
                    $('#note_id').val(note_id);
                }

                function saveEditedNote(){
                    const noteId = $('#note_id').val()
                    $("#note_content_" + noteId).text($("#note_content").val())

                    var dataSerialized = $( "#edit_note" ).serialize();
                    $.ajax({
                        url: "/seller-notes/update",
                        type: "PUT",
                        data: dataSerialized,
                        success: function(response) {
                            var dataArray = $("#edit_note").serializeArray();
                            var dataObj = {};
                            $(dataArray).each(function(i, field){
                                dataObj[field.name] = field.value;
                            });
                            // Get NoteID
                            var noteId = dataObj['id'].toString();
                            // Get contents of edited note
                            var noteContent = dataObj['note_content'].toString();
                            // Replace note HTML on screen with edited text
                            $('#note_content_' + noteId).text(noteContent);
                            $('#note_content').text(noteContent);
                        }
                    });
                }
            </script>
            <!-- end::Edit Note JS-->

            <!-- being::Delete note modal -->
            <div class="modal fade" id="deleteNoteModal" tabindex="-1" role="dialog" aria-labelledby="deleteNoteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Deleting a note</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="delete_note" id="delete_note" action="" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="delete_note_id" id="delete_note_id" value="NaN">
                            <div class="modal-body">
                                <p>Are you sure you want to delete this note?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal" onclick="deleteNote();">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end::Delete note modal -->

            <!-- being::Delete Note JS-->
            <script type="text/javascript">

                function setIdToDeleteNote(note_id){
                    // Change note ID value in edit modal box form for updating the note
                    $('#delete_note_id').val(note_id);
                }

                function deleteNote(){
                    // Change note ID value in edit modal box form for updating the note
                    var note_id = $('#delete_note_id').val();
                    $("#note_content_" + note_id).parents(".kt-timeline-v2__item").remove()

                    // Get form data for delete note
                    var dataSerialized = $("#delete_note").serialize();
                    $.ajax({
                        url: "/seller-notes/destroy",
                        type: "DELETE",
                        data: dataSerialized,
                        success: function(response) {
                            var dataArray = $("#delete_note").serializeArray();
                            var dataObj = {};
                            $(dataArray).each(function(i, field){
                                dataObj[field.name] = field.value;
                            });
                        }
                    });
                }
            </script>
            <!-- end::Delete Note JS-->

        </div>
    </div>

    <div class="row kt-portlet sellers-history">
        <div class="kt-portlet__header">
            <i class="flaticon2-line-chart"></i>
            <h4 class="kt-portlet__head-title">Sellers History</h4>
        </div>
        <div class="kt-portlet__body">
            <div id="amcharts_big_chart" style="height: 450px;"></div>
        </div>
    </div>

    <div class="row kt-portlet sellers-overview">
        <div class="kt-portlet__header">
            <i class="flaticon2-graph-1"></i>
            <h4 class="kt-portlet__head-title">Seller Overview</h4>
            <div class="kt-portlet__head-date">
                <span>Date Displayed:</span>
                <span class="bold-text">{{ $data['current_date'] }}</span>
            </div>
        </div>

        @component('components.subheader')
        @endcomponent

        <div class="kt-portlet__body kt-portlet__body--no-padding">
            <div id="kt-datatable" class="kt-datatable kt-datable--gray-header" style="height: 300px;"></div>

            <!--start: Table Modal -->
            <div class="modal table-modal fade" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" id="modal_content">
                        <div class="modal-header" id="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="loading">Loading data ... </div>
                        <div class="modal-body" id="modal-body"></div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                function openASINModalBox(url){
                    var url = url;
                    $.ajax({
                        type: "GET",
                        url: url,
                        beforeSend: function() {
                            $('.table-modal').modal('show');
                        },
                        success: function (response) {
                            // update modal content
                            $('#modal-body').html(response);
                            $(".loading").hide();
                        },
                        error: function (request, status, error) {
                            console.log("Error with AJAX call:" + request.responseText);
                        }
                    });
                }
            </script>
            <!--end: Modal -->

        </div>
    </div>
</div>
@stop

@section('html_footer')

    <!-- enable inputs -->
    <script type="text/javascript">
        $('.edit-button').click(function() {
            $("input").prop('disabled', false);
        })
        $('.save-button').click(function() {
            $("input").prop('disabled', true);
        })
    </script>
    <!-- end input enabling -->
    <script type="text/javascript">
    var KTDatatableCalculateTotals = function (tableData) {
            var totalValues = {ProductName: '', SKU: '', ASIN: '', Price: '', MAP: '', Stock: '', Prime: '', BuyBox: ''}; //Just test data
            var totalForProductName = 0;
            var totalForPrice = 0;
            var totalForStock = 0;
            var totalForPrime = 0;
            var totalForBuyBox = 0;

            if (tableData.length !== 0 ) {
                $.each(tableData, function(i, row){
                    if (parseFloat(row.Price) < parseFloat(row.MAP)) {
                        totalForPrice++;
                    }

                    totalForStock += parseInt(row.Stock);
                    
                    if (row.Prime === 1) {
                        totalForPrime++;
                    }

                    if (row.BuyBox === 1) {
                        totalForBuyBox++;
                    }
                })
                totalForProductName = tableData.length;
            }
            totalValues.ProductName = totalForProductName + " Products";
            totalValues.Price = totalForPrice + " Violations";
            totalValues.Stock = totalForStock + " In Stock";
            totalValues.Prime = totalForPrime + " Prime";
            totalValues.BuyBox = totalForBuyBox + " Buy Boxes";

            return totalValues;
        }

        "use strict";
        // Class definition
        var currentData,
            datatable;

        var KTDatatableRemoteAjax = function () {
            // Ajax Table
            var AjaxTable = function () {
                datatable = $('.kt-datatable').KTDatatable({
                    // data source definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: '{{ $json_location }}',
                                method: 'GET',
                                map: function (raw) {
                                    // sample data mapping
                                    var dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    return dataSet;
                                },
                            },
                        },
                        pageSize: 10,
                        serverPaging: false,
                        serverFiltering: false,
                        serverSorting: false,
                    },

                    // layout definition
                    layout: {
                        scroll: true,
                        footer: false,
                    },

                    // column sorting
                    sortable: true,
                    pagination: true,

                    search: {
                        input: $('#generalSearch'),
                    },

                    rows: {
                        afterTemplate: function (row, data, index) {
                            if (index === 0) {
                                currentData = datatable.rows().dataSet.prevObject
                                var totalRowData = KTDatatableCalculateTotals(currentData)
                                const html = 
                                    '<tr data-row="-1" class="kt-datatable__row totals" style="left: 0px;">\
                                        <td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="ProductName" data-autohide-disabled="false" style="max-width: 50px">\
                                            <span>' + totalRowData.ProductName + '</span>\
                                        </td>\
                                        <td data-field="BuyBox" class="kt-datatable__cell" data-autohide-disabled="false" style="max-width: 50px">\
                                            <span style="opacity: 0;">' + totalRowData.BuyBox + '</span>\
                                        </td>\
                                        <td data-field="BuyBox" class="kt-datatable__cell" data-autohide-disabled="false" style="max-width: 40px">\
                                            <span style="opacity: 0;">' + totalRowData.BuyBox + '</span>\
                                        </td>\
                                        <td data-field="Price" class="kt-datatable__cell" style="max-width: 40px">\
                                            <span>' + totalRowData.Price + '</span>\
                                        </td>\
                                        <td data-field="Price" class="kt-datatable__cell" style="max-width: 40px">\
                                            <span style="opacity: 0;">' + totalRowData.Price + '</span>\
                                        </td>\
                                        <td data-field="Stock" class="kt-datatable__cell" data-autohide-disabled="false" style="max-width: 30px">\
                                            <span>' + totalRowData.Stock + '</span>\
                                        </td>\
                                        <td data-field="Prime" class="kt-datatable__cell" data-autohide-disabled="false" style="max-width: 30px">\
                                            <span>' + totalRowData.Prime + '</span>\
                                        </td>\
                                        <td data-field="BuyBox" class="kt-datatable__cell" data-autohide-disabled="false" style="max-width: 40px">\
                                            <span>' + totalRowData.BuyBox + '</span>\
                                        </td>\
                                    </tr>'
                                row.before(html)
                            }
                        }
                    },


                    // columns definition
                    columns: [
                        // {
                        //     field: 'ID',
                        //     title: '',
                        //     width: 1,
                        //     type: 'number',
                        //     selector: false,
                        //     class: 'hide'
                        // },
                        {
                            field: 'ProductName',
                            title: 'Product Name',
                            type: 'string',
                            selector: false,
                            width: 130,
                            sortCallback: function(data, sort, column) {
                                var field = column.field
                                return $(data).sort(function(a, b) {
                                    var aField = a[field],
                                        bField = b[field];

                                    if (sort === 'asc') {
                                        return $(aField).html().toUpperCase() > $(bField).html().toUpperCase() ? 1 :
                                            $(aField).html().toUpperCase() < $(bField).html().toUpperCase() ? -1 : 0;
                                    } else {
                                        return $(aField).html().toUpperCase() < $(bField).html().toUpperCase() ? 1 : $(aField).html().toUpperCase() > $(bField).html().toUpperCase() ? -1 : 0;
                                    }
                                })
                            }
                        }, {
                            field: 'SKU',
                            title: 'SKU',
                            type: 'string',
                            selector: false,
                            width: 80,
                        }, {
                            field: 'ASIN',
                            title: 'ASIN',
                            type: 'string',
                            selector: false,
                            width: 80,
                        }, {
                            field: 'Price',
                            title: 'Price',
                            type: 'number',
                            width: 80,
                            selector: false,
                            // logic for displaying price red when there are violations
                            template: function(row) {
                                var price = parseFloat(row.Price);
                                var map = parseFloat(row.MAP);
                                if (price < map) {
                                    return '<span class="kt-badge kt-badge--inline kt-badge--danger">' + '$' + row.Price + '</span>';
                                } else {
                                    return '$' + row.Price;
                                }
                            }
                        }, {
                            field: 'MAP',
                            title: 'MAP',
                            type: 'number',
                            selector: false,
                            width: 80,
                            template: function(row) {
                                return '$' + row.MAP;
                            }
                        }, {
                            field: 'Stock',
                            title: 'Stock',
                            type: 'number',
                            selector: false,
                            width: 60
                        }, {
                            field: 'Prime',
                            title: 'Prime',
                            type: 'number',
                            width: 60,
                            selector: false,
                            template: function(row) {
                                if(row.Prime === 1) {
                                    return '<span><img class="small-logo active" src="{{asset('assets/media/logos/prime.png')}}"></span>'
                                } else {
                                    return '<span><img class="small-logo" src="{{asset('assets/media/logos/prime_grey.png')}}"></span>'
                                }
                            }
                        }, {
                            field: 'BuyBox',
                            title: 'BuyBox',
                            type: 'number',
                            width: 60,
                            selector: false,
                            template: function(row) {
                                if(row.BuyBox === 1) {
                                    return '<span class="check checked"><i class="la la-check-circle"></i></span>'
                                } else {
                                    return '<span class="check unchecked"><i class="la la-check-circle"></i></span>'
                                }
                            }
                        },
                        {
                            field: 'Violation',
                            title: 'Violation',
                            type: 'number',
                            selector: false,
                            class: "hide"
                        }]
                });
                $("#kt_form_violations").on("click", function (event) {
                    event.preventDefault();
                    $("button").toggleClass("active");
                    datatable.search($(this).val(), "Violation")
                }), 
                $("#kt_form_all").on("click", function (event) {
                    event.preventDefault();
                    $("button").toggleClass("active");
                    datatable.search($(this).val(), "Violation")
                })
            };

            return {
                // public functions
                init: function () {
                    AjaxTable();
                },
            };
        }();

        jQuery(document).ready(function () {
            KTDatatableRemoteAjax.init();
            $("[title|='JavaScript charts']").hide();
        });
    </script>

    <!--begin::Page Vendors(used by this page) -->

    <!-- AmChart version 4 -->
    <script src="{{URL::to('/')}}/js/amcharts4/core.js" type="text/javascript"></script>
    <script src="{{URL::to('/')}}/js/amcharts4/charts.js" type="text/javascript"></script>
    <script src="{{URL::to('/')}}/js/amcharts4/themes/animated.js" type="text/javascript"></script>
    <!--end::Page Vendors -->

    <!--begin::AmChart V4 Big Chart -->
    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);

        var chart = am4core.create("amcharts_big_chart", am4charts.XYChart);
        chart.data = {!! str_replace("\"data\":", "", $json_data) !!};
        // Set input format for the dates
        chart.dateFormatter.dateFormat = "d MMM";

        // Create Axis
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.cursorTooltipEnabled = false;
        dateAxis.renderer.grid.template.disabled = true;
        dateAxis.renderer.minLabelPosition = 0.05;
        dateAxis.renderer.maxLabelPosition = 0.95;

        // Show different zoom levels depending on data
        if(chart.data.length < 14) {
            dateAxis.start = 0.03;
            dateAxis.end = 0.97;
        } else if(chart.data.length > 14 && chart.data.length < 90) {
            dateAxis.start = 0;
            dateAxis.end = 1;
        } else if(chart.data.length > 90 && chart.data.length < 300) {
            dateAxis.start = 0.5;
        } else {
            dateAxis.start = 0.75;
        }
        
        dateAxis.keepSelection = true;

        var violationsAxis = chart.yAxes.push(new am4charts.ValueAxis());
        violationsAxis.cursorTooltipEnabled = false;
        violationsAxis.title.text = "Offers | Violations";
        violationsAxis.min = 0;
        // violationsAxis.strictMinMax = true;
        // violationsAxis.renderer.baseGrid.disabled = true;
        violationsAxis.renderer.grid.template.strokeOpacity = 0;

        // Remove decimal values
        violationsAxis.renderer.labels.template.adapter.add("text", function(text, target) {
            return text.match(/\./) ? "" : text;
        });

        var inventoryAxis = chart.yAxes.push(new am4charts.ValueAxis());
        inventoryAxis.cursorTooltipEnabled = false;
        inventoryAxis.title.text = "Stock";
        inventoryAxis.renderer.opposite = true;
        inventoryAxis.syncWithAxis = violationsAxis;
        // inventoryAxis.min = 0;
        // inventoryAxis.strictMinMax = true;
        // inventoryAxis.renderer.baseGrid.disabled = true;
        inventoryAxis.renderer.grid.template.strokeOpacity = 0;

        // Remove decimal values
        inventoryAxis.renderer.labels.template.adapter.add("text", function(text, target) {
            return text.match(/\./) ? "" : text;
        });

        // Line Series 1 configuration
        var series = chart.series.push(new am4charts.LineSeries());
        series.name = "Offers";
        series.dataFields.valueY = "offers";
        series.dataFields.dateX = "date";
        series.yAxis = violationsAxis;

        // Visuals
        // series.tooltipHTML = "<strong>{valueY}</strong> offers</span>";
        // series.showTooltipOn = "hover";
        series.stroke = am4core.color("#ECEDF3");
        series.strokeWidth = 2;
        series.fill = am4core.color("#ECEDF3");
        series.fillOpacity = 0.9;

        // Line Series 2 configuration
        var series2 = chart.series.push(new am4charts.LineSeries());
        series2.name = "Violations";
        series2.dataFields.valueY = "violations";
        series2.dataFields.dateX = "date";
        series2.yAxis = violationsAxis;

        // Visuals
        // series2.tooltipHTML = "<strong>{valueY}</strong> violations</span>";
        // series2.showTooltipOn = "hover";
        series2.stroke = am4core.color("#13C4A3");
        series2.strokeWidth = 2;
        series2.fill = am4core.color("#13C4A3");
        series2.fillOpacity = 0.7;

        //  Line Series 3 configuration
        var series3 = chart.series.push(new am4charts.LineSeries());
        series3.name = "Stock";
        series3.dataFields.valueY = "inventory";
        series3.dataFields.offersValueY = "offers";
        series3.dataFields.violationsValueY = "violations";
        series3.dataFields.dateX = "date";
        series3.yAxis = inventoryAxis;

        // Visuals
        series3.stroke = am4core.color("#384B7A");
        series3.strokeWidth = 2;
        series3.tooltipHTML = "<span><strong>{dateX}</strong><span><br /><span><strong>{valueY}</strong> in stock</span><br /><span><strong>{offersValueY}</strong> offers</span><br /><span><strong>{violationsValueY}</strong> violations</span>";
        series3.tooltip.getFillFromObject = false;
        series3.tooltip.background.fill = am4core.color("#384B7A");
        series3.tooltip.label.fill = am4core.color("#fff");

        // Bullets for inventory
        var bullet = series3.bullets.push(new am4charts.CircleBullet());
        bullet.circle.fill = am4core.color("#384B7A");
        bullet.circle.stroke = am4core.color("#384B7A");
        chart.maskBullets = false;

        // bullet states
        var hoverState = bullet.states.create("hover");
        hoverState.properties.scale = 1.7;

        // Cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineY.disabled = true;
        chart.cursor.lineX.disabled = true;

        // Scrollbar
        chart.scrollbarX = new am4charts.XYChartScrollbar();
        chart.scrollbarX.series.push(series);
        chart.scrollbarX.series.push(series2);
        // chart.scrollbarX.series.push(series3);
        chart.scrollbarX.parent = chart.bottomAxesContainer;
        // chart.scrollbarX.scrollbarChart.series3.getIndex(0).xAxis.startLocation = -1.5;
        // chart.scrollbarX.scrollbarChart.series3.getIndex(0).xAxis.endLocation = 3;

        // chart.scrollbarX.background.fill = am4core.color("#384B7A");
        // chart.scrollbarX.thumb.background.fill = am4core.color("#13C4A3");
        // chart.scrollbarX.thumb.background.states.getKey('hover').properties.fill = am4core.color("#13C4A3");
        // chart.scrollbarX.thumb.background.states.getKey('down').properties.fill = am4core.color("#13C4A3");
        // function customizeGrip(grip) {
        //   grip.background.fill = am4core.color("#13C4A3");
        //   grip.background.states.getKey('hover').properties.fill = am4core.color("#13C4A3");
        //   grip.background.states.getKey('down').properties.fill = am4core.color("#384B7A");
        // }

        // customizeGrip(chart.scrollbarX.startGrip);
        // customizeGrip(chart.scrollbarX.endGrip);

        // Zoom button
        chart.zoomOutButton.disabled = true;

        // Legend
        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";
        chart.legend.contentAlign = "right";

    </script>
    <!--end::AmChart V4 Big Chart -->
    <!--end::Page Vendors(used by this page) -->
@stop