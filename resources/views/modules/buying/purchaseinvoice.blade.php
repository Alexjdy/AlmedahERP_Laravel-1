<!-- Datatable links -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">Purchase Invoice</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Edit</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                        onclick="loadPurchaseInvoice()">Refresh</button>
                </li>
                @if (($permissions['Purchase_Invoice']['create'] ?? null) === 1 || !auth()->user())
                    <li class="nav-item li-bom">
                        <button type="button" class="btn btn-primary" onclick="openNewPurchaseInvoice();">
                            New
                        </button>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<table id="invoice_table" class="table table-striped table-bordered hover" style="width:100%">
    <thead>
        <tr>
            <th>Purchase Invoice ID</th>
            <th>Receipt ID</th>
            <th>Date Created</th>
            <th>Paid Amount</th>
            <th>Total Price</th>
            <th>Amount Unpaid</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr>
            <td class="text-bold">
                @if (($permissions['Purchase_Invoice']['edit'] ?? null) === 1 || !auth()->user())
                    <a href="javascript:onclick=openPurchaseInvoiceInfo({{ $invoice->id }})">
                        {{ $invoice->p_invoice_id }}
                    </a>
                @else 
                    {{ $invoice->p_invoice_id }}
                @endif
            </td>
            <td>{{ $invoice->p_receipt_id }}</td>
            <td>{{ $invoice->date_created }}</td>
            <td class="text-bold pi_price">{{ $invoice->total_amount_paid }}</td>
            <td class="text-bold pi_price">{{ $invoice->grand_total }}</td>
            <td class="text-bold pi_price">{{ $invoice->payment_balance }}</td>
            
            <td
                @if($invoice->pi_status === 'Unpaid' || $invoice->pi_status === 'With Outstanding Balance')
                    class = "text-danger"
                @elseif($invoice->pi_status === 'Paid')
                    class = "text-success" 
                @endif
            >{{ $invoice->pi_status }}</td>
        </tr>
        @endforeach
        <!--<tr>
            <td class="text-bold">PI-123</td>
            <td>PR-123</td>
            <td>March/28/2021</td>
            <td class="text-danger">March/31/2021</td>
            <td class="text-bold">Cheque</td>
            <td class="text-bold price">1000</td>
            <td>Draft</td>
        </tr>-->
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        x = $('#invoice_table').DataTable();

        $(".pi_price").each(function () {
            // element == this
            let price = parseFloat($(this).html());
            let price_string = "₱ " + numberWithCommas(price.toFixed(2));
            $(this).html(price_string);
        });
    });

    /**From internet function */
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

</script>
