@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('modules/dashboard/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/dashboard/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/dashboard/datatables/Responsive-2.2.1/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/dashboard/jquery-selectric/selectric.css') }}">
@endpush

<div class="clearfix mb-3">
    @if ($lengthMenu)
        <div class="dataTables_length float-left mr-2" id="data-table_length">
            <div class="form-inline">
                <div class="form-group">
                    <label class="mr-2 d-none d-sm-block">Tampilkan</label>
                    <select name="data-table_length" aria-controls="data-table" class="form-control selectric">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ml-2 d-none d-sm-block">entri</span>
                </div>
            </div>
        </div>
    @endif
    @if ($checkbox)
        <div class="float-sm-left ml-2">
            <select id="action-selected" class="form-control selectric">
                <option value="">Tindakan</option>
                @foreach ($actions as $action)
                    <option value="{{$action['value']}}">{{$action['name']}}</option>
                @endforeach
            </select>
        </div>
    @endif
    @if ($searching)
        <div class="float-sm-right">
            <input class="form-control" name="data-table_search" type="search" placeholder="Pencarian" aria-label="Search">
        </div>
    @endif
</div>
<table class="table table-striped responsive" id="data-table" width="100%">
    <thead>
        <tr>
            @if ($checkbox)
                <th class="text-center" data-priority="1">
                    <div class="custom-checkbox custom-checkbox-table custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                        <label style="cursor: pointer" for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                </th>
            @endif
            <th data-priority="1">
                No.
            </th>
            @foreach ($columns as $column)
                <th @if($column['title']=="Status") data-priority="4" @endif>{{$column['title']}}</th>
            @endforeach
            @if ($action)
                <th data-priority="3">Tindakan</th>
            @endif
        </tr>
    </thead>
</table>
@push('javascript')
    <script src="{{ asset('modules/dashboard/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('modules/dashboard/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modules/dashboard/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modules/dashboard/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script>
        var columnsDefault =[];
        @if ($checkbox)
            $("[data-checkboxes]").each(function() {
                var me = $(this),
                    group = me.data('checkboxes'),
                    role = me.data('checkbox-role');

                me.change(function() {
                    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
                    checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
                    dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                    total = all.length,
                    checked_length = checked.length;

                    if(role == 'dad') {
                        if(me.is(':checked')) {
                            all.prop('checked', true);
                        }else{
                            all.prop('checked', false);
                        }
                    }else{
                        if(checked_length >= total) {
                            dad.prop('checked', true);
                        }else{
                            dad.prop('checked', false);
                        }
                    }
                });
            });

            $('#action-selected').on('change', function() {
                const value = this.value;
                if(this.value!=""){
                    var id = [];
                    $.each($("input[name='id']:checked"), function(){
                        id.push($(this).val());
                    });
                    if (id.length==0) {
                        Swal.fire(
                            'Error!',
                            'Pilih setidaknya satu data!',
                            'error'
                        );
                    } else {
                        deleteOrUpdateSelected(id.join(","), this.value);
                    }
                }
                $(this).prop('selectedIndex', 0).selectric('refresh');
                $("#checkbox-all").prop('checked', false);
                $("input[name='id']:checked").prop('checked', false);
            });

            columnsDefault.push({
                className: "text-center",
                data: 'id',
                orderable: false,
                searchable: false
            });

        @endif
        columnsDefault.push({
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
        });
        @json($columns).forEach(element => {
            columnsDefault.push(element);
        });
        @if ($action)
            columnsDefault.push({
                searchable: false,
                sortable : false,
                data: 'action',
                name: 'action'
            });
        @endif

        @if ($lengthMenu)
            $('select[name="data-table_length"]').on('change', function() {
                dataTable.page.len(this.value).draw();
            });
        @endif

        @if ($searching)
            $('input[name="data-table_search"]').on( 'keyup', function () {
                dataTable.search(this.value).draw();
            });
            $('input[name="data-table_search"]').on( 'search', function () {
                dataTable.search(this.value).draw();
            });
        @endif

        const dataTable = $('#data-table').DataTable({
            dom: "tipr",
            language:{
                url:"http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            },
            lengthChange: false,
            searching: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{$ajaxUrl}}",
                data: dataFilter,
            },
            order: [@json(($checkbox) ? [1,'desc'] : $order)],
            columns: columnsDefault,
        });
    </script>
@endpush
