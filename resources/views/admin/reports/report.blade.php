<x-admin.layout>
    <x-slot name="title">Tapal Details</x-slot>
    <x-slot name="heading">Tapal Details</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <form action="{{ route('report') }}" method="GET" class="row">
                            @csrf
                            <div class="col-md-3">
                                <label for="status" class="control-label">Select Letter Type</label>
                                <select class="form-control" name="letter_type">
                                    <option value="">--- Select Type ---</option>
                                    @foreach ($letter_type_list as $list)
                                        <option value="{{ $list->id }}" @if(request('letter_type') == $list->id) selected @endif>{{ $list->letter_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="control-label">From Date</label>
                                <input type="date" id="fromdate" name="fromdate" class="form-control" @if(request('fromdate')) value="{{ request('fromdate') }}" @endif>
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="control-label">To Date</label>
                                <input type="date" id="todate" name="todate" class="form-control" @if(request('todate')) value="{{ request('todate') }}" @endif>
                            </div>
                            <div class="col-md-3" style="margin-top: 28px;">
                                <button type="submit" id="apply-filter" class="btn btn-primary">Search</button>
                                <a class="btn btn-success" href="{{ route('report') }}">Clear</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables-new" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    {{-- <th>Letter Type</th>
                                    <th>Department</th> --}}
                                    @if($selected_letter_type !== '3') 
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Pin</th>
                                        <th>Referance No</th>
                                        <th>Barcode No</th>                                        
                                    @else
                                        <th>Department Name</th>
                                        <th>Name & Ref No</th>
                                    @endif
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tapal_detail as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        {{-- <td>{{ $list->letter_type_name }}</td>
                                        <td>{{ $list->department_name }}</td> --}}
                                        @if($selected_letter_type !== '3')
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->address }}</td>
                                            <td>{{ $list->city }}</td>
                                            <td>{{ $list->pin }}</td>
                                            <td>{{ $list->referance_no ?? 'NA' }}</td>
                                            <td>{{ $list->barcode_no ?? 'NA' }}</td>
                                        @else
                                            <td>{{ $list->department_name }}</td>
                                            <td>{{ $list->name }}  {{ $list->address }} - {{ $list->referance_no }}</td>
                                        @endif
                                        {{-- <td>
                                            <button class="edit-element btn text-secondary px-2 py-1" title="Edit ward" data-id="{{ $list->id }}"><i data-feather="edit"></i></button>
                                            <button class="btn text-danger rem-element px-2 py-1" title="Delete ward" data-id="{{ $list->id }}"><i data-feather="trash-2"></i> </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-admin.layout>

<script>
    $(document).ready(function() {
        $('#buttons-datatables-new').DataTable({
            dom: 'Bfrtip', // Enable button options like PDF, Excel, CSV, Print, etc.
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    attr: {
                        style: 'background-color: #007bff; color: #fff; border: none; padding: 8px 16px; cursor: pointer;'
                    },
                    orientation: 'landscape', // You can set 'portrait' or 'landscape'
                    pageSize: 'A4', // You can change the page size if needed
                    customize: function (doc) {
                        // Add border for the table
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) { return 0.5; };
                        objLayout['vLineWidth'] = function(i) { return 0.5; };
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function(i) { return 8; };
                        objLayout['paddingRight'] = function(i) { return 8; };
                        doc.content[1].layout = objLayout;

                        // Center the table on the page
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        // Center the text in all table cells
                        doc.content[1].table.body.forEach(function(row) {
                            row.forEach(function(cell) {
                                cell.alignment = 'center'; // Center align each cell
                            });
                        });
                        
                        // Additional style changes (optional)
                        doc.styles.tableHeader.alignment = 'center';
                        doc.styles.tableHeader.fillColor = '#73adeb'; // Change the header background color if you want
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    attr: {
                        style: 'background-color: #28a745; color: #fff; border: none; padding: 8px 16px; cursor: pointer;'
                    }
                }
            ],
            // Other options for your DataTable can go here...
        });
    });
</script>